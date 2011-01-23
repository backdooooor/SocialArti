
var base_url="http://arti.nx0.ru/";
var auth=false;

function begin(){
   
  	$.post(
  '/./index.php/ajax/checkAuth/',
  {

     },
 function(data){
if(data=="1"){
     auth=true;
     
    
     $("#isauth").show();
doUpdate();

}else {
  $("#isauth").hide();
  doNotAuth();
}

 }
);
 
     
    
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
if(auth==true) {
                myMicronews();
}
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
  jQuery("#auth_title").activateSlide();
//$("#reg_error").html("Вы успешно зарегистрировались!!");

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
   if(auth==true){
$("#auth_title").html("Моя страница");
$("#auth").html(data);
$("#reg_title").html("Поиск..");
$("#reg").html("<h2>Человекоидный поиск</h2><p ><form onsubmit='doSearch();return false'><input type=text size=65 id='search'><br/><input type=submit value='Поиск...'></form><br><div id='result'></div></p>")

$("#first_title").html("МикроNews");
$("#pos_title").html("Мои друзья");
getFriends();
   }
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
      function doGroupNews(id_group){


                   	$.post(
  '/./index.php/ajax/doGroupNews/' + id_group,
  {

     },
 function(data){

$("#first").html("<h2>Новости</h2><p>"+data+"</p>")

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
 setTimeout(checkNewMessage, 1000);
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
  if(data!="") {
 $("#windowTopContent").html("Запросы на добавление в друзья ");
 $("#windowContent").html(data);
 $("#window").show();
  }
 
    setTimeout(getRequest, 1001);
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

doNotify("Контактные данные успешно обновлены!");
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
                                                            
                                                            doNotify('При загрузке файла произошла ошибка,попробуйте еще раз');
                                                        } else {
							this.enable();
                                                        $("#user_photo").attr("src", response);
                                                         
                                                         doNotify("успешно загружено!");
                                                         myMicronews();
                                                        }
							// РїРѕРєР°Р·С‹РІР°РµРј С‡С‚Рѕ С„Р°Р№Р» Р·Р°РіСЂСѓР¶РµРЅ
							//$("<li>" + file + "</li>").appendTo("#files");

						}
					});
                   

 }
  function doLoadAvatar(id_group){


var button = $('#load_avatar');
  $.ajax_upload(button, {
						action : 'statics/load_avatar/' + id_group ,
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

                                                            doNotify('При загрузке файла произошла ошибка,попробуйте еще раз');
                                                        } else {
							this.enable();
                                                        $("#group_avatar").attr("src", response);

                                                         doNotify("успешно загружено!");
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
doNotify("Ваш комментарий успешно добавлен!");
$("#id_"+id_mnews).html(data);

 }
);

 }
 function doSaveNS(){
  var edit_name=$("#name").val();
  var edit_surname=$("#surname").val();
       $.post(
  '/./index.php/ajax/doEditNS/',
  {
  name:edit_name,
  surname:edit_surname
     },
 function(data){
doNotify("Ваши данные успешно сохранены!");

 }
);

 }
 function doNotify(text){
   $("#windowTopContent").html("Уведомление");
 $("#windowContent").html(text);
 $("#window").show();
 }
 function doCreateGroup(){
     if(auth){
 var text="<h2>Создание группы</h2><form onSubmit='CreateGroup();return false;'>Название группы<br>\n\
<input id='gr_name' type=text  /><br> \n\
Описание Группы<br>\n\
<textarea  id='gr_description'rows=3 cols=35></textarea><br>\n\
<input type=submit value='Создать'><div id='gr_error'></div></form>";
            $("#windowTopContent").html("Создание группы");
 $("#windowContent").html(text);
 $("#window").show();
     }
 }
 function CreateGroup(){
     var  group_name=$("#gr_name").val();

     var  group_description=$("#gr_description").val();
     if(group_name=="" || group_name==null)  {
         $("#gr_error").html("Вы не заполнили название группы!");
         return false;
     }
     if(group_description==null || group_description=="") {
         $("#gr_error").html("Вы не заполнили описание группы!");
         return false;
     }
       $("#gr_error").html("");
         $.post(
  '/./index.php/ajax/addGroup/',
  {
  name:group_name,
  text:group_description
     },
 function(data){
if(data=="1")
    {
        $("#window").hide();
        myMicronews();
        doNotify("Группа успешно создана!");

    }else {
       $("#gr_error").html("Произошла ошибка");
    }

 }
);
 }
 function doTalk(){
 jQuery("#pos_title").activateSlide();
 }
 function doPartipians(){
     jQuery("#reg_title").activateSlide();
 }
 function doNews(){
     jQuery("#first_title").activateSlide();
 }
  function doContent(){
      jQuery("#auth_title").activateSlide();
 }
     function  doGo(){
      var  hash=window.location.hash;
      switch(hash){
       case "#users":
           doPartipians();
           break;
       case "#talks":
           doTalk();
           break;
       case "#news":
           doNews();
           break;
       case "#main":
           doContent();
           break;
      }
    }
 function setStatusGroup(id_group){

  

     var mnews=$("#status_group").val();
                     	$.post(
  '/./index.php/ajax/addGroupNews/',
  {
 text:mnews,
 group:id_group
     },
 function(data){
if(data=="1") {
    doNotify("Новость успешно опубликована!");
    doGroupNews(id_group);
    $("#status_group").text("");
}else {
    doNotify("Произошла ошибка...");
}

 }
);
 }

 function doEditGroup(id_group){
var group_name=$("#group_name").val();
var group_desc=$("#group_description").val();
if(group_name=="") {
    doNotify("Название групы не может быть пустым");
    return false;
}
  	$.post(
  '/./index.php/ajax/doSaveGroup/' + id_group,
  {
description:group_desc,
name:group_name

     },
 function(data){

 }
);

doNotify("Контактные данные успешно обновлены!");
}
function doJoinGroup(id_group){
 	$.post(
  '/./index.php/ajax/doJoinGroup/' + id_group,
  {


     },
 function(data){
if(data="1"){
    $("#group_user").html("Выйти из группы");
    $("#group_user").attr("onclick", "doExitGroup("+id_group+");return false;");
    doNotify("Вы успешно вступили в группу");
}
 }
);
}
function doExitGroup(id_group){
 	$.post(
  '/./index.php/ajax/doExitGroup/' + id_group,
  {


     },
 function(data){

if(data=="1"){
    $("#group_user").html("Вступить в группу");
    $("#group_user").attr("onclick", "doJoinGroup("+id_group+");return false;");
    doNotify("Вы успешно покинули группу");
}
 }
);
}
function getTalks(id_talks){
window.location.hash="#talks";
 	$.post(
  '/./index.php/ajax/getTalks/' + id_talks,
  {


     },
 function(data){

$("#pos").html(data);
 }
);
}
function addTalk(id_group,id_talk,opt){
 if(id_talk=="" || id_talk==null) id_talk=0;
 if(id_group=="" || id_group==null) return false;
 var forum_text=$("#forum_text").val();
 if(forum_text=="" || forum_text==null) return false;
if(opt==0)  {
 var titles="";}
else {
    
    var titles=$("#forum_title").val();
    if(titles=="" || titles==null) return false;
}
 	$.post(
  '/./index.php/ajax/addTalk/' + id_group + "/" + id_talk,
  {
   text:forum_text,
   title:titles

     },
 function(data){
       //alert(data);
     if(opt!=0){
         $("#forum_text").text("");
       
            getTalks(data);
     }else{
            $("#forum_text").text("");
            getTalks(id_talk);
     }
            doNotify("Сообщение успешно опубликовано!");
            
 }
);
}
function doTalks(id_group){
 window.location.hash="#talks";
 $("#pos").html("<form onSubmit='addTalk("+id_group+",0,1);return false;'>Название обсуждения<br><input type=text id='forum_title'><br>Текст сообщения<br><textarea id='forum_text' rows=3 cols=35></textarea><br><input type=submit value='Опубликовать'></form>");
}
function listTalk(id_group){
    window.location.hash="#talks";
    	$.post(
  '/./index.php/ajax/listTalk/' + id_group,
  {


     },
 function(data){

$("#pos").html(data);
 }
);
}
function fastWindow(){
 if(auth){
 window.open('fast','child','width=700px,height=500px');
 }
}
function doFlash(){
    if(!auth) {
        return false;
    }
   	$.post(
  '/./index.php/ajax/doListFlash/',
  {
  

     },
 function(data){
       //alert(data);
     if(data=="") data="Приложения не найдены!";
     
      $("#windowTopContent").html("Приложения");
  $("#windowContent").html(data);
    $("#window").show();
 }
);
}
function showFlash(id){
 

var str= $("#flash_"+id).html();

 $("#windowTopContent").html("Приложение");
  $("#windowContent").html(str);
    $("#window").css('width','400px');
     $("#window").css('height','400px');
  $("#windowContent").css('width','400px');
   $("#windowContent").css('height','400px');
    $("#window").show();
}
function getBlog(id_user){
    	$.post(
  '/./index.php/ajax/getArticle/' + id_user,
  {


     },
 function(data){
      
     if(data=="") data="Статьи не найдены!";

      $("#windowTopContent").html("Статьи");
  $("#windowContent").html(data);
    $("#window").show();
 }
);
}
function doArticle(id){
     	$.post(
  '/./index.php/ajax/doArticle/' + id,
  {


     },
 function(data){

     if(data=="") data="Статья не найдена!";

      $("#windowTopContent").html("Статья");
  $("#windowContent").html(data);
    $("#window").show();
 }
);
}
function doNewArticle(){
 if(!auth) {
     return false;
 }
 var tmp='<form onSubmit="addArticle();return false;">Название<br>\n\
<input type=text  value="" id="article_title"><br>Текст статьи(HTML OFF)<br><textarea id="article_text" rows=6 cols=35></textarea><br>\n\
<input type=submit value="Создать"></form>';
  $("#windowTopContent").html("Создание статьи");
  $("#windowContent").html(tmp);
    $("#window").show();
}
function addArticle(){
   var arti_title=$("#article_title").val();
   var arti_text=$("#article_text").val();
   
        	$.post(
  '/./index.php/ajax/newArticle/',
  {
text:arti_text,
title:arti_title

     },
 function(data){

     if(data!="1") {data="При публикации произошла ошибка";}
     else {
         data="Статья успешно опубликована!";
         myMicronews();
     }
      $("#windowTopContent").html("Статья");
  $("#windowContent").html(data);
    $("#window").show();
 }
);
}


