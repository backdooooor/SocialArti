/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
begin();
function begin(){
  	$.post(
  '/./index.php/ajax/checkAuth/',
  {

     },
 function(data){
if(data=="1"){
doUpdate();

}
alert(data);
 }
);
    
}
    function doAuth(){
if(!/^\w+[a-zA-Z0-9_.-]*@{1}\w{1}[a-zA-Z0-9_.-]*\.{1}\w{2,4}$/.test(jQuery("#email").val())) {
	    $("#auth_error").html("email некорректный");
	    return false;
	    }
  if($("#pass").val()==""){
        $("#auth_error").html("пароль не может быть пустым!");
	    return false;

  }

var str1=$("#email").val();
var str2=$("#pass").val();
        	$.post(
  '/./index.php/ajax/auth/',
  {
    email:str1,
    password:str2
     },
 function(data){
    
$("auth_error").html("");
if(data=="1"){
$("#auth").html("Вы успешно авторизовались!!");
}else {
  $("#auth_error").html("Некорректные данные!!!");
}

 }
);
    }
    function doRegister(){
     if(!/^\w+[a-zA-Z0-9_.-]*@{1}\w{1}[a-zA-Z0-9_.-]*\.{1}\w{2,4}$/.test(jQuery("#reg_email").val())) {
	    $("#reg_error").html("email некорректный");
	    return false;
	    }
  if($("#reg_pass1").val()!=$("#reg_pass2").val() || $("#reg_pass1").val()==""  ){
        $("#reg_error").html("пароли должны совпадать ");
	    return false;

  }
  if(!/^\w+[a-zA-Z0-9_.-]+$/.test($("#reg_name").val())){
	   $("#reg_error").html("Некорректное значение(Имя)");
	    return "";
	}
          if(!/^\w+[a-zA-Z0-9_.-]+$/.test($("#reg_surname").val())){
	   $("#reg_error").html("Некорректное значение(Фамилия)");
	    return "";
	}
            if(!/^\w+[a-zA-Z0-9_.-]+$/.test($("#reg_otch").val())){
	   $("#reg_error").html("Некорректное значение(Отчество)");
	    return "";
	}
            if(!/^\w+[a-zA-Z0-9_.-]+$/.test($("#reg_location").val())){
	   $("#reg_error").html("Некорректное значение(Расположение)");
	    return "";
	}
        var str1=$("#reg_email").val();
        var str2=$("#reg_pass1").val();
        var str3=$("#reg_name").val();
        var str4=$("#reg_surname").val();
        var str5=$("#reg_otch").val();
        var str6=$("reg_location").val();

            	$.post(
  '/./index.php/ajax/register/',
  {
    email:str1,
    password:str2,
    name:str3,
    surname:str4,
    otch:str5,
    from:str6
     },
 function(data){
alert(data);
if(data=="1"){
$("#reg_error").html("Вы успешно зарегистрировались!!");
doUpdate();
}else {
  $("#reg_error").html("Некорректные данные!!!");
}

 }
);

    }
    function doUpdate(){
               	$.post(
  '/./index.php/ajax/doMy/',
  {
   
     },
 function(data){
    
$("#auth_title").html("Моя страница");
$("#auth").html(data);
 }
);

    }