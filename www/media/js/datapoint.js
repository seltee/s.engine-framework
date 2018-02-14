var urlgate = '/datapoint.php';

var noLoader = [];
var inLoad = 0;
var defaultErrorCallback = null;


var datapoint = {
    call: function(funcName, data, onSuccess, onError){
        if (noLoader.indexOf(funcName) == -1) {
            inLoad++;
            $(".main-loader").stop().fadeIn(300);
        }

        $.ajax({
            method: "POST",
            url: urlgate,
            dataType: 'json',
            data: {
                request: funcName,
                data: data
            },

            success: function( response ) {
                console.log(funcName + ': success');
                console.log( response );
                if (noLoader.indexOf(funcName) == -1) {
                    inLoad--;
                    if (inLoad == 0) {
                        $(".main-loader").stop().fadeOut(300);
                    }
                }

                if (response.needReload){
                    location.reload(true);
                }else {
                    if (onSuccess && response.error === false) {
                        onSuccess(response.data ? response.data : null);
                    }
                    if (response.error === true) {
                        if (onError) {
                            onError(response.message ? response.message : null);
                        } else {
                            if (defaultErrorCallback){
                                defaultErrorCallback(response.message ? response.message.errorMessage : null);
                            }
                        }
                    }
                }
            },

            error: function( response ) {
                console.log(funcName + ': error');
                console.log( response );

                if (noLoader.indexOf(funcName) == -1) {
                    inLoad--;
                    if (inLoad == 0) {
                        $(".main-loader").stop().fadeOut(300);
                    }
                }

                if (onError) {
                    onError(response.message ? response.message : null);
                }else{
                    if (defaultErrorCallback){
                        defaultErrorCallback(response.message ? response.message.errorMessage : null);
                    }
                }
            },
        });
    },
    setDefaultErrorCallback: function(callback){
        defaultErrorCallback = callback;
    }
};