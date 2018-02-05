var app = angular.module("App",[]);
app.controller("ctrl",ctrl);

function ctrl($scope,$http) {
    $scope.temp = "Sunil";
    console.log("Hello Outside");
    $http.get("http://localhost:3001/results").then(function (response) {
                $scope.list = response.data;
                console.log("Hello inside");
                console.log($scope.list);
                console.log(response.data)
            });
}