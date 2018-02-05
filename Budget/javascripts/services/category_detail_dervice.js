angular.module("BudgetApp").service("categoryDetailService",categoryDetailService);

function categoryDetailService($http,$rootScope) {
    var base = "/category_detail";

    this.postCategoryDetail = function (categoriesList,budget_id) {
        var url = "/postCategoryDetail.php";
        var url = $rootScope.restUrl + base + url;

        categoriesList.forEach(function (item) {
            delete item.is_basic;
            item.budget_id = budget_id;
        });
        var payload = categoriesList;
        var promise1 = $http.post(url,payload);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    }
    
    this.getCategoriesDetailsByBudgetId = function (budget_id) {
        var url = "/getCategoriesDetailsByBudgetId.php?budget_id="+budget_id;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    }
    
    this.editCategoryDetail = function (categoriesList,budget_id) {
        var url = "/editCategoryDetail.php";
        var url = $rootScope.restUrl + base + url;

        categoriesList.forEach(function (item) {
            item.budget_id = budget_id;
            item.amount = item.default_amount;
        });
        var payload = categoriesList;
        var promise1 = $http.put(url,payload);
        var promise2 = promise1.then(function (response) {console.log("category_detail_service - edit cd successful"+response.data);return response;},function (err) {console.log(err); return false;});
        return promise2;
    }
    
    this.deleteCategoryDetailByBudegetId = function (categoryDetailObject) {
        var url = "/deleteCategoryDetailByBudegetId.php?budget_id="+categoryDetailObject.budget_id+"&category_id="+categoryDetailObject.category_id;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.delete(url);
        var promise2 = promise1.then(function (response) {console.log("Deleting category detail with category_id "+categoryDetailObject.category_id+" for budget_id "+categoryDetailObject.budget_id+", from categoryDetailService");return response;},function (err) {console.log(err); return false;})
        return promise2;
    }
}