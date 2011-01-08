<?php

class Ajax extends Controller {

	function Ajax()
	{
		parent::Controller();
                $this->load->model("User");
                $this->load->library('session');
                $this->load->helper('url');
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
        $email=$this->input->post("email");
        $password=$this->input->post("password");
        $profile["name"]=$this->input->post("name");
        $profile["surname"]=$this->input->post("surname");
        $profile["otch"]=$this->input->post("otch");
        $profile["location"]=$this->input->post("from");
        if($email==null or $email=="" or $profile["name"]==null or $profile["name"]=="" or $profile["surname"]=="" or  $profile["surname"]==null  or $profile["otch"]==""  or $profile["otch"]==null  or   $profile["location"]=="" or $profile["location"]==null){
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
                $text="<h2>Моя страница</h2><p>".$profile["name"]."<br/>".$profile["surname"]."<br/>".$profile["otch"]."<br/>".$profile["location"]."</p>";
                echo $text;
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


}
