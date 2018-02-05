angular.module("BudgetApp").service("dashboardService",dashboardService);

function dashboardService($http,$rootScope) {
    var base = "/category";
     this.getCategories = function () {
         var url = "/getCategories.php";
         var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {console.log(response);return response;}, function (err) {console.log(err); return false;});
        return promise2;
    }
}/**
 * Created by r630166 on 9/9/17.
 */
