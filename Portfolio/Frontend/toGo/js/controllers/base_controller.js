/**
 * Created by r630166 on 8/12/17.
 */
angular.module("Portfolio_Frontend").controller("base", function($scope,imageService,$timeout,$rootScope) {
    $scope.showSubmitStatus=false;
    $scope.showLoader = false;
   $scope.categories=["beauty","creative","specilfx"];
   $scope.category = "";
   $scope.myFile = "";
   

   

   $scope.uploadFile = function(){
    $scope.showLoader = true;
    var file = $scope.myFile;
    var imageType = $scope.category;
        imageService.uploadFile(file,imageType).then(function(response){
            $scope.uploadStatus = response.data.result;
            if($scope.uploadStatus){
                $scope.showLoader = false;
                console.log("Upload status base controller : "+$scope.uploadStatus);
                $scope.showSubmitStatus=true;
                $scope.submitStatus="Submitted Successfully";
                $scope.submitStatusDiv="alert-success";
                if($scope.category === "beauty"){$rootScope.$broadcast('emitedFromBaseToBeauty', $scope.category);}
                else if($scope.category === "creative"){$rootScope.$broadcast('emitedFromBaseToCreative', $scope.category);}
                else if($scope.category === "specilfx"){$rootScope.$broadcast('emitedFromBaseToSpecialfx', $scope.category);}
                $scope.category = "";
                $timeout(function(){$scope.showSubmitStatus = false;}, 3000);
            }else{
                $scope.showLoader = false;
                console.log("Upload status base controller : "+$scope.uploadStatus);
                $scope.showSubmitStatus=true;
                $scope.submitStatus="Submission Failed !!!";
                $scope.submitStatusDiv="alert-danger";
                $timeout(function(){$scope.showSubmitStatus = false;}, 3000);
            }
            
            });
   };

   

   $scope.isDisabled = function(){
    return $scope.category === "" | $scope.myFile === "";
   }
});