angular.module("BudgetApp").service("expenseService",expenseService);

function expenseService($http,$rootScope) {
    var base = "/expense";
    this.postExpense = function (expense_name,amount,category_id,budget_id,expense_date) {
        var url = "/postExpense.php";
        var url = $rootScope.restUrl + base + url;

        var payload = {"expense_name":expense_name,"amount":amount,"category_id":category_id,"budget_id":budget_id,"expense_date":expense_date};
        var promise1 = $http.post(url,payload);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err);return false;})
        return promise2;
    };
    
    this.getAllExpensesByBudgetIdWithCategoryIdReplacedByItsName = function (budget_id) {
        var url = "/getAllExpensesByBudgetIdWithCategoryIdReplacedByItsName.php?budget_id="+budget_id;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err);return false;})
        return promise2;
    };
    
    this.getConsolidatedExpensesByBudgetId = function (budget_id) {
        var url = "/getConsolidatedExpensesByBudgetId.php?budget_id="+budget_id;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err);return false;})
        return promise2;
    };
    
    this.getBalanceForEachCategoryInGivenBudgetId = function (budget_id) {
        var url = "/getBalanceForEachCategoryInGivenBudgetId.php?budget_id="+budget_id;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err);return false;})
        return promise2;
    };
}