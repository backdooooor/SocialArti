
var base_url="http://socialarti.me/";
var auth=false;
function begin(){
  	$.post(
  '/./index.php/ajax/checkAuth/',
  {

     },
 function(data){
if(data=="1"){
     auth=true;
     
    setTimeout(checkNewMessage, 1000);
     $("#isauth").show();
doUpdate();

}else {
  $("#isauth").hide();
  doNotAuth();
}

 }
);
 $('#accordion-2').easyAccordion({
			autoStart: false
	});
     
    
}
function doNotAuth(){

$("#auth_title").html("Авторизация");
$("#auth").html('<h2>Авторизация</h2><p> <div id="auth_error"></div><br/><form  method="POST" onSubmit="doAuth();return false;">email <br/><input type="text" name="email" id="email" /><br/>Пароль <br/><input type="password" name="pass" id="pass" /><br/><input type="submit" value="Войти"/></form></p>');
$("#reg_title").html("Регистрация");
$("#reg").html('<h2>Регистрация</h2><p><div id="reg_error"></div><br/><form  method="POST" onSubmit="doRegister();return false;">email <br/><input type="text" name="email" id="reg_email" /><br/>Фамилия<br/><input type="text" name="surname" id="reg_surname" /><br/>Имя <br/><input type="text" name="name" id="reg_name" /><br/>Отчество <br/><input type="text" name="otch" id="reg_otch" /><br/>Откуда ты<br/><input type="text" name="location" id="reg_location" /><br/>Пароль <br/><input type="password" name="pass1" id="reg_pass1" /><br/>Повтор Пароля <br/><input type="password" name="pass2" id="reg_pass2" /><br/><input type="submit" value="Регистрация"/></form> </p>');
$("#first_title").html("Введение");
$("#first").html("<h2>Введение</h2><p>Здесь будет какой то текст о великой socialArti</p>");

$("#pos").html("<h2>О проекте</h2><p>Здесь будет какой то текст о великом Артемии</p>");
$("#pos_title").html("О проекте!");
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
 auth=true;
$("#auth").html("Вы успешно авторизовались!!");
$("#isauth").show();
doUpdate();
                myMicronews();
}else {
    auth=false;
  $("#auth_error").html("Некорректные данные!!!");
}

 }
);
    }
    function doRegister(){
     var regexp = /^[а-яёa-z0-9]+$/i;
     if(!/^\w+[a-zA-Z0-9_.-]*@{1}\w{1}[a-zA-Z0-9_.-]*\.{1}\w{2,4}$/.test(jQuery("#reg_email").val())) {
	    $("#reg_error").html("email некорректный");
	    return false;
	    }
  if($("#reg_pass1").val()!=$("#reg_pass2").val() || $("#reg_pass1").val()==""  ){
        $("#reg_error").html("пароли должны совпадать ");
	    return false;

  }
  if(!regexp.test($("#reg_name").val())){
	   $("#reg_error").html("Некорректное значение(Имя)");
	    return "";
	}
          if(!regexp.test($("#reg_surname").val())){
	   $("#reg_error").html("Некорректное значение(Фамилия)");
	    return "";
	}
            if(!regexp.test($("#reg_otch").val())){
	   $("#reg_error").html("Некорректное значение(Отчество)");
	    return "";
	}
         
        var str1=$("#reg_email").val();
        var str2=$("#reg_pass1").val();
        var str3=$("#reg_name").val();
        var str4=$("#reg_surname").val();
        var str5=$("#reg_otch").val();
        var str6=$("#reg_location").val();

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

if(data=="1"){
$("#reg_error").html("Вы успешно зарегистрировались!!");

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
$("#reg_title").html("Поиск..");
$("#reg").html("<h2>Человекоидный поиск</h2><p ><form onsubmit='doSearch();return false'><input type=text size=65 id='search'><br/><input type=submit value='Поиск...'></form><br><div id='result'></div></p>")
$("#first_title").html("МикроNews");
$("#pos_title").html("Мои друзья");
getFriends();
 }
);

    }
  
       function doUpdate_profile(){
               	$.post(
  '/./index.php/ajax/doMy/',
  {

     },
 function(data){

$("#auth_title").html("Cтраница пользователя");

$("#reg_title").html("Поиск..");
$("#reg").html("<h2>Человекоидный поиск</h2><p ><form onsubmit='doSearch();return false'><input type=text size=65 id='search'><br/><input type=submit value='Поиск...'></form><br><div id='result'></div></p>")
$("#first_title").html("МикроNews");
$("#first").html("<h2>МикроNews</h2><p>здесь какие то интересные новости</p>");
$("#pos_title").html("Мои друзья");
getFriends();
 }
);

    }
    function doSearch(){
     var str=$("#search").val();
     
//$("#result").html("Попытка что то найти,ну разве это не круто аа?))" + $("#search").val());
              	$.post(
  '/./index.php/ajax/doSearch/',
  {
search:str
     },
 function(data){

$("#result").html(data);

 }
);
    }
    function getFriends(){
                	$.post(
  '/./index.php/ajax/doListFriends/',
  {

     },
 function(data){
$("#pos").html("<h2>Мои друзья</h2><p>"+data+"</p>")

 }
);
    }
    function myMicronews(){
   
     
                   	$.post(
  '/./index.php/ajax/getMicroNews/',
  {

     },
 function(data){

$("#first").html("<h2>МикроNews</h2><p>"+data+"</p>")

 }
);
    }
    function setStatus(){
     var statuss=$("#status").val();
                    	$.post(
  '/./index.php/ajax/setStatus/',
  {
 status:statuss
     },
 function(data){

myMicronews();

 }
);

    }
    function getMessage(){
                      	$.post(
  '/./index.php/ajax/getMessage/',
  {

     },
 function(data){
 $("#windowTopContent").html("Входящие сообщения");
  $("#windowContent").html(data);

    $("#window").show();

 }
);
     
    }
function doNewMessage(){
 $("#windowTopContent").html("Написать новое сообщение");
 $("#windowContent").html("<form  method='POST' onSubmit='doSendMessage();return false;'>Кому <select name='fancySelect' id='to_user' class='makeMeFancy'> </select><br>Текст сообщения <br><textarea  name='name_text' id='text_mes' rows=3 cols=35></textarea><br><input type=submit value='Отправить'></form>");
  doMasSelect();

  $("#window").show();


}
function doSelect(){
	// Элемент select, который будет замещаться:
	var select = $('select.makeMeFancy');

	var selectBoxContainer = $('<div>',{
		width		: select.outerWidth(),
		className	: 'tzSelect',
		html		: '<div class="selectBox"></div>'
	});

	var dropDown = $('<ul>',{className:'dropDown'});
	var selectBox = selectBoxContainer.find('.selectBox');

	// Цикл по оригинальному элементу select

	select.find('option').each(function(i){
		var option = $(this);

		if(i==select.attr('selectedIndex')){
			selectBox.html(option.text());
		}

		// Так как используется jQuery 1.4.3, то мы можем получить доступ
		// к атрибутам данных HTML5 с помощью метода data().

		if(option.data('skip')){
			return true;
		}

		// Создаем выпадающий пункт в соответствии
		// с иконкой данных и атрибутами HTML5 данных:

		var li = $('<li>',{
			html:	'<img width=50px height=50 src="'+option.data('icon')+'" /><span>'+
					option.data('html-text')+'</span>'
		});

		li.click(function(){

			selectBox.html(option.text());
			dropDown.trigger('hide');

			// Когда происходит событие click, мы также отражаем
			// изменения в оригинальном элементе select:
			select.val(option.val());

			return false;
		});

		dropDown.append(li);
	});

	selectBoxContainer.append(dropDown.hide());
	select.hide().after(selectBoxContainer);

	// Привязываем пользовательские события show и hide к элементу dropDown:

	dropDown.bind('show',function(){

		if(dropDown.is(':animated')){
			return false;
		}

		selectBox.addClass('expanded');
		dropDown.slideDown();

	}).bind('hide',function(){

		if(dropDown.is(':animated')){
			return false;
		}

		selectBox.removeClass('expanded');
		dropDown.slideUp();

	}).bind('toggle',function(){
		if(selectBox.hasClass('expanded')){
			dropDown.trigger('hide');
		}
		else dropDown.trigger('show');
	});

	selectBox.click(function(){
		dropDown.trigger('toggle');
		return false;
	});

	// Если нажать кнопку мыши где-нибудь на странице при открытом элементе dropDown,
	// он будет спрятан:

	
}
function doSendMessage(id_users){
  
    var mesg=$("#text_mes").val();
 
     var objSel=document.getElementById("to_user");

   
    if ( objSel.selectedIndex != -1 || id_users==null)
{
  //Если есть выбранный элемент, отобразить его значение (свойство value)
  //alert(objSel.options[objSel.selectedIndex].value);
  if(objSel.options[objSel.selectedIndex].value!="0"){
id_users=objSel.options[objSel.selectedIndex].value

    
  }
  if(id_users==null) return false;

                  	$.post(
  '/./index.php/ajax/newMessage/',
  {
 id_user:id_users,
 text:mesg
     },
 function(data){
if(data=="1"){
    $("#window").hide();
}

 }
);
}
}
function  doMasSelect(){

             	$.post(
  '/./index.php/ajax/doSelect/',
  {

     },
 function(data){
$("#to_user").html(data);
            doSelect();
 }
);
}
function doTO_User(id_user,title){

 
    var str="<option value="+id_user+" data-skip='1' data-html-text='"+title+"'>"+title+"</option>"
      $("#windowTopContent").html("Написать новое сообщение для " + title);
 $("#windowContent").html("<form  method='POST' onSubmit='doSendMessage("+id_user+");return false;'>Кому <select name='fancySelect' id='to_user' class='makeMeFancy'>"+str+"</select><br>Текст сообщения <br><textarea  name='name_text' id='text_mes' rows=3 cols=35></textarea><br><input type=submit value='Отправить'></form>");
  doSelect();

  $("#window").show();
 
}

function doRead(id_message){
    if(id_message==null) return false;
        	$.post(
  '/./index.php/ajax/doReadMessage/' + id_message,
  {

     },
 function(data){

 }
);
}
function checkNewMessage(){

         	$.post(
  '/./index.php/ajax/checkNewMessage/',
  {

     },
 function(data){
if(data!="0"){
 $("#incmessage").html('<img src="'+base_url+'design/menu/hot.png" width="50px" height="50px" title="У вас '+ data +'  новых сообщений" />')
}else {
$("#incmessage").html('<img src="'+base_url+'design/menu/incomming.png" width="50px" height="50px" title="Входящие сообщения" />');

}
 }
);
}
function logout(str){
  	$.post(
  '/./index.php/ajax/logout/',
  {

     },
 function(data){
if(str=="1"){
begin();
} else {
       	$.post(
  '/./index.php/ajax/checkAuth/',
  {

     },
 function(data){
if(data=="1"){
 auth=true;
$("#isauth").show();
doUpdate_profile();
 myMicronews();
}else {
  $("#isauth").hide();
  doNotAuth();
}

 }
);
}
 }
);
}
function doAddFriends(id_user,title,foto){
  $("#windowTopContent").html("Добавить в друзья " + title);
 $("#windowContent").html("<table><tr><td>"+ title+"<img src='"+foto+"' width='100px' height='100px'/></td><td><form onSubmit='addFriend("+id_user+")'>Вы уверены что знаете этого человека?<a id='link_zapros' href='#' onclick='doShow_form();'>Добавить текст<a><br><textarea rows=3 cols=20 id='zapros_text' style='display:none'></textarea><br><input type=submit value='Добавить в друзья'></form></td></tr></table>");


  $("#window").show();
}
function doShow_form(){
    $("#link_zapros").hide();
    $("#zapros_text").show();
}

function addFriend(id_user){
    var zapr_text=$("#zapros_text").val();
    if(id_user==null) return false;
          	$.post(
  '/./index.php/ajax/addfriends/' + id_user,
  {
   text:zapr_text
     },
 function(data){
     $("#window").hide();
 }
);
}
function getRequest(){
           	$.post(
  '/./index.php/ajax/doRequest/',
  {
  
     },
 function(data){
 $("#windowTopContent").html("Запросы на добавление в друзья ");
 $("#windowContent").html(data);
 $("#window").show();
 }
);
}
function doEditFriend(id_zapr,bool){
 


       	$.post(
  '/./index.php/ajax/doEditFriend/'+ id_zapr +'/' + bool,
  {

     },
 function(data){

 $("#window").hide();
 }
);
}

function doSaveContact(){
var edit_icq=$("#edit_icq").val();
var edit_jabber=$("#edit_jabber").val();
var edit_skype=$("#edit_skype").val();
  	$.post(
  '/./index.php/ajax/doEditContact/',
  {
icq:edit_icq,
jabber:edit_jabber,
skype:edit_skype
     },
 function(data){

 }
);
alert('Контактные данные успешно обновлены!');
}
 function doLoadPhoto(){

 
var button = $('#load_photo');
  $.ajax_upload(button, {
						action : 'statics/load_photo',
						name : 'myfile',
						onSubmit : function(file, ext) {
							// РїРѕРєР°Р·С‹РІР°РµРј РєР°СЂС‚РёРЅРєСѓ Р·Р°РіСЂСѓР·РєРё С„Р°Р№Р»Р°
				

							/*
							 * Р’С‹РєР»СЋС‡Р°РµРј РєРЅРѕРїРєСѓ РЅР° РІСЂРµРјСЏ Р·Р°РіСЂСѓР·РєРё С„Р°Р№Р»Р°
							 */
							this.disable();

						},
						onComplete : function(file, response) {
							// СѓР±РёСЂР°РµРј РєР°СЂС‚РёРЅРєСѓ Р·Р°РіСЂСѓР·РєРё С„Р°Р№Р»Р°
							//$("img#load").attr("src", "loadstop.gif");
							//$("#uploadButton font").text('Р—Р°РіСЂСѓР·РёС‚СЊ');

							// СЃРЅРѕРІР° РІРєР»СЋС‡Р°РµРј РєРЅРѕРїРєСѓ
                                                        
                                                        if(response=="0"){
                                                            alert('При загрузке файла произошла ошибка,попробуйте еще раз')
                                                        } else {
							this.enable();
                                                        $("#user_photo").attr("src", response);
                                                         alert('успешно загружено!');
                                                         myMicronews();
                                                        }
							// РїРѕРєР°Р·С‹РІР°РµРј С‡С‚Рѕ С„Р°Р№Р» Р·Р°РіСЂСѓР¶РµРЅ
							//$("<li>" + file + "</li>").appendTo("#files");

						}
					});
                   

 }
 function doComment(id_mnews){
    
     $.post(
  '/./index.php/ajax/doComment/' + id_mnews,
  {

     },
 function(data){
 
$("#id_"+id_mnews).html(data);

 }
);
 }
 function doAddComment(id_mnews){

  var text_comment=$("#form_comment").val();
       $.post(
  '/./index.php/ajax/addComment/' + id_mnews,
  {
  text:text_comment
     },
 function(data){

$("#id_"+id_mnews).html(data);

 }
);

 }