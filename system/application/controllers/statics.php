<?php

class Statics extends Controller {
var $browser;
	function Statics()
	{
		parent::Controller();
                $this->load->library('user_agent');
                  $this->load->library('parser');
                $this->load->model("User");
                $this->load->model("Template");
                $this->load->library('session');
                $this->load->helper('url');
                $this->load->model("Filter");
                $this->load->model("Search");
                $this->load->model("Friends");
                  $this->load->model("Micronews");
                   $this->load->model("Group");
                   $this->load->model("Talks");

                   if($this->agent->browser()=="Opera") {
                $this->browser='<link rel="stylesheet" href="'.base_url().'design/css/opera.css" type="text/css" media="screen, projection" />';
                 }
	}
        function group($id){
            $mas="";
              if($this->User->checkAuth()){
                   $id_user=(int)$this->session->userdata('id');
                  if($this->Group->isCreated($id,$id_user)) {
                       foreach($this->Group->get($id) as $row){

                         $data["content"]=$this->Template->doEditGroup($row);
                         $data["partipiants"]=$this->Template->doPartipiants($row);
                      }
                  }else {
                      foreach($this->Group->get($id) as $row){
                          
                         $data["content"]=$this->Template->doGroup($row);
                         $data["partipiants"]=$this->Template->doPartipiants($row);
                       
                      }
                  }
                  foreach($this->Micronews->getGroup($id) as $list){
                   
                      $data["micronews"]=$data["micronews"]."".$this->Template->doGroupNews($list,$list->text,$list->data);

                  }
                  foreach($this->Talks->get($id) as $var){
                      $data["talk"]=$data["talk"]."".$this->Template->doNameTopic($var);
                  }
                 
                
                        $mas=unserialize($row->info);
                       $data["name"]=$mas["name"];
                  $data["title"]=$mas["name"];
                 $data["talk"]="<h2><a href='#' onclick='doTalks(".$id.");return false;'>Создать обсуждение</a></h2>".$data["talk"];
                  //$data["micronews"]="В группе нет новостей!";

                 
                 $this->parser->parse('group', $data);
                  if($this->browser!=""){
                echo $this->browser;
            }
              } else {
                  $data["url"]=base_url();
                  $this->parser->parse('notauth', $data);
              }
        }
        function profile($nick){
            $opt="";
            $tmp=explode("id",$nick);
            $id_user="";
            if($tmp[1]!=null or $tmp[1]!=""){
                $nick=$tmp[1];
                $opt="id";
                $id_user=$tmp[1];
            }else {
                $opt="nick";
                $id_user=$this->User->getID($nick);
            }
          
        
        foreach($this->User->getProfile($nick,$opt) as $row){
          $profile=unserialize($row->profile);
          $data["title"]="socialArti - ".$profile["surname"]." ".$profile["name"];
           $data["content"]=$this->Template->doProfilePage($profile,$row);
        }


        foreach($this->Micronews->getMNews($id_user) as $row){

                      $data["micronews"]=$data["micronews"]." ".$this->Template->doMicroNews($row,$row->text,$row->data);
                }
              if($data["micronews"]=="") $data["micronews"]=="Новостей нет(";
           
               
        $this->parser->parse('profile', $data);
 if($this->browser!=""){
                echo $this->browser;
            }
        }
       
//        function update(){
//            $profile=unserialize($this->session->userdata('profile'));
//                    $profile["photo"]="backdoor.jpg";
//                    $profile=serialize($profile);
//                    $this->User->updateProfile(2,$profile);
//                      $newdata = array(
//                   'id'  => 2,
//                   'profile'     => $profile,
//                   'logged_in' => TRUE
//               );
//
//                     $this->session->set_userdata($newdata);
//                    echo "its good";
//        }

 function text(){
           if(!$this->Friends->isFriends("2","3")){
               echo "0";
           }
        }
        function load_photo(){
            //TODO:сделать проверку на тип файла!

                  if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                         $blacklist = array(".php", ".phtml", ".php3", ".php4");
 foreach ($blacklist as $item) {
  if(preg_match("/$item\$/i", $_FILES['myfile']['name'])) {
   echo "0";
  return "";
   }
  }

  $uploaddir = 'photo/';
  $uploadfile = $uploaddir."".$id_user.".jpg";;

  if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {

   $url=base_url()."photo/".$id_user.".jpg";
   echo $url;
  } else {
   echo "0";
   return "";
  }

                    //serialize
                    $profile=unserialize($this->session->userdata('profile'));
                    $profile["photo"]=$id_user.".jpg";

                    $profile=serialize($profile);
                    $this->User->updateProfile($id_user,$profile);
                     
                        $newdata = array(
                   'id'  => $id_user,
                   'profile'     => $profile,
                   'logged_in' => TRUE
               );
                      
                     $this->session->sess_destroy(); 
                     $this->session->set_userdata($newdata);
                     $this->Micronews->add($id_user,"Обновил фотографию...");
                    
                    
                 

                }
          
        }
          function load_avatar($id_group){
            //TODO:сделать проверку на тип файла!
if($id_group==null or  $id_group=="" or !(int)$id_group) {
    echo "0";
    return false;
}

                  if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                    if(!$this->Group->isCreated($id_group,$id_user)) return false;
                         $blacklist = array(".php", ".phtml", ".php3", ".php4");
 foreach ($blacklist as $item) {
  if(preg_match("/$item\$/i", $_FILES['myfile']['name'])) {
   echo "0";
  return "";
   }
  }

  $uploaddir = 'photo/club/';
  $uploadfile = $uploaddir."".$id_group.".jpg";;

  if (move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadfile)) {

   $url=base_url()."photo/club/".$id_group.".jpg";
   echo $url;
  } else {
   echo "0";
   return "";
  }

                    //serialize
                    foreach($this->Group->get($id_group) as $row){
                      $info=unserialize($row->info);
                     }
                   
                    $info["photo"]=$id_group.".jpg";

                    $info=serialize($info);
                   $this->Group->edit($id_group,$info);
                    $this->Micronews->addGroupNews($id_group,"Обновлена аватарка..");



                }

        }
}
