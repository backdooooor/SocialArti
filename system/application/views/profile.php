<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	  <title>{title}</title>

      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />

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
 <link rel="stylesheet" href="<? echo base_url();?>design/css/main.css" type="text/css" media="screen, projection" />
<?  if($browser=="Opera") {
?>
<link rel="stylesheet" href="<? echo base_url();?>design/css/opera.css" type="text/css" media="screen, projection" />
<?
}
?>
</head>
<body>

    <div class="sample">
                <div id="menu_arti"><a href="<? echo base_url(); ?>group1">Новости проекта</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="fastWindow();">Быстрые сообщения</a></div>
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

   		<p><a href="http://readyou.ru">Артемий Татаринов &copy; 2011</a>&nbsp;&nbsp; Powered by  <a href="http://github.com/backdoor/SocialArti">socialArti ver 0,2</a></p>
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
