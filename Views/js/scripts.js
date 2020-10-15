function validateAlert (idAlert, message){
    var alert = $("#"+idAlert);

    if(message == ''){
         alert.hide();
    }
    else {
         alert.show();
    }
}