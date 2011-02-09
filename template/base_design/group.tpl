<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	  <title>{title}</title>

      <!-- Meta -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />

      <!-- Scripts -->
      <script type="text/javascript" src="../template/base_design/design/scripts/jquery.min.js"></script>
	  <script type="text/javascript" src="../template/base_design/design/scripts/jquery.easyAccordion.js"></script>
          <script type="text/javascript" src="../template/base_design/design/scripts/ajaxupload.js"></script>
      <script type="text/javascript" src="../template/base_design/design/scripts/group.js"></script>
<script type="text/javascript" src="../template/base_design/design/scripts/UI.js"></script>
<script type="text/javascript" src="../template/base_design/design/scripts/interface.js"></script>
<link rel="stylesheet" href="../template/base_design/design/style.css" type="text/css" media="screen, projection" />
 <link rel="stylesheet" href="../template/base_design/design/css/main.css" type="text/css" media="screen, projection" />
<script type="text/javascript">

auth=true;

</script>
  <link rel="stylesheet" href=../template/base_design/design/css/main.css" type="text/css" media="screen, projection" />

</head>
<body>

    <div class="sample">
        <table><tr><td width="5px">
         <a    href="<? echo base_url(); ?>"><img  height="100px" width="150px" src="../template/base_design/design/images/logo.png"/></a></td>
       <td style="" width="98%"> {panel_login}     <div id="menu_arti"><a  id="hide1" href="../group1">Новости проекта</a>&nbsp;&nbsp;&nbsp;<a id="hide2" href="#" onclick="fastWindow();">Быстрые сообщения</a>&nbsp;&nbsp;<a id="hide3" href="#" onclick="doFlash();return false;">Приложения</a>&nbsp;&nbsp;<form id="menu_search"   onSubmit="doSearchPanel();return false;"><input   onFocus="doSearchUP();" onMouseDown="doSearchDown();" onChange="doSearchUP();"  size="15" id="search_panel" type="text" value="Поиск"/><select onFocus="doSearchUP();"  id="search_select" name="option" style='display:none; margin-left: -65px'>
	<option value="0">
		по людям
	</option>
	<option value="1">
		по группам
	</option>
	<option value="2">
		по обсуждениям
	</option>
        <option value="3">
		по приложениям
	</option>
</select></form></div>
       </td></tr>
        </table>





         <div id="isauth" style="">
      <a href="#Message" onclick="getMessage();return false;"><img src="../template/base_design/design/menu/incomming.png" width="50px" height="50px" title="Входящие сообщения" /></a>
            <a  href="#draft" onclick="doNewMessage();return false;"><img src="../template/base_design/design/menu/new_message.png" width="50px" height="50px"title="Написать новое сообщение" /></a>
              <a  href="<? echo base_url();?>" ><img src="../template/base_design/design/menu/edit_user.png" title="Мой профиль" width="50px" height="50px" /></a>
            <a href="#Request"  id="incfriends" onclick="getRequest();return false;"><img src="../template/base_design/design/menu/friends.png" width="50px" height="50px" title="Запросы на дружбу" /></a>
             <a href="#exit"   onclick="logout('1');return false;"><img src="../template/base_design/design/menu/exit.png" width="50px" height="50px" title="Выход" /></a>
             <a href="#new"   onclick="doNewArticle();return false;"><img src="../template/base_design/design/menu/blog.png" width="50px" height="50px" title="Создать запись" /></a>
                  <a href="#group"   onclick="doCreateGroup();return false;"><img src="../template/base_design/design/menu/group.png" width="50px" height="50px" title="Создать группу" /></a>
                   <a href="#public"   onclick="doCreateGroup();return false;"><img src="../template/base_design/design/menu/bookmark.png" width="50px" height="50px" title="Создать страницу" /></a>
                   <a href="#app"   onclick="doCreateApp();return false;"><img src="../template/base_design/design/menu/app.png" width="50px" height="50px" title="Добавить приложение" /></a>
            </div>
<table ><tr><td>
        <div id="accordion-2">
            <dl>
                <dt id="first_title">Новости</dt>
                <dd id="first">{micronews}</dd>
                <dt  id="pos_title">Обсуждения</dt>
                <dd id="pos">{talk}</dd>
                <dt id="auth_title" >группа {name}</dt>
                <dd id="auth">{content}</dd>
                <dt id="reg_title">Участники</dt>
                <dd id="reg">{partipiants}</dd>
           </dl>
        </div></td><td>
                                                    </td></tr>
</table>

   		<p><a href="http://readyou.ru">Артемий Татаринов &copy; 2011</a>&nbsp;&nbsp; Powered by  <a href="http://github.com/backdoor/SocialArti">socialArti ver 0,3</a></p>
                                 <div id="window">

<div id="windowTop">

<div id="windowTopContent">Название окна</div>

<img src="../template/base_design/design/images/window_min.jpg" id="windowMin" />

<img src="../template/base_design/design/images/window_max.jpg" id="windowMax" />

<img src="../template/base_design/design/images/window_close.jpg" id="windowClose" />

</div>

<div id="windowBottom"><div id="windowBottomContent">&nbsp;</div></div>

<div id="windowContent"><p>Содержание всплывающего окна</p></div>

  <img src="../template/base_design/design/images/window_resize.gif" id="windowResize" /></div>
    </div>

</body>
</html>
