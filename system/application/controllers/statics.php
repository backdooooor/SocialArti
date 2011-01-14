<?php

class Statics extends Controller {

	function Statics()
	{
		parent::Controller();
                $this->load->model("User");
                $this->load->model("Template");
                $this->load->library('session');
                $this->load->helper('url');
                $this->load->model("Filter");
                $this->load->model("Search");
                $this->load->model("Friends");
                  $this->load->model("Micronews");
	}
        function profile($nick){
            $opt="";
            $tmp=explode("id",$nick);
            $id_user="";
            if($tmp[1]!=null or $tmp[1]!=""){
                $nick=$tmp[1];
                $opt="id";
            }else {
                $opt="nick";
                $id_user=$this->User->getID($nick);
            }
            $this->load->library('parser');
        
        foreach($this->User->getProfile($nick,$opt) as $row){
          $profile=unserialize($row->profile);
          $data["title"]="socialArti - ".$profile["surname"]." ".$profile["name"];
           $data["content"]=$this->Template->doProfilePage($profile,$row);
        }


        foreach($this->Micronews->getMNews($id_user) as $row){

                      $data["micronews"]=$data["micronews"]." ".$this->Template->doMicroNews($row,$row->text,$row->data);
                }
              
        $this->parser->parse('profile', $data);

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
}
