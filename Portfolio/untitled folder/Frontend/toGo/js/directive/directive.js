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
        ])