/**
 * Created by r630166 on 9/9/17.
 */
angular.module("BudgetApp").controller("designBudgetController",designBudgetController);

function designBudgetController($scope,$rootScope,timePeriodService,userService,budgetService,categoryService,categoryDetailService,$timeout) {

    $scope.budgetMonth = "";
    $scope.timePeriodSelected = false;
    // $scope.budgetMonth = {"time_period_id":2,"budget_month":"2016, February"}


    $scope.allTimePeriods = "";
    $scope.hasBudgetInSelectedTimeperiod = "";
    $scope.isBudgetSubmitted = false;

    timePeriodService.getAllCurrentAndFutureTimeperiod().then(function (response) {
        $scope.allTimePeriods = response.data.records;
    });
    
    userService.getUserIdByUsernameAndPassword($rootScope.user,$rootScope.password).then(function (response) {
        console.log(response.data);
       $scope.userId = response.data.records[0].user_id;
    });
    
    $scope.caption = "select the month for which you are desiging budget";
    $scope.heading = "Design your budget";
    
    $scope.selectTimePeriod = function () {
        $scope.timePeriodSelected = true;
        $scope.isBudgetSubmitted = false;

        budgetService.getBudgetByTimeperiodAndUserId($scope.budgetMonth.time_period_id,$scope.userId).then(function (response) {
            //when current user's budget doesn't exists in selected timeperiod
            if(response.data.records.length === 0){
                $scope.hasBudgetInSelectedTimeperiod = false;
                budgetService.getMostRecentBudgetIdByUserId($scope.userId).then(function (response) {
                    //when current user has never designed any budget in past
                    if(response.data.records.length === 0){
                            console.log("User has never designed any budget in past");
                            categoryService.getBasicCategory().then(function (response) {
                                $scope.categoriesList = response.data.records;
                                $scope.getSum();
                            });
                    }
                else{//when current user has designed any budget in past
                        console.log("User has  designed  budget in past, retriving the most recent one");
                        var budget_id = response.data.records[0].budget_id;
                        $scope.tpid = response.data.records[0].time_period_id;
                        // get category detail by userid and budget id
                        categoryDetailService.getCategoriesDetailsByBudgetId(budget_id).then(function (response) {
                            $scope.categoriesList = response.data.records;
                            $scope.budgetIdIsOldOne = true;
                            console.log("In Sum");
                            $scope.getSum();
                        });
                }
                });

            }else{   //when current user's budget does exists in selected timeperiod
                var budget_id = response.data.records[0].budget_id;
                $scope.tpid = response.data.records[0].time_period_id;
                $scope.hasBudgetInSelectedTimeperiod = true;
                // get category detail by userid and budget id
                categoryDetailService.getCategoriesDetailsByBudgetId(budget_id).then(function (response) {
                            $scope.categoriesList = response.data.records;
                            $scope.getSum();
                        });
            }
        });
    }


    $scope.amount = "";

    $scope.getSum = function() {
        var sum = 0;
        for(var i = 0;i < $scope.categoriesList.length;i++){
            if(!isNaN($scope.categoriesList[i].default_amount)){
               sum = sum + parseInt($scope.categoriesList[i].default_amount);
            }
        }
        $scope.amount =  sum;
        console.log($scope.categoriesList);
    }

    $scope.budgetIdIsOldOne = false;

    $scope.submitBudget = function () {  // category_detail_id, category_id, budget_id, amount ----- category_id, category_name, default_amount
        console.log($scope.categoriesList);
        // $scope.isBudgetSubmitted = true;
        console.log($scope.categoriesList[0].budget_id+"----"+$scope.budgetMonth.time_period_id+"-----"+$scope.tpid);  //undefined----1-----undefined
        var temp = "budget_id";
        console.log($scope.categoriesList);
        if(temp in $scope.categoriesList[0] & $scope.budgetMonth.time_period_id === $scope.tpid){
            categoryDetailService.editCategoryDetail($scope.categoriesList,$scope.categoriesList[0].budget_id).then(function (response) {
                console.log("Budget editing request sent");
                if(!response.data){
                    console.log("budget with id "+$scope.categoriesList[0].budget_id+", edit failed for "+$scope.budgetMonth.budget_month+", from controller");
                    $scope.budgetStatus="Edit failed";
                    $scope.budgetStatusDiv="alert alert-danger";
                }
                else{
                    console.log("budget edited successfully");
                    $scope.isBudgetSubmitted = true;
                    $scope.budgetStatus="Budget editted successfully";
                    $scope.budgetStatusDiv="alert alert-success";
                   $scope.editButtonCaption = "Want to edit again, click me";
                   $scope.ediButtonBootstrapClass = "btn btn-primary";
                }
            });
        }else{
            console.log($scope.categoriesList);
            // write POST code here to post a new budget  into budget service
                                budgetService.postBudget($scope.userId, $scope.budgetMonth.time_period_id, $scope.amount).then(function (response) {
                                if(!response.data){
                                    console.log("New budget post for month ("+$scope.budgetMonth.budget_month+") failed, from controller");
                                    $scope.budgetStatus="Budget submission failed for "+$scope.budgetMonth.budget_month;
                                    $scope.budgetStatusDiv="alert alert-danger";
                                }
                                else{
                                    console.log("Budget posted successfully from controller");
                                    console.log($scope.categoriesList);
                                    budgetService.getBudgetByTimeperiodAndUserId($scope.budgetMonth.time_period_id,$scope.userId).then(function (response) {
                                    if(!response.data){
                                        console.log("budget id retrieval failed for month "+$scope.budgetMonth.budget_month+"failed, from controller");
                                        $scope.budgetStatus="Budget submission failed for "+$scope.budgetMonth.budget_month;
                                        $scope.budgetStatusDiv="alert alert-danger";
                                    }
                                    else{
                                            var budget_id = response.data.records[0].budget_id;
                                            console.log("Budget posted successfully with id : "+budget_id);
                                            console.log($scope.categoriesList);
                                            categoryDetailService.postCategoryDetail($scope.categoriesList,budget_id).then(function (response) {        //*********NEED A PROCESSING OF $scope.categoriesList to make sure it handles if data is coming from category_detail
                                            if(!response.data){
                                                console.log("New budget detail post for budget id "+budget_id+"failed, from controller");
                                                $scope.budgetStatus="Budget submission failed for "+$scope.budgetMonth.budget_month;
                                                $scope.budgetStatusDiv="alert alert-danger";
                                            }
                                            else{
                                                console.log("New Budget Detail posted successfully");
                                                console.log($scope.categoriesList);
                                                $scope.isBudgetSubmitted = true;
                                                $scope.budgetStatus="Budget submitted successfully for "+$scope.budgetMonth.budget_month;
                                                $scope.budgetStatusDiv="alert alert-success";
                                                $scope.editButtonCaption = "Want to edit again, click me";
                                                $scope.ediButtonBootstrapClass = "btn btn-primary";
                                                $scope.hasBudgetInSelectedTimeperiod = true;
                                            }
                                    });
                                    }
                                });
                                }

                            });
        }
        
    };

    $scope.editBudget = function () {
        $scope.isBudgetSubmitted = false;
    }

    $scope.displaySubmitBudgetButton = function () {
        return $scope.timePeriodSelected & !$scope.isBudgetSubmitted;
    }

    $scope.removeCategoryDetail = function (index) {

        var temp = "budget_id";
        if(temp in $scope.categoriesList[0] & $scope.budgetMonth.time_period_id === $scope.tpid){
            categoryDetailService.deleteCategoryDetailByBudegetId($scope.categoriesList[index]).then(function (response) {
                if(!response.data){
                    console.log("Removal of Budget category failed");
                    $scope.categoryDetailRemovalStatus="Removal failed";
                    $scope.categoryDetailRemovalStatusDiv="alert alert-danger";
                    $scope.showCategoryDetailRemovalStatus = true;
                    $timeout(function(){$scope.showCategoryDetailRemovalStatus = false;}, 3000);
                }
                else{
                    console.log("Removed Budget category successfully");
                    $scope.categoriesList.splice(index,1);
                    $scope.getSum();
                    $scope.categoryDetailRemovalStatus="Removed Successfully";
                    $scope.categoryDetailRemovalStatusDiv="alert alert-success";
                    $scope.showCategoryDetailRemovalStatus = true;
                    $timeout(function(){$scope.showCategoryDetailRemovalStatus = false;}, 3000);

                }
            });
        }
        else{
            console.log("Removed Budget category successfully");
            $scope.categoriesList.splice(index,1);
            $scope.getSum();
            $scope.categoryDetailRemovalStatus="Removed Successfully";
            $scope.categoryDetailRemovalStatusDiv="alert alert-success";
            $scope.showCategoryDetailRemovalStatus = true;
            $timeout(function(){$scope.showCategoryDetailRemovalStatus = false;}, 3000);
        }
    }

    $scope.newCategoryName = "";
    $scope.newCategoryAmount = "";
    
    $scope.addNewCategory = function () {
         categoryService.getCategoryIdByCategoryName($scope.newCategoryName.trim()).then(function (response) {
                 if(!response.data){
                    console.log("Retrieval of category id for "+$scope.newCategoryName+" failed");
                    $scope.addNewCategoryStatus="Couldn't add "+$scope.newCategoryName;
                    $scope.addNewCategoryStatusDiv="alert alert-danger";
                    $scope.showAddNewCategoryStatus = true;
                    $timeout(function(){$scope.showAddNewCategoryStatus = false;}, 3000);
                }
                else if(response.data.records.length === 0){
                    console.log("Need to add new category "+$scope.newCategoryName);
                     categoryService.postNewCategory($scope.newCategoryName,$scope.newCategoryAmount).then(function (response) {
                         if(!response.data){
                             console.log("Couldn't add "+$scope.newCategoryName);
                            $scope.addNewCategoryStatus="Couldn't add "+$scope.newCategoryName;
                            $scope.addNewCategoryStatusDiv="alert alert-danger";
                            $scope.showAddNewCategoryStatus = true;
                            $timeout(function(){$scope.showAddNewCategoryStatus = false;}, 3000);
                         }
                         else{
                             console.log("Newly inserted Category id found for "+$scope.newCategoryName+" : "+response.data.records[0].category_id);
                             var payload = {"budget_id":$scope.categoriesList[0].budget_id,"category_name":$scope.newCategoryName,"category_id":response.data.records[0].category_id,"default_amount":$scope.newCategoryAmount};
                             
                             // $scope.postNewCategoryDetail(response.data[0].category_id,$scope.newCategoryAmount);

                            $scope.categoriesList.push(payload);
                            $scope.getSum();
                            $scope.addNewCategoryStatus="Category inserted successfully,<br> <strong>don't forget to submit it</strong>";
                            $scope.addNewCategoryStatusDiv="alert alert-success";
                            $scope.showAddNewCategoryStatus = true;
                             $scope.newCategoryName = "";
                            $scope.newCategoryAmount = "";
                            $timeout(function(){$scope.showAddNewCategoryStatus = false;}, 5000);
                         }
                     });
                }
                else{
                     console.log("Category id found for "+$scope.newCategoryName+" : "+response.data.records[0].category_id);
                     var payload = {"budget_id":$scope.categoriesList[0].budget_id,"category_name":$scope.newCategoryName,"category_id":response.data.records[0].category_id,"default_amount":$scope.newCategoryAmount};
                     $scope.categoriesList.push(payload);
                     $scope.getSum();
                     $scope.addNewCategoryStatus="Category inserted successfully,<br> <strong>don't forget to submit it</strong>";
                    $scope.addNewCategoryStatusDiv="alert alert-success";
                    $scope.showAddNewCategoryStatus = true;
                     $scope.newCategoryName = "";
                    $scope.newCategoryAmount = "";
                    $timeout(function(){$scope.showAddNewCategoryStatus = false;}, 5000);
                 }
            });
    }

    $scope.disabledPlus = function (category_id,amount) {
            return $scope.newCategoryName==="" | $scope.newCategoryAmount==="";
    };
}

// Budget
// budget_id, user_id, time_period_id, amount
//
// Category_detail
// category_detail_id, category_id, budget_id, amount


// function abc(){
//     var x = {"a":1};
//     var a = "a";
//    if(a in x){
//        console.log("Property Exists");
//    }
//    else{
//        console.log("Property Doesn't Exists");
//    }
//     var b = "b";
//     if(b in x){
//         console.log("Property Exists");
//     }
//     else{
//         console.log("Property Doesn't Exists");
//     }
// }