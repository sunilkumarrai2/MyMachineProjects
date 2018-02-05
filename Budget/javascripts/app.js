angular.module("BudgetApp",["ngRoute","ngSanitize"]).run(function($rootScope) {
    $rootScope.user = "Sunil";
    // $rootScope.password = "sunhar143";
    // $rootScope.user = "Harshita";
    $rootScope.password = "sunhar143";

    //GOdaddy
    //$rootScope.restUrl = "http://harshitasinghal.com/BudgetApp_Api";
    //Local
    $rootScope.restUrl = "http://localhost/MyProjects/Budget/BudgetApp_Api";
});

// angular.module("BudgetApp").config(['$locationProvider', function($locationProvider) {
//   $locationProvider.html5Mode(true);
//   $locationProvider.hashPrefix('');
// }]);

$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]'
});