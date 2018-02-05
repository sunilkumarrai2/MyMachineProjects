/**
 * Created by r630166 on 8/12/17.
 */
angular.module("Portfolio_Frontend").controller("creativeCtrl", function($scope,Lightbox,imageService) {
    imageService.getCreativeImages().then(function(response) {
    $scope.images = response;
    });
    

    $scope.openLightboxModal = function (index) {
        Lightbox.openModal($scope.images, index);
    };
});