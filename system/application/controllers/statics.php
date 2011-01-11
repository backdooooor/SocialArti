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
	}
        function profile($nick){
            $opt="";
            $tmp=explode("id",$nick);
            if($tmp[1]!=null or $tmp[1]!=""){
                $nick=$tmp[1];
                $opt="id";
            }else {
                $opt="nick";
            }
            $this->load->library('parser');
        
        foreach($this->User->getProfile($nick,$opt) as $row){
          $profile=unserialize($row->profile);
          $data["title"]="socialArti - ".$profile["surname"]." ".$profile["name"];
           $data["content"]=$this->Template->doProfilePage($profile,$row);
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
}
