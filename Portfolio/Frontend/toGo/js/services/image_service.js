angular.module("Portfolio_Frontend").service('imageService', function($http) {
    this.getHex = function (x) {
        return x.toString(16);
    };
    // path = "http://localhost:3000/Frontend/toGo/data/beauty_images.json"

    // beautyPath = "Frontend/toGo/data/beauty_images.json";
    // creativePath = "Frontend/toGo/data/creative_images.json";
    // specialfxPath = "Frontend/toGo/data/specialfx_images.json";

    // LOCAL
    var url = "http://localhost/Backend";

    // GoDaddy
    // var url = "http://harshitasinghal.com/Backend";

    

    beautyPath = url + "/beauty_images/read.php";
    creativePath = url + "/creative_images/read.php";
    specialfxPath = url + "/specialfx_images/read.php";
    updatePicOrderPath = url + "/updatePicOrder.php";
    uploadUrl = url + "/uploadPic.php";
    deleteUrl = url + "/deletePic.php";
    setHomePicUrl = url + "/setHomePicUrl.php";
        return {
         
            getBeautyImages: function() {
                                        return $http({method: 'GET',url: beautyPath})
                                            .then(
                                                function(response){
                                                    response.data.records.forEach(function(item){
                                                        var xhr = new XMLHttpRequest();
                                                        xhr.open('HEAD', item.url, true);
                                                        xhr.onreadystatechange = function(){
                                                            if ( xhr.readyState == 4 ) {
                                                                if ( xhr.status == 200 ) {
                                                                    item.sizeInMb = parseFloat((xhr.getResponseHeader('Content-Length')/1000000).toFixed(3)); 
                                                                    } 
                                                                }
                                                        };
                                                        xhr.send(null);
                                                    });
                                                    return response.data.records;
                                                }, 
                                                function(errResponse){
                                                    console.error('Error while fetching images');
                                                    return $q.reject(errResponse);
                                                                     }
                                             );
                                        },
            getCreativeImages: function () {
                                        return $http({method: 'GET', url: creativePath})
                                            .then(function(response){
                                                response.data.records.forEach(function(item){
                                                    var xhr = new XMLHttpRequest();
                                                    xhr.open('HEAD', item.url, true);
                                                    xhr.onreadystatechange = function(){
                                                        if ( xhr.readyState == 4 ) {
                                                            if ( xhr.status == 200 ) {
                                                                item.sizeInMb = parseFloat((xhr.getResponseHeader('Content-Length')/1000000).toFixed(3)); 
                                                                } 
                                                            }
                                                    };
                                                    xhr.send(null);
                                                });
                                                return response.data.records;
                                            },
                                                  function(errResponse){
                                                      console.error('Error while fetching images');
                                                      return $q.reject(errResponse);
                                                                        }
                                            );
                                        },
            getSpecialfxImages: function () {
                                        return $http({method: 'GET', url: specialfxPath})
                                            .then(function(response){
                                                response.data.records.forEach(function(item){
                                                    var xhr = new XMLHttpRequest();
                                                    xhr.open('HEAD', item.url, true);
                                                    xhr.onreadystatechange = function(){
                                                        if ( xhr.readyState == 4 ) {
                                                            if ( xhr.status == 200 ) {
                                                                item.sizeInMb = parseFloat((xhr.getResponseHeader('Content-Length')/1000000).toFixed(3)); 
                                                                } 
                                                            }
                                                    };
                                                    xhr.send(null);
                                                });
                                                return response.data.records;
                                            },
                                                  function(errResponse){
                                                      console.error('Error while fetching images');
                                                      return $q.reject(errResponse);
                                                                        }
                                            );
                                        },
            updateOrder : function(tableName, data){
                                        var payload = {"tableName":tableName,"data":data};
                                        // var payload = data;
                                        console.log(updatePicOrderPath);
                                        //changing it to POST since put was not working
                                        var promise1 = $http.post(updatePicOrderPath,payload);
                                        var promise2 = promise1.then(function (response) {
                                                    console.log(response);
                                                    console.log("image_service - edit pic order : ");
                                                    return response.data;
                                                },function (err) {
                                                    console.log(err); 
                                                    return false;
                                                });
                                        return promise2;
                                        },
            uploadFile : function(file,imageType){
                                        console.log(imageType);
                                        var fd =new FormData();
                                        fd.append('fileToUpload',file);
                                        fd.append('imageType',imageType);
                                        var promise1 = $http.post(uploadUrl, fd, {
                                            transformRequest: angular.identity,
                                            headers: {'Content-Type': undefined}
                                         });
                                        var promise2 = promise1.then(function(response){
                                                if(response.data.result){
                                                    console.log("uploaded successfully");
                                                }else{
                                                    console.log("uploaded failed");
                                                }
                                                return response;},
                                            function(err){
                                                console.log(err);
                                                return {"data":{"result":false}};
                                            });
                                        return promise2; 

            },
            deletePic : function(id,imageType,thumbUrl,url){
                console.log(imageType);
                //changing it to POST since delete was not working
                var promise1 = $http.post(deleteUrl+"?id="+id+"&imageType="+imageType+"&thumbUrl="+thumbUrl+"&url="+url);
                var promise2 = promise1.then(function(response){
                        if(response.data.result){
                            console.log("deleted successfully");
                        }else{
                            console.log("deletion failed");
                        }
                        return response;},
                    function(err){
                        console.log(err);
                        return {"data":{"result":false}};
                    });
                return promise2; 

            },
            
            setHomePic : function(url){
                var promise1 = $http.post(setHomePicUrl+"?url="+url);
                var promise2 = promise1.then(function(response){
                        if(response.data.result){
                            console.log("Home pic updated successfully");
                        }else{
                            console.log("Unable to update home pic");
                        }
                        return response;},
                    function(err){
                        console.log(err);
                        return {"data":{"result":false}};
                    });
                return promise2; 
            }
         
                };
        

});
