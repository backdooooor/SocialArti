<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
                $this->load->helper("url");
               //$this->session->sess_destroy();
	}
	
	function index()
	{
                 
		$this->load->view('static');
                
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */