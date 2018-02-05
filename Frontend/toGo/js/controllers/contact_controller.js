angular.module("Portfolio_Frontend").controller("contactCtrl", function($scope,$timeout,$http,$q) {
    
    $scope.name = "";
    $scope.email = "";
    $scope.message = "";
    $scope.showEmailStatus=false;
    $scope.emailStatus="Message Sent, I will get back to you very soon"
    
    $scope.sendEmail = function () {
        console.log("***************"+window.location.href);
        $http({method: 'POST',
       url:"http://harshitasinghal.com/Backend/a.php",
       data:{ email: $scope.email,name: $scope.name,message: $scope.message},
       headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
                                            .then(
                                                function(response){
                                                    console.log('Email sent successfully');
                                                    $scope.name = "";
//                                                    $scope.email = "";
                                                    $scope.message = "";
                                                    $scope.showEmailStatus=true;
                                                    $scope.emailStatus = response.data.substring(0,response.data.indexOf('\n'));
//                                                  $scope.emailStatus="Message Sent, I will get back to you very soon";
                                                    $scope.emailSentStatusDiv="alert alert-success";
                                                    $timeout(function(){$scope.showEmailStatus = false;}, 5000);
                                                }, 
                                                function(errResponse){
                                                    console.error('Error while sending email');
                                                    $scope.showEmailStatus=true;
                                                    $scope.emailStatus="Message NOT Sent !!!!!!!!!!! Try again Later";
                                                    $scope.emailSentStatusDiv="alert alert-danger";
                                                    return $q.reject(errResponse);
                                                                     }
                                             );
    }
        
});

//https://codeforgeek.com/2014/07/angular-post-request-php/
