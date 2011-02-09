<?php

class Welcome extends Controller {
var $browser;
	function Welcome()
	{
		parent::Controller();
                $this->load->helper("url");
                $this->load->library('user_agent');
                $this->browser=$this->agent->browser();
               //$this->session->sess_destroy();
	}
	
	function index()
	{
                 if($this->browser=="Opera") {
                $data['browser']='<link rel="stylesheet" href="'.base_url().'design/css/opera.css" type="text/css" media="screen, projection" />';
                 }else {
                  $data['browser']='';
                 }
                 $data['title']=$this->config->item('title');
                 
         $this->load->template("base_design", "static",$data);
		
                
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */