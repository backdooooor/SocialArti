<?
class Template extends Model {
var $themes=null;
    function Template(){
        parent::Model();
        $this->load->config('socialarti');
       $this->themes=$this->config->item('themes');
    }
function doMyPage($masive){
$location=$masive["from"];
$status=$masive["status"];
if($status==null or $status==""){
    $status="Ваш статус";
}
$id_user=(int)$this->session->userdata('id');
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
$data["surname"]="";
$data["name"]="";
$data["photo"]="";
$data["group"]="";
$data["id_user"]="";
$data["location"]="";
$data["icq"]="";
$data["jabber"]="";
$data["skype"]="";
$data["status"]="";
$data["surname"]=$masive["surname"];
$data["name"]=$masive["name"];
$data["photo"]=$masive['photo'];
$data["group"]=$group;
$data["id_user"]=$id_user;
$data["location"]=$location;
$data["icq"]=$masive['icq'];
$data["jabber"]=$masive['jabber'];
$data["skype"]=$masive["skype"];
$data["status"]=$status;



  
$code=$this->load->template($this->themes, "ajax/mypage",$data,true);
//$code=$this->load->view("ajax/editpage",$data);
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
$data["description"]="";
$data["add"]="";
$data["created"]="";
$data["photo"]="";
$data["name"]="";
$data["description"]="";
$data["add"]=$add;
$data["created"]=$created;
$data["photo"]=$masive['photo'];
$data["name"]=$masive['name'];

$code=$this->load->template($this->themes, "ajax/group",$data,true);
 }
return $code;
}
function doEditGroup($row){
//тип группы 0- открытый ,1 закрытый
 $masive=unserialize($row->info);
 
if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="noavatar.jpg";
 if($masive["type"]=="1" and strpos($masive["participants_id"], ",".$this->session->userdata('id').",")>0 or $masive["type"]!="1"){
$data["id_group"]="";
$data["name"]="";
$data["description"]="";
$data["photo"]="";
//
$data["id_group"]=$row->id_group;
$data["name"]=$masive["name"];
$data["description"]=$masive['description'];
$data["photo"]=$masive['photo'];
 $code=$this->load->template($this->themes, "ajax/edit_group",$data,true);

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
function doGroupPreview($row)
{
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

  $data["photo"]="";
     $data["id_group"]="";
     $data["name"]="";
     $data["description"]="";
//
     $data["photo"]=$masive['photo'];
     $data["id_group"]=$row->id_group;
     $data["name"]=$masive['name'];
     $data["description"]=$masive['description'];
 $code=$this->load->template($this->themes, "ajax/group_preview",$data,true);
 }
return $code;
}
function doTopicPreview($row){
      $masive=unserialize($row->profile);
    $data["name"]=$masive["surname"]." ".$masive["name"];
    $data["title"]=$row->title;
    $data["id_group"]=$row->id_group;
    $data["id_user"]=$row->id;
 $code=$this->load->template($this->themes, "ajax/topic_preview",$data,true);

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

$data["photo"]=$masive['photo'];
$data["id_user"]=$row->id;
$data["surname"]=$masive['surname'];
$data['name']=$masive['name'];
$data["from"]=$masive['from'];
$data["onclick"]=$onclick;
$data['add_friend']=$add_friend;
$code=$this->load->template($this->themes, "ajax/preview",$data,true);
return $code;
}
function doNameTopic($row){
    $masive=unserialize($row->profile);
    
      $data["name"]=$masive["surname"]." ".$masive["name"];
    $data["title"]=$row->title;
    $data["id_talk"]=$row->id_talk;
    $data["id_user"]=$row->id;
 $code=$this->load->template($this->themes, "ajax/name_topic",$data,true);
    return $code;

}
function doPostTopic($row){
       $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";

$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;
$title=$masive['surname']." ".$masive['name'];

$answering='';
$data["photo"]=$masive['photo'];
$data["title"]=$row->title;
$data["id_user"]=$row->id;
$data["surname"]=$masive['surname'];
$data["name"]=$masive['name'];
 $code=$this->load->template($this->themes, "ajax/post_topic",$data,true);
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

$data["id_user"]=$row->id;
$data["surname"]=$masive["surname"];
$data["name"]=$masive["name"];
$data["photo"]=$masive['photo'];
$data["group"]=$group;

$data["location"]=$location;
$data["icq"]=$masive['icq'];
$data["jabber"]=$masive['jabber'];
$data["skype"]=$masive["skype"];
$data["status"]=$status;
$data['send_message']=$send_message;
$code=$this->load->template($this->themes, "ajax/profile_page",$data,true);
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
$micronews["id_user"]="";
$micronews["surname"]="";
$micronews["name"]="";
$micronews["photo"]="";
$micronews["data"]="";
$micronews["text"]="";
$micronews["id_mnews"]="";
$micronews["id_user"]=$row->id;
$micronews["surname"]=$masive['surname'];
$micronews["name"]=$masive['name'];
$micronews["photo"]=$masive['photo'];
$micronews["data"]=$data;
$micronews["text"]=$text;
$micronews["id_mnews"]=$row->id_mnews;
$code=$this->load->template($this->themes, "ajax/micronews",$micronews,true);
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

$gr["id_group"]=0;
$gr["name"]="";
$gr["photo"]="";
$gr["data"]="";

$gr["text"]="";
$gr["id_mnews"]="";
//
$gr["id_group"]=$row->id_group;
$gr["name"]=$masive['name'];
$gr["photo"]=$masive['photo'];
$gr["data"]=$data;

$gr["text"]=$text;
$gr["id_mnews"]=$row->id_mnews;
$code=$this->load->template($this->themes, "ajax/group_news",$gr,true);


return $code;
}
function doSelect($row){
      $masive=unserialize($row->profile);
      if((int)$this->session->userdata('id')==(int)$row->id) return "";
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
 $string=$masive["surname"]." ".$masive["name"];
$data["id_user"]=$row->id;
$data["photo"]=$masive["photo"];
$data["string"]=$string;
 $code=$this->load->template($this->themes, "ajax/select",$data,true);
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
$data["style"]=$style;
$data["photo"]=$masive['photo'];
$data["id_user"]=$row->id;
$data["surname"]=$masive['surname'];
$data["name"]=$masive['name'];
$data["text"]=$row->text;
$data["answering"]=$answering;
 $code=$this->load->template($this->themes, "ajax/mesage",$data,true);
return $code;
}
//TODO:доделать шаблонизатор
function doRequest($row){
       $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
$nick=$row->nick;
if($nick==null or $nick=="") $nick=="id".$row->id;
$data["phone"]=$masive['photo'];
$data["surname"]=$masive['surname'];
$data["name"]=$masive['name'];
$data["text"]=$row->text;
$data["id_zapros"]=$row->id_zapr;
$data["id_user"]=$row->id;
 $code=$this->load->template($this->themes, "ajax/request",$data,true);
return $code;
}
function doComment($row){
     $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
 $nick=="id".$row->id;
$data["photo"]=$masive['photo'];
$data["id_user"]=$row->id;
$data["surname"]=$masive['surname'];
$data["name"]=$masive['name'];
$data["text"]=$row->text;

$code=$this->load->template($this->themes, "ajax/comment",$data,true);
return $code;
}
function doCreated($row){
     $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
$nick=="id".$row->id;
$data["photo"]=$masive['photo'];
$data["surname"]=$masive['surname'];
$data["name"]=$masive['name'];
$data["id_user"]=$row->id;
$code=$this->load->template($this->themes, "ajax/created",$data,true);
return $code;
}
function doOnline_User($row){
 $user_data=unserialize($row->user_data);
 $id_user=$user_data['id'];
 $profile=unserialize($user_data["profile"]);
if($id_user==null or $id_user=="" or !(int)$id_user) return false;
if($profile['surname']=="" or $profile['surname']==null) return false;
if($profile['name']=="" or $profile['name']==null) return false;
 if(!isset($profile["photo"]) or $profile["photo"]==null or $profile["photo"]=="" ) $profile["photo"]="nophoto.jpg";
$data["name"]=$profile["name"];
$data["surname"]=$profile["surname"];
$data["photo"]=$profile["photo"];
$data["id_user"]=$id_user;
$data["status"]=$profile["status"];
 $code=$this->load->template($this->themes, "ajax/fast_list",$data,true);
return $code;
}
function doFast_Message($row){
  $profile=unserialize($row->profile);
   $title="<a  href='".base_url()."id".$row->id."' onclick='fastURL(this);return false;'>".$profile["surname"]." ".$profile["name"]."</a>";
$data["title"]=$title;
$data["text"]=$row->text;
$data["data"]=$row->data;
   
   $code=$this->load->template($this->themes, "ajax/fast_message",$data,true);
return $code;
}
function doFlash($row){
  $masive=unserialize($row->profile);
 if(!isset($masive["photo"]) or $masive["photo"]==null or $masive["photo"]=="" ) $masive["photo"]="nophoto.jpg";
 $nick=="id".$row->id;

$data["photo"]=$masive['photo'];
$data["id_flash"]=$row->id_flash;
$data["title"]=$row->title;
$data["description"]=$row->description;
 $code=$this->load->template($this->themes, "ajax/app_show",$data,true);
return $code;
}
function doListArticle($row){
 $title=$row->title;
 $id_article=$row->id_article;
  $masive=unserialize($row->profile);
  $name=$masive["surname"]." ".$masive["name"];
  $id_user=$row->id;
 $data["id_article"]=$id_article;
 $data["id_user"]=$id_user;
 $data["name"]=$name;
 $data["title"]=$title;
 $code=$this->load->template($this->themes, "ajax/blog_list",$data,true);
  return $code;

}
function doArticle($row){
 $title=$row->title;
 $id_article=$row->id_article;
  $masive=unserialize($row->profile);
  $name=$masive["surname"]." ".$masive["name"];
  $id_user=$row->id;
  $text=$row->text;
$data["title"]=$title;
$data["text"]=$text;
$data["id_user"]=$id_user;
$data["name"]=$name;
$code=$this->load->template($this->themes, "ajax/blog_article",$data,true);
  return $code;
}
}