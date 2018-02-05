/**
 * Created by r630166 on 8/12/17.
 */
angular.module("Portfolio_Frontend").controller("beautyCtrl", function($scope,Lightbox,imageService,$timeout) {
    $scope.temp = "Sunil";
    imageService.getBeautyImages().then(function(response) {
        $scope.images = response;
        console.log($scope.images);
    });
    
    $scope.reorderSuccessful = false;
    $scope.reorderUnsuccessful = false;

    $scope.openLightboxModal = function (index) {
        Lightbox.openModal($scope.images, index);
    };

    $scope.sorting =  function(index){
        $scope.images.splice(index,1);
        var newdata = [];
        angular.forEach($scope.images,function(val,index){
            val.orderIndex = index+1;
            newdata.push(val);
        });
        
        imageService.updateOrder("beauty_images",newdata).then(function(response){
            $scope.images = newdata;
            $scope.reorderSuccessful = true;
            $timeout(function(){$scope.reorderSuccessful = false;}, 1000);
        },function(err){
            $scope.reorderUnsuccessful = true;
            $timeout(function(){$scope.reorderUnsuccessful = false;}, 1000);
        });
    }

    $scope.$on('emitedFromBaseToBeauty', function(event, args) {
        if(args === "beauty"){
            imageService.getBeautyImages().then(function(response) {
                $scope.images = response;
                console.log(response);
                });
        }
     });

     $scope.showDeleteStatus = false;
    //  $scope.deleteStatus="Deleted Successfully";
    //  $scope.deleteStatusDiv="alert alert-success";
     $scope.deletePic = function(index){
        var file = $scope.myFile;
        var imageType = "beauty";
            imageService.deletePic($scope.images[index].id,imageType,$scope.images[index].thumbUrl,$scope.images[index].url).then(function(response){
                $scope.deleteStatus = response.data.result;
                if($scope.deleteStatus){
                    console.log("Delete status beauty controller : "+$scope.deleteStatus);
                    $scope.showDeleteStatus=true;
                    $scope.deleteStatus="Deleted Successfully";
                    $scope.deleteStatusDiv="alert alert-success";
                    $scope.images.splice(index,1);
                    $timeout(function(){$scope.showDeleteStatus = false;}, 3000);
                }else{
                    console.log("Delete status base controller : "+$scope.uploadStatus);
                    $scope.showDeleteStatus=true;
                    $scope.deleteStatus="Deletion Failed !!!";
                    $scope.deleteStatusDiv="alert alert-danger";
                    $timeout(function(){$scope.showDeleteStatus = false;}, 3000);
                }
                
                });
       };

       $scope.setPicIdToBeSelectedAsHomePic = function(index){
        $scope.imageTobeTheHomePic = $scope.images[index];
    }
    $scope.showUpdateHomePicStatus = false;
    $scope.setHomePic = function(){
        imageService.setHomePic($scope.imageTobeTheHomePic.url).then(function(response){
            if(response.data.result){
                $scope.showUpdateHomePicStatus=true;
                $scope.updateHomePicStatus="Home pic updated Successfully";
                $scope.showUpdateHomePicStatusDiv="alert alert-success";
                $timeout(function(){$scope.showUpdateHomePicStatus = false;}, 3000);
            }else{
                $scope.showUpdateHomePicStatus=true;
                $scope.updateHomePicStatus="Unable to update home pic";
                $scope.showUpdateHomePicStatusDiv="alert alert-danger";
                $timeout(function(){$scope.showUpdateHomePicStatus = false;}, 3000);
            }
        });
    };

    $scope.menuItems = [
        {
          text:"Set as home pic", 
          callback: $scope.setHomePic, //function to be called on click  
          disabled: false
        }
      ];
});