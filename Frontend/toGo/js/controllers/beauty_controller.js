/**
 * Created by r630166 on 8/12/17.
 */
angular.module("Portfolio_Frontend").controller("beautyCtrl", function($scope,Lightbox,imageService) {
    imageService.getBeautyImages().then(function(response) {
    $scope.images = response;
    console.log(response);
    });
    

    $scope.openLightboxModal = function (index) {
        Lightbox.openModal($scope.images, index);
    };
});