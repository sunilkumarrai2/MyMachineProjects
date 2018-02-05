angular.module("BudgetApp").service("budgetService",budgetService);

function budgetService($http,$rootScope) {
    var base = "/budget";

    this.getBudgetByTimeperiodAndUserId = function (tpid,uid) {
        var url = "/getBudgetByTimeperiodAndUserId.php?periodId="+tpid+"&userId="+uid;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err);; return false;});
        return promise2;
    };
    
    this.postBudget = function (user_id,time_period_id,amount) {
        var payLoad = {"user_id":user_id,"time_period_id":time_period_id,"amount":amount};
        var url = "/postBudget.php";
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.post(url,payLoad);
        var promise2 = promise1.then(function (response) {console.log("BUDGET POSTED SUCCESSFULLY FROM BUDGET SERVICE");return response;},function (err) {console.log("!!!!!! ERROR WHILE POSTING BUDGET FROM BUDGET SERVICE");console.log(err); return false;});
        return promise2;
    }
    
    this.getMostRecentBudgetIdByUserId = function (user_id) {
        var url = "/getMostRecentBudgetIdByUserId.php?user_id="+user_id;
        var url = $rootScope.restUrl + base + url;
        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function(err){console.log(err);; return false;});
        return promise2;
    }
}

