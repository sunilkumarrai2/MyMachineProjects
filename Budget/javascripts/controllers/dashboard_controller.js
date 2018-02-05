angular.module("BudgetApp").controller("dashboardController",dashboardController);

function dashboardController($scope,$rootScope,dashboardService,timePeriodService,userService,budgetService,categoryDetailService,expenseService,$timeout) {
    $scope.heading="Dashboard";
    console.log("In dashboard controller");

    // http://localhost:3000/getTimePeriodIdByBudgetMonth?budget_month=2016-01-01
    timePeriodService.getAllTimePeriod().then(function (response) {
        $scope.allTimePeriods = response.data.records;
    });

    var today = new Date();
    var dd = "01";
    var accuDD = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(mm<10) {
    mm = '0'+mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    var accurateDate = yyyy + '-' + mm + '-' + accuDD;
    timePeriodService.getTimePeriodIdByBudgetMonth(today).then(function (response) {
        if(!response.data){console.log("Timeperiod id for  "+today+" not found");}
        else{
             $scope.budgetMonth=response.data.records[0];
             userService.getUserIdByUsernameAndPassword($rootScope.user,$rootScope.password).then(function (response) {
                if(!response.data){console.log("User "+$rootScope.user+" not found");}
                else{
                    $scope.userId = response.data.records[0].user_id;
                    $scope.getBudgetDetailsByUserIdAndTimeperiod()
                }
            });
        }
    });

   $scope.getBudgetDetailsByUserIdAndTimeperiod = function () {
        budgetService.getBudgetByTimeperiodAndUserId($scope.budgetMonth.time_period_id,$scope.userId).then(function (response) {
            //when current user's budget doesn't exists in selected timeperiod
            if(!response.data){
                console.log("Error while retrieving budget ID alotted for month "+$scope.budgetMonth.budget_month);

            }
            else if (response.data.records.length == 0){
                                $scope.budget_id = 0;
                                $scope.budgetExists = false;
                                $scope.budgetAllotted = response.data.records;
                                $scope.sumTotalBudgetForCurrentMonth();
                                $scope.categories = response.data.records;
                                $scope.populateExpenses();
                                $scope.populateConsolidatedExpenses();
                                $scope.populateBalanceTable();
            }
            else{   //when current user's budget does exists in selected timeperiod
                $scope.budget_id = response.data.records[0].budget_id;
                $scope.budgetExists = true;
                // $scope.tpid = response.data[0].time_period_id;
                categoryDetailService.getCategoriesDetailsByBudgetId($scope.budget_id).then(function (response) {
                            if(!response.data){
                                console.log("Error while retrieving budget detail for budget id :  "+$scope.budget_id);
                            }
                            else{
                                $scope.budgetAllotted = response.data.records;
                                $scope.sumTotalBudgetForCurrentMonth();
                                $scope.categories = response.data.records;
                                $scope.populateExpenses();
                                $scope.populateConsolidatedExpenses();
                                $scope.populateBalanceTable();
                            }
                        });
            }
        });
   };

    $scope.populateExpenses = function () {
        expenseService.getAllExpensesByBudgetIdWithCategoryIdReplacedByItsName($scope.budget_id).then(function (response) {
            if(!response.data){
                    console.log("Expenses retrieval failed !!!!!");
            }else{
                    console.log("Expenses retrieved successfully");
                    $scope.expenses = response.data.records;
                    $scope.sumTotalExpensesForCurrentMonth();
            }
        });
    };
    
    $scope.populateConsolidatedExpenses = function () {
        expenseService.getConsolidatedExpensesByBudgetId($scope.budget_id).then(function (response) {
            if(!response.data){
                    console.log("Consolidated Expenses retrieval failed !!!!!");
            }else{
                    console.log("Consolidated Expenses retrieved successfully");
                    $scope.consolidatedExpenses = response.data.records;
            }
        });
    };
    
    $scope.populateBalanceTable = function () {
        // $scope.balanceTable = [{"category_name":"Rent","balance":100},{"category_name":"Rent","balance":100},{"category_name":"Rent","balance":100},{"category_name":"Rent","balance":100}];
        
        expenseService.getBalanceForEachCategoryInGivenBudgetId($scope.budget_id).then(function (response) {
            if(!response.data.records){
                    console.log("Balance table retrieval failed !!!!!");
            }else{
                    console.log("Balance table retrieved successfully");
                    $scope.balanceTable = response.data.records;
            }
        });
    };
    
    
    $scope.expense_name = "";
    $scope.amount = "";
    $scope.category = "";
    $scope.showAddNewExpenseStatus = false;
    $scope.addExpense = function () {
        console.log("Accurate date : "+accurateDate);
        expenseService.postExpense($scope.expense_name, $scope.amount, $scope.category.category_id,$scope.budget_id,accurateDate).then(function (response) {
            if(!response.data){
                    console.log("Expense posting failed !!!!!");
                    $scope.addNewExpenseStatus="Expense posting failed !!!!!";
                    $scope.addNewExpenseStatusDiv="alert alert-danger text-center";
                    $scope.showAddNewExpenseStatus = true;
                    $timeout(function(){$scope.showAddNewExpenseStatus = false;}, 3000);
            }else{
                    console.log("Expense posted successfully");
                    $scope.expense_name = "";
                    $scope.amount = "";
                    $scope.category = "";
                    $scope.addNewExpenseStatus="Expense posted successfully";
                    $scope.addNewExpenseStatusDiv="alert alert-success text-center";
                    $scope.showAddNewExpenseStatus = true;
                    $scope.populateExpenses();
                    $scope.populateConsolidatedExpenses();
                    $scope.populateBalanceTable();
                    $timeout(function(){$scope.showAddNewExpenseStatus = false;}, 3000);
            }
        });
    };

    $scope.sumTotalExpensesForCurrentMonth = function() {
        var sum1 = 0;
        for(var i = 0;i < $scope.expenses.length;i++){
            if(!isNaN($scope.expenses[i].amount)){
               sum1 = sum1 + parseInt($scope.expenses[i].amount);
            }
        }
        $scope.totalExpensesForCurrentMonth =  sum1;
    }

    $scope.sumTotalBudgetForCurrentMonth = function() {
        var sum2 = 0;
        for(var i = 0;i < $scope.budgetAllotted.length;i++){
            if(!isNaN($scope.budgetAllotted[i].default_amount)){
               sum2 = sum2 + parseInt($scope.budgetAllotted[i].default_amount);
            }
        }
        $scope.totalBudgetForCurrentMonth =  sum2;
    }

    $scope.disabledAddExpenseButton = function () {
        console.log(($scope.category==="") +"----"+ ($scope.amount===""));
        return ($scope.category==="") | ($scope.amount==="");
    };
    
}
