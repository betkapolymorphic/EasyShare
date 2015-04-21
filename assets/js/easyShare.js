/**
 * Created by Alexeev on 20-Apr-15.
 */

var myDropzone = new Dropzone("#drop-section", { url: "/post-file.php",maxFilesize: 8});
var $progres_bar =  $('.progress-bar'),
    $progres = $(".progress");
var needHideInnerInfo = false;
myDropzone.on("error", function() {
  // $('.dz-preview').remove();
    needHideInnerInfo=true;
});
myDropzone.on("addedfile", function() {
    // $('.dz-preview').remove();
    if(needHideInnerInfo)
        $('.dz-preview').first().remove();
});
myDropzone.on('uploadprogress',function(file, progress, bytesSent) {
   console.log(progress);
   $progres_bar.css('width',progress+"%");
    $progres.show();
});


myDropzone.on('success',function(a,resp){
    console.log(resp);
    resp=JSON.parse(resp.trim());
    if(resp.code!='0'){
        alert("Error :"+resp.text);
        return;
    }
    resp = resp.text;
    showModal(resp.trim());


    $('.dz-message').hide();
    myDropzone.disable();

    currentTime = 60*20;//20min
    var interval = setInterval(function(){
        if(currentTime--<1){
            clearInterval(interval);
            $('.counter-down .digit').text("0(file deleted)");
        }else{
            var min = Math.floor(currentTime/60);
            var sec = Math.floor(currentTime%60);
            $('.counter-down .digit').text((min<10?("0"+min):min)+":"+(sec<10?("0"+sec):sec));
        }

    }, 1000);
    $('#drop-section').bind('click',function(){
        $('#link-modal').modal('show');
    });
});

$progres.hide();
var qrcode = new QRCode("qrcode");


var currentTime = 60*20;//20min








function showModal(link){

   qrcode.clear();
    qrcode.makeCode(link);
    $("#link-href").attr('href',link).text(link);
    $('#link-modal').modal('show');
}
