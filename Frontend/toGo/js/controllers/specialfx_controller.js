/**
 * Created by r630166 on 8/12/17.
 */
angular.module("Portfolio_Frontend").controller("specialFxCtrl", function($scope,Lightbox,imageService) {
    imageService.getSpecialfxImages().then(function(response) {
    $scope.images = response;
    });
    

    $scope.openLightboxModal = function (index) {
        Lightbox.openModal($scope.images, index);
    };
});