<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
	  <title>socialArti - Социальная сеть</title>

      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
      <!-- Scripts -->
      <script type="text/javascript" src="<? echo base_url();?>design/scripts/jquery-1.4.3.js"></script>
	  <script type="text/javascript" src="<? echo base_url();?>design/scripts/jquery.easyAccordion.js"></script>
     
<script type="text/javascript" src="<? echo base_url();?>design/scripts/UI.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/interface.js"></script>
<script type="text/javascript" src="<? echo base_url();?>design/scripts/ajaxupload.js"></script>
<link rel="stylesheet" href="<? echo base_url();?>design/style.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<? echo base_url();?>design/css/styles.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<? echo base_url();?>design/css/main.css" type="text/css" media="screen, projection" />
<?  

echo $browser;

?>


 <script type="text/javascript" src="<? echo base_url();?>design/scripts/utility.js"></script>

    

</head>
<body>

    <div class="sample">
        <div id="menu_arti"><a href="<? echo base_url(); ?>group1">Новости проекта</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="fastWindow();">Быстрые сообщения</a>&nbsp;&nbsp;<a href="#" onclick="doFlash();return false;">Приложения</a></div>
        <h1><a href="<? echo base_url(); ?>">socialARti  - социальная сеть</a></h1>




        <table cellpadding="50"><tr><td>
        <div id="accordion-2">
            <dl>
                <dt id="first_title">Вступление</dt>
                <dd id="first"></dd>
                <dt  id="pos_title">О проекте</dt>
                <dd id="pos"></dd>
                <dt id="auth_title" >Авторизация</dt>
                <dd id="auth"></dd>
                <dt id="reg_title">Регистрация</dt>
                <dd id="reg"></dd>
           </dl>
        </div></td><td>
       <div id="isauth" style="display:none;"
          <h2>Быстрые ссылки</h2>
            <table><tr>
            <td><a href="#Message" onclick="getMessage();return false;"><img src="<? echo base_url();?>design/menu/incomming.png" width="50px" height="50px" title="Входящие сообщения" /></a></td>
            <td><a  href="#draft" onclick="doNewMessage();return false;"><img src="<? echo base_url();?>design/menu/new_message.png" width="50px" height="50px"title="Написать новое сообщение" /></a></td>
               <td><a  href="<? echo base_url();?>" ><img src="<? echo base_url();?>design/menu/edit_user.png" title="Мой профиль" width="50px" height="50px" /></a></td>
               </tr>
               <tr>
              <td><a href="#Request"  id="incfriends" onclick="getRequest();return false;"><img src="<? echo base_url();?>design/menu/friends.png" width="50px" height="50px" title="Запросы на дружбу" /></a></td>
             <td><a href="#exit"   onclick="logout('1');return false;"><img src="<? echo base_url();?>design/menu/exit.png" width="50px" height="50px" title="Выход" /></a></td>
             <td><a href="#new"   onclick="doNewArticle();return false;"><img src="<? echo base_url();?>design/menu/blog.png" width="50px" height="50px" title="Создать запись" /></a></td></tr>
               <tr>
                   <td><a href="#group"   onclick="doCreateGroup();return false;"><img src="<? echo base_url();?>design/menu/group.png" width="50px" height="50px" title="Создать группу" /></a></td>
                   <td><a href="#group"   onclick="doCreateGroup();return false;"><img src="<? echo base_url();?>design/menu/bookmark.png" width="50px" height="50px" title="Создать страницу" /></a></td>
                   <td></td>
               </tr>
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
