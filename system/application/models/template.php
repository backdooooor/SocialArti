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
$code="<h2>".$masive['surname']." ".$masive['name']."</h2><p><form onSubmit='setStatus();return false;' method='POST'><textarea name='status' id='status'  rows=3 cols=35 >".$status."</textarea><br><input type=submit value='Обновить'></form><br/><table><tr><td><img src='".base_url()."photo/".$masive['photo']."' align='left' width=200px height=200px ></td><td>Откуда:".$location."<br>Контакты:<br>icq:".$masive['icq']."<br>jabber:".$masive['jabber']."<br>skype:".$masive['skype']."<br></td></tr></table></p>";
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
 $add_friend="<a href=''>Добавить в друзья</a>";
}else {
    $add_friend="";
}
$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;
 $nick=="id".$row->id;
$title=$masive['surname']." ".$masive['name'];
$onclick='doTO_User('.$row->id.',"'.$title.'");return false';

$code="<table cellspacing=20
><tr><td><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><a href=".base_url()."id".$row->id.">".$masive['surname']." ".$masive['name']."</a><br>".$masive['from']."<br><br><br><br><br></td><td><a href='#' onclick='".$onclick."'>Отправить сообщение</a><br>".$add_friend."<br><br><br><br><br></td></tr></table><br/>";
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
if(!$CI->Friends->isFriends($this->session->userdata('id'),$row->id)){
$send_message=$send_message."<br><a href='#' onclick='".$action_friends."'>Добавить в друзья</a>";
}
$this->load->helper("url");
$code="<h2>".$masive['surname']." ".$masive['name']."</h2><p><textarea readonly name='status' id='status'  rows=3 cols=50 >".$status."</textarea><br/><table><tr><td><img src='".base_url()."photo/".$masive['photo']."' align='left' width=200px height=200px ><br>".$send_message."</td><td>Откуда:".$location."<br>Контакты:<br>icq:".$masive['icq']."<br>jabber:".$masive['jabber']."<br>skype:".$masive['skype']."<br></td></tr></table></p>";
return $code;
}
function doMicroNews($row,$text,$data){
    $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";

$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;
$code="<table cellspacing=20
><tr><td><a href='".base_url()."".$nick."'>".$masive['surname']." ".$masive['name']."</a><br><br><br><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td>".$data."<h3>".$text."</h3><br><br><br></td></tr></table><br/>";
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
><tr><td><img  width=100px height=100px src='".base_url()."photo/".$masive['photo']."' align='left' ></td><td><a href='".base_url()."".$nick."'>".$masive['surname']." ".$masive['name']."</a><br><hr>".$row->text."<br><br></td><td><a href='#' onclick='".$answering."'>Ответить</a></td></tr></table><br/>";
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

}