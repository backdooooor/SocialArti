<?php

class Ajax extends Controller {

	function Ajax()
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
                   $this->load->model("Message");
                   $this->load->model("Comments");
                    $this->load->model("Group");
                    $this->load->model("Talks");
	}
function _remap($method){
      
        if(IS_AJAX){
            $pars = $this->uri->segment_array();
    unset($pars[1]);
    unset($pars[2]);





	 if($pars[3]!="" and $pars[4]!="" ) {
	    $this->$method($pars[3],$pars[4]);
	    	 } else if($pars[3]!="") {
		  $this->$method($pars[3]);
		 } else {
	 $this->$method();
		 }

    } else {
        echo "()||()";
    }
    }
	function index()
	{
		//$this->load->view('static');
            echo  "not found";

	}
        function register(){

        //регистрация
        $email=$this->Filter->doHTML($this->input->post("email"));
        $password=$this->Filter->doHTML($this->input->post("password"));
        $profile["name"]=$this->Filter->doHTML($this->input->post("name"));
        $profile["surname"]=$this->Filter->doHTML($this->input->post("surname"));
        $profile["otch"]=$this->Filter->doHTML($this->input->post("otch"));
        $profile["from"]=$this->Filter->doHTML($this->input->post("from"));
        $profile["icq"]="не указана";
        $profile["jabber"]="не указан";
        $profile["skype"]="не указан";
        if($email==null or $email=="" or $profile["name"]==null or $profile["name"]=="" or $profile["surname"]=="" or  $profile["surname"]==null  or $profile["otch"]==""  or $profile["otch"]==null  or   $profile["from"]=="" or $profile["from"]==null){
           echo "0";
           return false;

        }

        echo $this->User->doRegister($email,$password,serialize($profile));
        }
        function auth(){
            //авторизовывалка
              $email=$this->input->post("email");
        $password=$this->input->post("password");
        if($email==null or $email=="" or $password=="" or $password==null){
            echo "0";
         return false;
        }
        echo $this->User->doAuth($email,$password);
        }
        function doMy(){
            if($this->User->checkAuth()){
                $profile=unserialize($this->session->userdata('profile'));
               
                echo $this->Template->doMyPage($profile);
            } else {
               echo "Вы не авторизованы!";
                }

        }
        function checkAuth(){
          if($this->User->checkAuth()){
              echo "1";

          } else {
              echo "0";
          }
         }
         function doSearch(){
            $search_str=$this->Filter->doHTML($this->input->post("search"));
             //$search_str="Artem";
            $text="";
            foreach($this->Search->doSearch($search_str) as $row){
                
                $text=$text." ".$this->Template->doPreview($row);
            }
          if($text=="") {
              $text="Ничего не найдено!";
          }
          echo $text;
                  

         }
           function doAddMyFriends($id_to){
                if($this->User->checkAuth() and (int)$id_to){
                  $id_from=(int)$this->session->userdata('id');
                  $text=$this->Filter->doHTML($this->input->post("text"));
                  echo $this->Friends->doAdd($id_from,$id_to,$text);
                }else {

                    echo "0";
                }

            }
              function doListFriends(){
               
              if($this->User->checkAuth() ){
                $id_user=(int)$this->session->userdata('id');
                foreach($this->Friends->getFriends($id_user) as $row){
            
                      echo $this->Template->doPreview($row,1);
                }
              }

            }
            function  getMicroNews(){
               if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                foreach($this->Micronews->getMNews($id_user) as $row){
                       
                      echo $this->Template->doMicroNews($row,$row->text,$row->data);
                }
                  
               }
            }
            function setStatus(){
                
                if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                    $status=$this->Filter->doHTML($this->input->post("status"));
                    //serialize
                    $profile=unserialize($this->session->userdata('profile'));
                    $profile["status"]=$status;
                    $profile=serialize($profile);
                
                    if($this->User->updateProfile($id_user,$profile)){
                        $newdata = array(
                   'id'  => $id_user,
                   'profile'     => $profile,
                   'logged_in' => TRUE
               );

                     $this->session->set_userdata($newdata);
                     $this->Micronews->add($id_user,$status);
                     echo "1";
                    }else {
                      echo "0";
                    }

                }
            }
            function newMessage(){
                  if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                    $id_to=(int)$this->input->post("id_user");
                    $text=$this->Filter->doHTML($this->input->post("text"));
                    $this->Message->add($id_user,$id_to,$text);
                    echo "1";
                  }
            }
            function doSelect(){
                  if($this->User->checkAuth() ){
                $id_user=(int)$this->session->userdata('id');
                foreach($this->Friends->getFriends($id_user) as $row){
               
                      echo $this->Template->doSelect($row);
                }
              }
            }
            function getMessage(){
                      if($this->User->checkAuth() ){
                $id_user=(int)$this->session->userdata('id');
                
                 foreach($this->Message->get($id_user) as $row){
                   
                      echo $this->Template->doMessage($row);
                }
                      }
            }
            function doReadMessage($id_message){
                if($id_message==null or $id_message=="0" or $id_message=="" or !(int)$id_message) return false;
                if($this->User->checkAuth() ){
                    $this->Message->doRead($id_message);
                }
                }
             function checkNewMessage(){
 if($this->User->checkAuth() ){
                $id_user=(int)$this->session->userdata('id');
                
                echo $this->Message->checkNewMessage($id_user);

             }
             }
             function logout(){

                 $this->session->sess_destroy(); 
             }
             function addfriends($id_to){
                  if($this->User->checkAuth() ){
                $id_user=(int)$this->session->userdata('id');
                $text=$this->Filter->doHTML($this->input->post("text"));
                   if(!$this->Friends->isFriends($id_user,$id_to)){
                         $this->Friends->doAdd($id_user,$id_to,$text);
           }
                  }
             }
             function doRequest(){
                    if($this->User->checkAuth() ){
                $id_user=(int)$this->session->userdata('id');
                foreach($this->Friends->getRequest($id_user)as $row){
                    echo  $this->Template->doRequest($row);
                }
             }
             }
             function doEditFriend($id_zapr,$bool){
                 if($id_zapr==null or $id_zapr=="" or !(int)$id_zapr or $bool==null or $bool=="" or !(int)$bool) return false;
                   if($this->User->checkAuth() ){
                 $id_user=(int)$this->session->userdata('id');
                $this->Friends->doEdit($id_zapr,$bool);
                $this->Micronews->Add($id_user,"Подружился с новым пользователем!!");
                   }

             }
             function doEditContact(){
                   if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                    $icq=$this->Filter->doHTML($this->input->post("icq"));
                    $skype=$this->Filter->doHTML($this->input->post("skype"));
                    $jabber=$this->Filter->doHTML($this->input->post("jabber"));
                    //serialize
                    $profile=unserialize($this->session->userdata('profile'));
                    $profile["icq"]=$icq;
                    $profile["skype"]=$skype;
                    $profile["jabber"]=$jabber;
                    $profile=serialize($profile);

                    if($this->User->updateProfile($id_user,$profile)){
                        $newdata = array(
                   'id'  => $id_user,
                   'profile'     => $profile,
                   'logged_in' => TRUE
               );

                     $this->session->set_userdata($newdata);
                     $this->Micronews->add($id_user,"Обновил контактные данные");
                     echo "1";
                    }else {
                      echo "0";
                    }

                }
             }
              function doEditNS(){
                   if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                    $name=$this->Filter->doHTML($this->input->post("name"));
                    $surname=$this->Filter->doHTML($this->input->post("surname"));

                    //serialize
                    $profile=unserialize($this->session->userdata('profile'));
                    $profile["name"]=$name;
                    $profile["surname"]=$surname;
                    
                    $profile=serialize($profile);

                    if($this->User->updateProfile($id_user,$profile)){
                        $newdata = array(
                   'id'  => $id_user,
                   'profile'     => $profile,
                   'logged_in' => TRUE
               );

                     $this->session->set_userdata($newdata);
                     $this->Micronews->add($id_user,"Обновил контактные данные");
                     echo "1";
                    }else {
                      echo "0";
                    }

                }
             }
             function doComment($id_mnews){
                 if($id_mnews==null or !(int)$id_mnews or $id_mnews=="") return false;
               
                 if($this->User->checkAuth()){
                       
                     foreach($this->Comments->get($id_mnews) as $row){
                         echo $this->Template->doComment($row);
                     }
                     $form='<form onSubmit="doAddComment('.$id_mnews.');return false;"><input type="text" name="comment" id="form_comment"><br><input type=submit value="Отправить"></form>';
                     echo  $form;
                 }

             }
             function addComment($id_mnews){
                  if($id_mnews==null or !(int)$id_mnews or $id_mnews=="") return false;
                 $text=$this->Filter->doHTML($this->input->post('text'));
                 if($this->User->checkAuth()){
                       $id_user=(int)$this->session->userdata('id');
                       $this->Comments->add($id_mnews,$id_user,$text);
                       $this->doComment($id_mnews);

                 }
             }
             function addGroup(){
                 if($this->User->checkAuth()){

                       $id_user=(int)$this->session->userdata('id');
                       $text=$this->Filter->doHTML($this->input->post('text'));
                       $name=$this->Filter->doHTML($this->input->post('name'));
                       $info['name']=$name;
                       $info['description']=$text;


                    //serialize
                       if(!$id_group=$this->Group->add($id_user,serialize($info)))  return false;
                    $profile=unserialize($this->session->userdata('profile'));
                    $group=$name."|".$id_group.";";
                    $profile["groups"]=$group;

  echo "1";
                    $profile=serialize($profile);

                    if($this->User->updateProfile($id_user,$profile)){
                        $newdata = array(
                   'id'  => $id_user,
                   'profile'     => $profile,
                   'logged_in' => TRUE
               );
                        $this->session->sess_destroy(); 
                    $this->Micronews->add($id_user,"Создал группу <a href='".base_url()."/group".$id_group."'>".$name."</a>");
                     $this->session->set_userdata($newdata);
                     
                 }
             }
             }
             function addGroupNews(){
                   if($this->User->checkAuth()){
                   $id_user=(int)$this->session->userdata('id');
                    $text=$this->Filter->doHTML($this->input->post('text'));
                       $id_group=$this->Filter->doHTML($this->input->post('group'));
                  if($this->Group->isCreated($id_group,$id_user)) {
                       if($this->Micronews->addGroupNews($id_group,$text)){
                           echo "1";
                       }
                  }
             }


             }
             function doGroupNews($id_group){
                  if($this->User->checkAuth()){
                    foreach($this->Micronews->getGroup($id_group) as $list){

                      $data["micronews"]=$data["micronews"]."".$this->Template->doGroupNews($list,$list->text,$list->data);

                  }
                  echo $data["micronews"];
                  }
             }
             function doSaveGroup($id_group){
                  if($this->User->checkAuth()){
                   $id_user=(int)$this->session->userdata('id');
                    $description_group=$this->Filter->doHTML($this->input->post('description'));
                       $name_group=$this->Filter->doHTML($this->input->post('name'));
                      if($this->Group->isCreated($id_group,$id_user)) {
                    $info="";
                     foreach($this->Group->get($id_group) as $row){
                       
                      $info=unserialize($row->info);
                     }
                     $info["name"]=$name_group;
                     $info["description"]=$description_group;
                     $info=serialize($info);
                     $this->Group->edit($id_group,$info);
                     
                  }

             }

             }
             function doJoinGroup($id_group){
                 if($id_group==null or $id_group=="" or !(int)$id_group) return false;
                  if($this->User->checkAuth())
                  {
                      $id_user=(int)$this->session->userdata('id');
                      if($this->Group->isPartipiants($id_group,$id_user)) return false;
                      $info="";
                      foreach($this->Group->get($id_group) as $row){
                           $info=unserialize($row->info);
                      }
                       $profile=unserialize($this->session->userdata('profile'));
                    $profile["groups"]=$profile["groups"]."".$info["name"]."|".$row->id_group.";";
                       $info["participants_id"]=$info["participants_id"]."".$id_user.",";
                    $info=serialize($info);
                   $this->Group->edit($id_group,$info);
                    $profile=serialize($profile);

                    if($this->User->updateProfile($id_user,$profile)){
                        $newdata = array(
                   'id'  => $id_user,
                   'profile'     => $profile,
                   'logged_in' => TRUE
               );
                    $this->session->sess_destroy(); 
                     $this->session->set_userdata($newdata);
                     echo "1";
                  }
                  }
             }
                  function doExitGroup($id_group){
                 if($id_group==null or $id_group=="" or !(int)$id_group) return false;
                  if($this->User->checkAuth())
                  {
                      $id_user=(int)$this->session->userdata('id');
                      
                      if(!$this->Group->isPartipiants($id_group,$id_user)) return false;
                      $info="";
                      foreach($this->Group->get($id_group) as $row){
                           $info=unserialize($row->info);
                      }
                     
                       $profile=unserialize($this->session->userdata('profile'));
                       $groups= str_replace($info["name"]."|".$row->id_group.";", "", $profile["groups"]);
                    $profile["groups"]=$groups;
                    $participants_id=str_replace($id_user.",", "", $info["participants_id"]);
                       $info["participants_id"]=$participants_id;
                       
                    $info=serialize($info);
                   $this->Group->edit($id_group,$info);
                    $profile=serialize($profile);

                    if($this->User->updateProfile($id_user,$profile)){
                        $newdata = array(
                   'id'  => $id_user,
                   'profile'     => $profile,
                   'logged_in' => TRUE
               );
                    $this->session->sess_destroy();
                     $this->session->set_userdata($newdata);
                     echo "1";
                  }
                  }
             }
             function getTalks($id_talks){
                     $id_group="";
                  if($id_talks==null or $id_talks=="" or !(int)$id_talks) return false;
                    if($this->User->checkAuth())
                  {
                    
                      $text='';
                          foreach($this->Talks->getTalks($id_talks) as $var){
                           
                       $id_group=$var->id_group;
                       $text=$text."".$this->Template->doPostTopic($var);
                  }
                    echo "<h2><a href='#' onclick='listTalk(".$id_group.")'>Вернуться к обсуждениям</a></h2>";
                  echo $text;
                  $form="<form onSubmit='addTalk(".$id_group.",".$id_talks.",0);return false;'>Текст сообщения<br><textarea id='forum_text' rows=3 cols=35></textarea><br><input type=submit value='Опубликовать'></form>";
                  echo $form;
                    }
             }
             function addTalk($id_group,$id_talks=0){
                   if($this->User->checkAuth())
                  {
                      $id_user=(int)$this->session->userdata('id');
                      $text=$this->Filter->doHTML($this->input->post('text'));
                      $title=$this->Filter->doHTML($this->input->post('title'));
                      
                    echo $this->Talks->add($id_user,$id_talks,$id_group,$text,$title);
                
                   }
             }
             function listTalk($id_group){
                 if($this->User->checkAuth())
                  {
                      foreach($this->Talks->get($id_group) as $var){
                      $data["talk"]=$data["talk"]."".$this->Template->doNameTopic($var);
                  }
                   $data["talk"]="<h2><a href='#' onclick='doTalks(".$id_group.");return false;'>Создать обсуждение</a></h2>".$data["talk"];
                   echo $data["talk"];
                 }
             }
             function doOnlineUsers(){
                 if($this->User->checkAuth())
                  {
                 foreach($this->User->listOnline() as $row){
                     $user_data=unserialize($row->user_data);
                     $id_user=$user_data['id'];
                     $profile=unserialize($user_data["profile"]);
                     if(!isset($profile["photo"]) or $profile["photo"]==null or $profile["photo"]=="" ) $profile["photo"]="nophoto.jpg";
                     echo "<a href='".base_url()."id".$id_user."'>".$profile['surname']." ".$profile["name"]."</a><br>";
                 }
                  }
             }
             function doSendFastMessage(){
                   if($this->User->checkAuth()){
                    $id_user=(int)$this->session->userdata('id');
                    $text=$this->Filter->doHTML($this->input->post("text"));
                    $this->Message->addFast($id_user,$text);
                    echo "1";
                  }
             }
             function doListFastMessage(){
                 if($this->User->checkAuth())
                  {
                    foreach($this->Message->getFast() as $row){
                        $profile=unserialize($row->profile);
                         $title="<a href='".base_url()."id".$row->id."'>".$profile["surname"]." ".$profile["name"]."</a>";
                        echo $title." :".$row->text." ".$row->data."<br>";
                    }
                     
                 }
             }

}
