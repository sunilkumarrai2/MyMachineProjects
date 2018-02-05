angular.module("Portfolio_Frontend").service('imageService', function($http) {
    this.getHex = function (x) {
        return x.toString(16);
    };
    // path = "http://localhost:3000/Frontend/toGo/data/beauty_images.json"
    beautyPath = "Portfolio/Frontend/toGo/data/beauty_images.json";
    creativePath = "Portfolio/Frontend/toGo/data/creative_images.json";
    specialfxPath = "Portfolio/Frontend/toGo/data/specialfx_images.json";
        return {
         
            getBeautyImages: function() {
                                        return $http({method: 'GET',url: beautyPath})
                                            .then(
                                                function(response){return response.data;}, 
                                                function(errResponse){
                                                    console.error('Error while fetching images');
                                                    return $q.reject(errResponse);
                                                                     }
                                             );
                                        },
            getCreativeImages: function () {
                                        return $http({method: 'GET', url: creativePath})
                                            .then(function(response){return response.data;},
                                                  function(errResponse){
                                                      console.error('Error while fetching images');
                                                      return $q.reject(errResponse);
                                                                        }
                                            );
                                        },
            getSpecialfxImages: function () {
                                        return $http({method: 'GET', url: specialfxPath})
                                            .then(function(response){return response.data;},
                                                  function(errResponse){
                                                      console.error('Error while fetching images');
                                                      return $q.reject(errResponse);
                                                                        }
                                            );
                                        }
         
                };
        

});

// App.factory('UserService', ['$http', '$q', function($http, $q){
// 
//     return {
//         
//     fetchAllUsers: function() {
//             return $http.get('http://localhost:8080/SpringMVC4RestAPI/user/')
//             .then(
//                     function(response){
//                         return response.data;
//                     }, 
//                     function(errResponse){
//                         console.error('Error while fetching users');
//                         return $q.reject(errResponse);
//                     }
//             );
//         },
//     
//     createUser: function(user){
//             return $http.post('http://localhost:8080/SpringMVC4RestAPI/user/', user)
//             .then(
//                     function(response){
//                         return response.data;
//                     }, 
//                     function(errResponse){
//                         console.error('Error while creating user');
//                         return $q.reject(errResponse);
//                     }
//             );
//         },
//     
//     updateUser: function(user, id){
//             return $http.put('http://localhost:8080/SpringMVC4RestAPI/user/'+id, user)
//             .then(
//                     function(response){
//                         return response.data;
//                     }, 
//                     function(errResponse){
//                         console.error('Error while updating user');
//                         return $q.reject(errResponse);
//                     }
//             );
//         },
//     
//    deleteUser: function(id){
//             return $http.delete('http://localhost:8080/SpringMVC4RestAPI/user/'+id)
//             .then(
//                     function(response){
//                         return response.data;
//                     }, 
//                     function(errResponse){
//                         console.error('Error while deleting user');
//                         return $q.reject(errResponse);
//                     }
//             );
//         }
//         
//     };
// 
// }]);
//
//
