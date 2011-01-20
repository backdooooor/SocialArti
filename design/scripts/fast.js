
$(document).ready(function () {
doOnline();
getFastMessage();
setTimeout(doOnline, 1000);
setTimeout(getFastMessage, 1002);
});
function doOnline(){
 	$.post(
  '/./index.php/ajax/doOnlineUsers/',
  {


     },
 function(data){
$("#user_online").html(data);
 }
);
}
function getFastMessage(){
 	$.post(
  '/./index.php/ajax/doListFastMessage/',
  {


     },
 function(data){
$("#message").html(data);
 }
);
}

function doSendMessage(){

    var mesg=$("#text_mes").val();

    
  if(mesg==null  || mesg=="") return false;

                  	$.post(
  '/./index.php/ajax/doSendFastMessage/',
  {
 text:mesg
     },
 function(data){
if(data=="1"){
    $("#text_mes").text("");
    getFastMessage();
  
}else {
    alert('Возникла ошибка!');
}

 }
);

}