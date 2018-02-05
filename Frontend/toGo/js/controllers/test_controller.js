/**
 * Created by r630166 on 8/12/17.
 */
angular.module("Portfolio_Frontend").controller("testCtrl", function($scope,Lightbox, imageService) {
    $scope.name = "test";

    // $scope.test = imageService.getHex(255)

    imageService.getBeautyImages().then(function(response) {
    $scope.images = response;
    });
    

    $scope.openLightboxModal = function (index) {
        Lightbox.openModal($scope.images, index);
    };
});



