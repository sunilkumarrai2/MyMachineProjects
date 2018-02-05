angular.module("BudgetApp").service("userService",userService);

function userService($http,$rootScope) {
    this.getUserIdByUsernameAndPassword = function (username,password) {
        var base = "/user";
        var url = "/getUserIdByUsernameAndPassword.php?username="+username+"&password="+password;
        var url = $rootScope.restUrl + base + url;

        var promise1 = $http.get(url);
        var promise2 = promise1.then(function (response) {return response;},function (err) {console.log(err); return false;});
        return promise2;
    }
}