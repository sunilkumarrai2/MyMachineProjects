angular.module("BudgetApp").service("timePeriodService",timePeriodService);

function timePeriodService($http,$rootScope) {
    var base = "/timeperiod";
    this.getTimePeriodIdByBudgetMonth = function (budget_month) {
        var url = "/getTimePeriodIdByBudgetMonth.php?budget_month="+budget_month;
        var url = $rootScope.restUrl + base +url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    }
    // /getAllTimePeriod
    
    this.getAllTimePeriod = function (budget_month) {

        var url = "/getAllTimePeriod.php";
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    }

    this.getAllCurrentAndFutureTimeperiod = function (budget_month) {
        
                var url = "/getAllCurrentAndFutureTimeperiod.php";
                var url = $rootScope.restUrl + base + url;
        
                var promise1 = $http.get(url);
                var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
                return promise2;
            }
}