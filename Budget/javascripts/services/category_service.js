angular.module("BudgetApp").service("categoryService",categoryService);

function categoryService($http,$rootScope) {
    var base = "/category";
    this.getBasicCategory = function () {
        var url = "/getBasicCategory.php";
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    };
    
    this.getCategoryByBudgetId = function (budgetId) {
        var url = "/getCategoryByBudgetId.php?budgetId="+budgetId;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    }
    
    this.getCategoryIdByCategoryName = function (categoryName) {
        var url = "/getCategoryIdByCategoryName.php?categoryName="+categoryName;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    }

    this.postNewCategory = function (categoryName, amount) {
        var url = "/postNewCategory.php";
        var url = $rootScope.restUrl + base + url;

        var payload = {"category_name":categoryName,"default_amount":amount,"is_basic":0};
        var promise1 = $http.post(url,payload);
        var promise2 = promise1.then(function (response) {console.log(response);return response;},function (err) {console.log(err); return false;});
        return promise2;
    }
}