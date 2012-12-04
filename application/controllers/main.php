<?php 
    
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Main extends CI_Controller {
        
        function __construct(){
    		parent::__construct();
    	}
     
        function _remap($metodo){
            if(!$this->clslogin->check()){
				redirect(site_url("login"));
			}
            else{
                //echo $this->clslogin->getId();
                $this->load->view('welcome_message');
            }
        }
    }
    
?>