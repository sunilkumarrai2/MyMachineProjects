/**
 * Created by r630166 on 8/12/17.
 */
angular.module("Portfolio_Frontend").config(function($routeProvider,$locationProvider) {
    // $locationProvider.html5Mode(true);
    $routeProvider
        .when("/", {
        templateUrl : "Portfolio/Frontend/toGo/views/Home.html",
        title: 'Home'
    })
        .when("/contact", {
        templateUrl : "Portfolio/Frontend/toGo/views/Contact.php",
        controller:"contactCtrl",
        title: 'Contact'
    })
    .when("/thumbernail_beauty", {
        templateUrl : "Portfolio/Frontend/toGo/views/Thumbernail_beauty.html",
        controller : "beautyCtrl",
        title: 'Beauty Gallery'
    })
        .when("/thumbernail_creative", {
        templateUrl : "Portfolio/Frontend/toGo/views/Thumbernail_creative.html",
            controller : "creativeCtrl",
        title: 'Creative Gallery'
    })
        .when("/thumbernail_special", {
        templateUrl : "Portfolio/Frontend//toGo/views/Thumbernail_special.html",
            controller : "specialFxCtrl",
        title: 'SpecialFx Gallery'
    })
    .when("/main", {
        template : "<h1>Main</h1><p>Click on the links to change this content</p>"
    }).when("/main", {
        template : "<h1>Main</h1><p>Click on the links to change this content</p>"
    })
    .when("/about", {
        templateUrl : "Portfolio/Frontend/toGo/views/About.html",
        title: 'About Me'
    })
    .when("/home", {
        templateUrl : "Portfolio/Frontend/toGo/views/Home.html",
        title: 'Home'
    })
    .when("/test", {
        templateUrl : "Portfolio/Frontend/toGo/views/test.html",
        controller : "testCtrl",
        title: 'Test'
    }).otherwise({redirectTo: '/'});
    
//     $locationProvider.html5Mode(true);
});


// to change the toutle for each route
angular.module("Portfolio_Frontend").run(['$rootScope', '$route', function($rootScope, $route) {
    $rootScope.$on('$routeChangeSuccess', function() {
        document.title = $route.current.title;
    });
}])


// https://scotch.io/quick-tips/pretty-urls-in-angularjs-removing-the-hashtag