<table><tr><td><form onSubmit='doEditGroup({id_group});return false;'>Название<br>
<input type='text'  id='group_name' value='{name}'>
<br>Тип группы<br><select><option>Открытая</option><option>Закрытая</option></select>
<br>Описание<br><textarea rows=5 id='group_description' cols=10>{description}</textarea>
<br><input type=submit value='Сохранить'></form>
</td><td><img id='group_avatar' width=200px height=200px src='../photo/club/{photo}'>
<br><a  id='load_avatar' href='#' onclick='doLoadAvatar({id_group});return false'>Загрузка аватара</a></td>
</tr></table><form onSubmit='setStatusGroup({id_group});return false;' method='POST'>Напишите новость!<br>
<textarea name='status' id='status_group'  rows=3 cols=35 ></textarea>
<br><input type=submit value='Написать'><br><h1><a href='#' onclick='doNews();'>Новости</a></h1>
<h1><a href='#' onclick='doTalk();'>Обсуждения</a></h1>
<h1><a href='#' onclick='doPartipians();'>Участники</a></h1>