/**
 * Created by Alexeev on 20-Apr-15.
 */

var myDropzone = new Dropzone("#drop-section", { url: "/post-file.php"});
var $progres_bar =  $('.progress-bar'),
    $progres = $(".progress");
myDropzone.on("complete", function(file) {

});

myDropzone.on('uploadprogress',function(file, progress, bytesSent) {
   console.log(progress);
   $progres_bar.css('width',progress+"%");
    $progres.show();
});
myDropzone.on('success',function(a,resp){
   showModal(resp);
    console.log(resp);
});

$progres.hide();
var qrcode = new QRCode("qrcode");
showModal('afro');

var currentTime = 60*20;//20min

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

function showModal(link){

   qrcode.clear();
    qrcode.makeCode(link);
    $("#link-href").attr('href',link).text(link);
    $('#link-modal').modal('show');
}
