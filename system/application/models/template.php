<?
class Template extends Model {

function doMyPage($masive){
$location=$masive["from"];
$status=$masive["status"];
if($status==null or $status==""){
    $status="Ваш статус";
}

if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
$this->load->helper("url");
$group_mas=explode(";",$masive["groups"]);

$i=0;
$group="";
while($group_mas[$i]!="" or $group_mas[$i]!=null ) {
$temp=explode("|",$group_mas[$i]);
$group=$group.'<a href="'.base_url().'/group'.$temp[1].'">'.$temp[0].'</a><br>';
$i++;
}
$code="<h2><form onSubmit='doSaveNS();return false;'><input type=text  id='surname' value='".$masive['surname']."' />&nbsp; <input type=text id='name' value='".$masive['name']."' /><input type=submit value='Сохранить'><br></form></h2><p><form onSubmit='setStatus();return false;' method='POST'><textarea name='status' id='status'  rows=3 cols=35 >".$status."</textarea><br><input type=submit value='Обновить'></form><br/><table><tr><td><img  id='user_photo' src='".base_url()."photo/".$masive['photo']."' align='left' width=200px height=200px ><a  id='load_photo' href='#' onclick='doLoadPhoto();return false'>Загрузка фотографии</a><br>Действия:<br><a  href='#' onclick='doCreateGroup();return false;'>Создать группу</a><br><a href=''>Создать страницу</a><br><a href='#'>Создать запись</a><br>Группы<br>".$group."<br>Подписки:<br><a href='#'>Read.You</a></td><td>Откуда:".$location."<br>Контакты:<form onSubmit='doSaveContact();return false;'><br>icq:<input type=text  id='edit_icq' value='".$masive['icq']."'><br>jabber:<input type=text id='edit_jabber' value='".$masive['jabber']."'><br>skype:<input type=text id='edit_skype' value='".$masive['skype']."'><br><input type=submit value='Сохранить'></form><br></td></tr></table></p>";
return $code;

}

//вывод информации о группе!
function doGroup($row){
//тип группы 0- открытый ,1 закрытый
 $masive=unserialize($row->info);
 $profile=unserialize($row->profile);
 $created=$this->doCreated($row);
 $users=$masive["participants_id"];

 $add="";

 $new_str=str_replace($this->session->userdata('id').",", "", $users);
if($users==$new_str){
  $add="<a id='group_user' href='#' onclick='doJoinGroup(".$row->id_group.");return false;'>Вступить в группу</a>";
}else {
    $add="<a id='group_user' href='#' onclick='doExitGroup(".$row->id_group.");return false;'>Выйти из группы</a>";
}

if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="noavatar.jpg";
 if($masive["type"]=="1" and strpos($masive["participants_id"], ",".$this->session->userdata('id').",")>0 or $masive["type"]!="1"){

     $code="<table><tr><td>".$masive['name']."<br>Описание<br>".$masive['description']."<br></td><td><img width=200px height=200px src='".base_url()."photo/club/".$masive['photo']."'><br>".$created."".$add."</td></tr></table><br><h1><a href='#' onclick='doNews();'>Новости</a></h1><h1><a href='#' onclick='doTalk();'>Обсуждения</a></h1><h1><a href='#' onclick='doPartipians();'>Участники</a></h1>";

 }
return $code;
}
function doEditGroup($row){
//тип группы 0- открытый ,1 закрытый
 $masive=unserialize($row->info);
 
if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="noavatar.jpg";
 if($masive["type"]=="1" and strpos($masive["participants_id"], ",".$this->session->userdata('id').",")>0 or $masive["type"]!="1"){

     $code="<table><tr><td><form onSubmit='doEditGroup(".$row->id_group.");return false;'>Название<br><input type='text'  id='group_name' value='".$masive['name']."'><br>Тип группы<br><select><option>Открытая</option><option>Закрытая</option></select><br>Описание<br><textarea rows=5 id='group_description' cols=10>".$masive['description']."</textarea><br><input type=submit value='Сохранить'></form></td><td><img id='group_avatar' width=200px height=200px src='".base_url()."photo/club/".$masive['photo']."'><br><a  id='load_avatar' href='#' onclick='doLoadAvatar(".$row->id_group.");return false'>Загрузка аватара</a></td></tr></table><form onSubmit='setStatusGroup(".$row->id_group.");return false;' method='POST'>Напишите новость!<br><textarea name='status' id='status_group'  rows=3 cols=35 ></textarea><br><input type=submit value='Написать'><br><h1><a href='#' onclick='doNews();'>Новости</a></h1><h1><a href='#' onclick='doTalk();'>Обсуждения</a></h1><h1><a href='#' onclick='doPartipians();'>Участники</a></h1>";

 }
return $code;
}
function  doPartipiants($row){
      $masive=unserialize($row->info);
   $users=$masive["participants_id"];
   
    $CI =& get_instance();
    $CI->load->model("User");
    $code="";
   
    if($masive["type"]=="1" and strpos($masive["participants_id"], $this->session->userdata('id').",")>0 or $masive["type"]!="1"){
 foreach($CI->User->getMUsers($users) as $rows){

$code=$code."".$this->doPreview($rows);
    }
   
   if($code=="") $code="Нет участников для отображения!";

 } else {
     $code="Нет прав для доступа к странице";
 }
 return $code;
}
//предпросмотр профиля в результах поиска
function doPreview($row,$opt=0){

   if((int)$this->session->userdata('id')==(int)$row->id) return "";
    $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
 $CI =& get_instance();
        $CI->load->model('Friends');
 if($opt==0 && !$CI->Friends->isFriends($this->session->userdata('id'),$row->id)){

 $action_friends='doAddFriends('.$row->id.',"'.$title.'","'.$photo_url.'");return false;';
 $add_friend="<a href='#' onclick='".$action_friends."'>Добавить в друзья</a>";
}else {
    $add_friend="";
}

 $nick=="id".$row->id;
 
$title=$masive['surname']." ".$masive['name'];
$onclick='doTO_User('.$row->id.',"'.$title.'");return false';

$code="<table cellspacing=20
><tr><td><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><a href=".base_url()."id".$row->id.">".$masive['surname']." ".$masive['name']."</a><br>".$masive['from']."<br><br><br><br><br></td><td><a href='#' onclick='".$onclick."'>Отправить сообщение</a><br>".$add_friend."<br><br><br><br><br></td></tr></table><br/>";
return $code;
}
function doNameTopic($row){
    $masive=unserialize($row->profile);
    $name=$masive["surname"]." ".$masive["name"];
    $title=$row->title;
    $code="<a href='#' onclick='getTalks(".$row->id_talk.");return false;'><h4>".$title."</h4></a><br><a href='".base_url()."id".$row->id."'>".$name."</a><br>";
    return $code;

}
function doPostTopic($row){
       $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";

$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;
$title=$masive['surname']." ".$masive['name'];

$answering='';
$code="<table   cellspacing=20
><tr><td><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><h3>".$row->title."</h3><br>".$row->text."<br><a href='".base_url()."id".$row->id."'>".$masive['surname']." ".$masive['name']."</a><br></td><td></td></tr></table><br/>";
return $code;
}
function doProfilePage($masive,$row){
    $location=$masive["from"];
if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
$status=$masive["status"];
if($status==null or $status==""){
    $status="Ваш статус";
}
$title=$masive['surname']." ".$masive['name'];
$action='doTO_User('.$row->id.',"'.$title.'");return false;';
$send_message="";
    if((int)$this->session->userdata('id')!=(int)$row->id) {
$send_message="<a href='#' onclick='".$action."'>Отправить сообщение</a>";
    }
    $photo_url=base_url()."photo/".$masive["photo"];
     $CI =& get_instance();
        $CI->load->model('Friends');
$action_friends='doAddFriends('.$row->id.',"'.$title.'","'.$photo_url.'");return false;';
if(!$CI->Friends->isFriends($this->session->userdata('id'),$row->id)  and $this->session->userdata('id')!=$row->id ){
$send_message=$send_message."<br><a href='#' onclick='".$action_friends."'>Добавить в друзья</a>";
}
$group_mas=explode(";",$masive["groups"]);

$i=0;
$group="";
while($group_mas[$i]!="" or $group_mas[$i]!=null ) {
$temp=explode("|",$group_mas[$i]);
$group=$group.'<a href="'.base_url().'/group'.$temp[1].'">'.$temp[0].'</a><br>';
$i++;
}
$this->load->helper("url");
$code="<h2>".$masive['surname']." ".$masive['name']."</h2><p><textarea readonly name='status' id='status'  rows=3 cols=50 >".$status."</textarea><br/><table><tr><td><img src='".base_url()."photo/".$masive['photo']."' align='left' width=200px height=200px ><br>".$send_message."</td><td>Откуда:".$location."<br>Контакты:<br>icq:".$masive['icq']."<br>jabber:".$masive['jabber']."<br>skype:".$masive['skype']."<br>Группы<br>".$group."</td></tr></table></p>";
return $code;
}
function doMicroNews($row,$text,$data){
     $CI =& get_instance();
     $CI->load->model("Search");

     $links_mas=$CI->Search->doSearchLink($text);
     //искомая ссылка $links_mas[0];
     
     $CI->load->model("Content");
     $media_content=$CI->Content->doContent($links_mas[0]);
     if($media_content!="")  $text = str_replace($links_mas[0], "", $text);
     $text=$text."<br>".$media_content;
 
    $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";

$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;

$code="<table cellspacing=20
><tr><td><a href='".base_url()."id".$row->id."'>".$masive['surname']." ".$masive['name']."</a><br><br><br><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td>".$data."<h3>".$text."</h3><br><br><a href='#' onclick='doComment(".$row->id_mnews.");'>Комментарии</a></td></tr></table><div id='id_".$row->id_mnews."'></div><br/>";
return $code;
}
function doGroupNews($row,$text,$data){
    $masive=unserialize($row->info);
 $CI =& get_instance();
     $CI->load->model("Search");

     $links_mas=$CI->Search->doSearchLink($text);
     //искомая ссылка $links_mas[0];

     $CI->load->model("Content");
     $media_content=$CI->Content->doContent($links_mas[0]);
     if($media_content!="")  $text = str_replace($links_mas[0], "", $text);
     $text=$text."<br>".$media_content;
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="noavatar.jpg";



$code="<table cellspacing=20
><tr><td><a href='".base_url()."group".$row->id_group."'>".$masive['name']."</a><br><br><br><img  width=100px height=100px src='".base_url()."photo/club/".$masive['photo']."' align='left' ></td><td>".$data."<h3>".$text."</h3><br><br><a href='#' onclick='doComment(".$row->id_mnews.");'>Комментарии</a></td></tr></table><div id='id_".$row->id_mnews."'></div><br/>";

return $code;
}
function doSelect($row){
      $masive=unserialize($row->profile);
      if((int)$this->session->userdata('id')==(int)$row->id) return "";
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
 $string=$masive["surname"]." ".$masive["name"];

 $code="<option value='".$row->id."' data-icon='photo/".$masive["photo"]."' data-html-text='".$string."'>".$string."</option>";
return $code;

}
function doMessage($row){
        $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";

$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;
$title=$masive['surname']." ".$masive['name'];
if((int)$row->read==0){
  $style='background:green';
} else {
    $style='';
}
$answering='doRead('.$row->id_message.');doTO_User('.$row->id_from.',"'.$title.'");return false';
$code="<table  style='".$style."' cellspacing=20
><tr><td><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><a href='".base_url()."id".$row->id."'>".$masive['surname']." ".$masive['name']."</a><br><hr>".$row->text."<br><br></td><td><a href='#' onclick='".$answering."'>Ответить</a></td></tr></table><br/>";
return $code;
}
function doRequest($row){
       $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;

$code="<table  style='".$style."' cellspacing=20
><tr><td><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><a href='".base_url()."".$nick."'>".$masive['surname']." ".$masive['name']."</a><br><hr>".$row->text."<br><br></td></tr></table><br><center><a href='#' onclick='doEditFriend(".$row->id_zapr.",1)'>Принять</a>&nbsp;&nbsp;<a href='#' onclick='doEditFriend(".$row->id_zapr.",0)'>Отказаться</a></center><br/>";
return $code;
}
function doComment($row){
     $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
 $nick=="id".$row->id;

$code="<table  style='".$style."' cellspacing=20
><tr><td><img  width=25px height=25px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><a href='".base_url()."id".$row->id."'>".$masive['surname']." ".$masive['name']."</a><br><hr>".$row->text."<br><br></td></tr></table><br><br/>";
return $code;
}
function doCreated($row){
     $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
$nick=="id".$row->id;

$code="<table  style='".$style."' cellspacing=20
><tr><td><img  width=25px height=25px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><a href='".base_url()."id".$row->id."'>".$masive['surname']." ".$masive['name']."</a><br><hr>Создатель групы<br><br></td></tr></table><br>";
return $code;
}

}