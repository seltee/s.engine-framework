var urlgate = 'http://sengine/datapoint.php';
var noLoader = [];
var inLoad = 0;
var defaultErrorCallback = null;
var loaderCallback = null;

export default class Datapoint {
    static call(funcName, data, onSuccess, onError) {
        if (noLoader.indexOf(funcName) == -1) {
            inLoad++;
            if (loaderCallback && inLoad == 1){
                loaderCallback(true); //show loader
            }
        }

        var json = JSON.stringify({
            request: funcName,
            data: data
        });

        var xhr = new XMLHttpRequest();
        xhr.open("POST", urlgate, true);
        xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');

        xhr.onreadystatechange = function (data){
            if(xhr.readyState == XMLHttpRequest.DONE){
                inLoad--;
                if (loaderCallback && inLoad == 0) {
                    loaderCallback(false);
                }

                if (xhr.status == 200){
                    var response = JSON.parse(xhr.responseText);
                    if (response.needReload) {
                        location.reload(true);
                    }else{
                        if (response.error == false){
                            console.log('success of '+funcName);
                            console.log(response);

                            if (onSuccess){
                                onSuccess(response.data);
                            }
                        }else{
                            if (onError){
                                onError(response.message ? response.message : null);
                            }else{
                                if (defaultErrorCallback){
                                    defaultErrorCallback(response.message ? response.message : null);
                                }
                            }
                        }
                    }
                }else{
                    if (onError){
                        onError("Server answered with status " + xhr.status);
                    }else{
                        if (defaultErrorCallback){
                            defaultErrorCallback(response.message ? response.message : null);
                        }
                    }
                }
            }
        };

        console.log('request '+funcName);
        console.log(data);
        xhr.send(json);
    }

    static setDefaultErrorCallback(callback) {
        defaultErrorCallback = callback;
    }

    static setLoaderCallback(callback) {
        loaderCallback = callback;
    }
};
