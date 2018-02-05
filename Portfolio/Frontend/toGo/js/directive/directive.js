/**
 * Created by r630166 on 8/14/17.
 */
angular.module("Portfolio_Frontend").directive('preventRightClick', [

            function() {
                return {
                    restrict: 'A',
                    link: function($scope, $ele) {
                        $ele.bind("contextmenu", function(e) {
                            e.preventDefault();
                        });
                    }
                };
            }
        ]);

angular.module("Portfolio_Frontend").directive('fileModel',['$parse', function($parse){
    return {
        restrict: 'A',
        link: function(scope, element, attrs){
            var model  = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope,element[0].files[0]);
                });
            });
        }
    };
}]);

