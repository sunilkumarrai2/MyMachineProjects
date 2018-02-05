/**
 * Created by r630166 on 9/9/17.
 */
angular.module("BudgetApp").config(function($routeProvider,$locationProvider) {
    // $locationProvider.html5Mode(true);
    $routeProvider
        .when("/", {
        templateUrl : "dashBoard.html",
            controller:"dashboardController",
        title: 'Dashboard'
    })
        .when("/Dashboard", {
        templateUrl : "dashBoard.html",
        controller:"dashboardController",
        title: 'Dashboard'
    })
    .when("/DesignBudget", {
        templateUrl : "designBudget.html",
        controller : "designBudgetController",
        title: 'Beauty Gallery'
    }).otherwise({redirectTo: '/'});
    
//     $locationProvider.html5Mode(true);
});
