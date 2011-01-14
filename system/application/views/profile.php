<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	  <title>{title}</title>

      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf8" />

      <!-- Scripts -->
      <script type="text/javascript" src="<? echo base_url();?>design/scripts/jquery.min.js"></script>
	  <script type="text/javascript" src="<? echo base_url();?>design/scripts/jquery.easyAccordion.js"></script>
      <script type="text/javascript" src="<? echo base_url();?>design/scripts/profile.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/UI.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/interface.js"></script>
<link rel="stylesheet" href="<? echo base_url();?>design/style.css" type="text/css" media="screen, projection" />
<script type="text/javascript">
    
      	$.post(
  '/./index.php/ajax/checkAuth/',
  {

     },
 function(data){
if(data=="1"){
 auth=true;
$("#isauth").show();
doUpdate_profile();

 setTimeout(checkNewMessage, 1000);
}else {
  $("#isauth").hide();
}

 }
);
</script>
      <style type="text/css">
 html{font-size:62.5%; }
		  body{font-size:1.2em;color:#294f88}
		  .sample{margin:30px;border:1px solid #92cdec;background:#d7e7ff;padding:30px}
		  h1{margin:0 0 20px 0;padding:0;font-size:2em;}
		  h2{margin:40px 0 20px 0;padding:0;font-size:1.6em;}
		  .easy-accordion h2{margin:0px 0 20px 0;padding:0;font-size:1.6em;}
		  p{font-size:1.2em;line-height:170%;margin-bottom:20px}


		/* UNLESS YOU KNOW WHAT YOU'RE DOING, DO NOT CHANGE THE FOLLOWING RULES */

		.easy-accordion{display:block;position:relative;overflow:hidden;padding:0;margin:0}
		.easy-accordion dt,.easy-accordion dd{margin:0;padding:0}
		.easy-accordion dt,.easy-accordion dd{position:absolute}
		.easy-accordion dt{margin-bottom:0;margin-left:0;z-index:5;/* Safari */ -webkit-transform: rotate(-90deg); /* Firefox */ -moz-transform: rotate(-90deg);-moz-transform-origin: 20px 0px;  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);cursor:pointer;}
		.easy-accordion dd{z-index:1;opacity:0;overflow:hidden}
		.easy-accordion dd.active{opacity:1;}
		.easy-accordion dd.no-more-active{z-index:2;opacity:1}
		.easy-accordion dd.active{z-index:3}
		.easy-accordion dd.plus{z-index:4}
		.easy-accordion .slide-number{position:absolute;bottom:0;left:10px;font-weight:normal;font-size:1.1em;/* Safari */ -webkit-transform: rotate(90deg); /* Firefox */ -moz-transform: rotate(90deg);  /* Internet Explorer */ filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1);}


		/* FEEL FREE TO CUSTOMIZE THE FOLLOWING RULES */

		dd p{line-height:120%; overflow: auto;}



		#accordion-2{width:700px;height:500px;padding:30px;background:#fff;border:1px solid #b5c9e8}
		#accordion-2 h2{font-size:2.5em;margin-top:10px}
		#accordion-2 dl{width:700px;height:500px}
		#accordion-2 dt{line-height:44px;text-align:right;padding:10px 15px 0 0;font-size:1.1em;font-weight:bold;font-family: Tahoma, Geneva, sans-serif;text-transform:uppercase;letter-spacing:1px;background:#fff url(images/slide-title-inactive-2.jpg) 0 0 no-repeat;color:#26526c}
		#accordion-2 dt.active{cursor:pointer;color:#fff;background:#fff url(design/images/slide-title-active-2.jpg) 0 0 no-repeat}
		#accordion-2 dt.hover{color:#68889b;}
		#accordion-2 dt.active.hover{color:#fff}
		#accordion-2 dd{    overflow: auto;padding:25px;background:url(design/images/slide.jpg) bottom left repeat-x;border:1px solid #dbe9ea;border-left:0;margin-right:3px}
		#accordion-2 .slide-number{color:#68889b;left:10px;font-weight:bold}
		#accordion-2 .active .slide-number{color:#fff}
		#accordion-2 a{color:#68889b}
		#accordion-2 dd img{float:right;margin:0 0 0 30px;position:relative;top:-20px}

      </style>

</head>
<body>

    <div class="sample">
        <h1>socialArti  -  социальная сеть.</h1>




<table cellpadding="50"><tr><td>
        <div id="accordion-2">
            <dl>
                <dt id="first_title">МикроNews</dt>
                <dd id="first">{micronews}</dd>
                <dt  id="pos_title">О проекте</dt>
                <dd id="pos"><h2>О проекте</h2><p>Здесь будет какой то текст о великом Артемии</p></dd>
                <dt id="auth_title" >Страница пользователя</dt>
                <dd id="auth">{content}</dd>
                <dt id="reg_title">Регистрация</dt>
                <dd id="reg"><h2>Регистрация</h2><p><div id="reg_error"></div><br/><form  method="POST" onSubmit="doRegister();return false;">email <br/>
                    <input type="text" name="email" id="reg_email" /><br/>
                    Фамилия<br/><input type="text" name="surname" id="reg_surname" /><br/>
                    Имя <br/><input type="text" name="name" id="reg_name" /><br/>
                    Отчество <br/><input type="text" name="otch" id="reg_otch" /><br/>
                    Откуда ты<br/><input type="text" name="location" id="reg_location" /><br/>
                    Пароль <br/><input type="password" name="pass1" id="reg_pass1" /><br/>
                    Повтор Пароля <br/><input type="password" name="pass2" id="reg_pass2" /><br/>
                    <input type="submit" value="Регистрация"></form>
                    </p></dd>
           </dl>
        </div></td><td><div id="isauth" style="display:none;"
          <h2>Быстрые ссылки</h2>
           <table><tr>
            <td><a href="#Message" onclick="getMessage();return false;"><img src="<? echo base_url();?>design/menu/incomming.png" width="50px" height="50px" title="Входящие сообщения" /></a></td>
            <td><a  href="#draft" onclick="doNewMessage();return false;"><img src="<? echo base_url();?>design/menu/new_message.png" width="50px" height="50px"title="Написать новое сообщение" /></a></td>
               <td><a  href="<? echo base_url();?>" ><img src="<? echo base_url();?>design/menu/edit_user.png" title="Мой профиль" width="50px" height="50px" /></a></td>
               </tr>
               <tr>
              <td><a href="#Request"  id="incfriends" onclick="getRequest();return false;"><img src="<? echo base_url();?>design/menu/friends.png" width="50px" height="50px" title="Запросы на дружбу" /></a></td>
             <td><a href="#exit"  id="incfriends" onclick="logout('1');return false;"><img src="<? echo base_url();?>design/menu/exit.png" width="50px" height="50px" title="Выход" /></a></td><td></td></tr>
           </table>
            
            </div>
                                                    </td></tr>
</table>

   		<p><a href="http://readyou.ru">Артемий Татаринов &copy; 2011</a></p>
                                 <div id="window">

<div id="windowTop">

<div id="windowTopContent">Название окна</div>

<img src="<? echo base_url();?>design/images/window_min.jpg" id="windowMin" />

<img src="<? echo base_url();?>design/images/window_max.jpg" id="windowMax" />

<img src="<? echo base_url();?>design/images/window_close.jpg" id="windowClose" />

</div>

<div id="windowBottom"><div id="windowBottomContent">&nbsp;</div></div>

<div id="windowContent"><p>Содержание всплывающего окна</p></div>

  <img src="<? echo base_url();?>design/images/window_resize.gif" id="windowResize" /></div>
    </div>

</body>
</html>
