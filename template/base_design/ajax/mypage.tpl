<h2><form onSubmit='doSaveNS();return false;'>
<input type=text  id='surname' value='{surname}' />&nbsp;
<input type=text id='name' value='{name}' />
<input type=submit value='Сохранить'><br>
</form></h2><p><form onSubmit='setStatus();return false;' method='POST'>
<textarea name='status' id='status'  rows=3 cols=35 >{status}</textarea>
<br><input type=submit value='Обновить'></form>
<br/><table><tr><td><img  id='user_photo' src='../photo/{photo}'  width=200px height=200px >
<a  id='load_photo' href='#' onclick='doLoadPhoto();return false'>Загрузка фотографии</a>
<br>Группы<br>{group}<br>Подписки:<br><a href='#'>Read.You</a>
<br><a href='#' onclick='getBlog({id_user});return false;'><h3>Блог пользователя</h3>
</a></td><td>Откуда:".$location."<br>Контакты:
<form onSubmit='doSaveContact();return false;'>
<br>icq:<input type=text  id='edit_icq' value='{icq}'>
<br>jabber:<input type=text id='edit_jabber' value='{jabber}'>
<br>skype:<input type=text id='edit_skype' value='{skype}'>
<br><input type=submit value='Сохранить'></form><br></td></tr></table></p>