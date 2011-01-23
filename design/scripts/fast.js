 setTimeout(doOnline, 501);
setTimeout(getFastMessage, 500);
$(document).ready(function () {

//$('a').click(function(){
//    alert(this.href);
//  if(this.href!=null){
//      window.opener.location.href=this.href;
//  }
//  return false;
//});

doOnline();
getFastMessage();
fast_begin();
});
function ctrlEnter(event)
    {
    if((event.ctrlKey) && ((event.keyCode == 0xA)||(event.keyCode == 0xD)))
        {
        doSendMessage();
        }
    }
function fast_begin(){
   
}
function doOnline(){
 	$.post(
  '/./index.php/ajax/doOnlineUsers/',
  {


     },
 function(data){
$("#user_online").html(data);
 setTimeout(doOnline, 503);
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
setTimeout(getFastMessage, 505);
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
function fastURL(url){

    window.opener.location.href=url.href;
    
}
