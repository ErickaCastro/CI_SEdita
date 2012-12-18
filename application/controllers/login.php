<?php
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class login extends CI_Controller {
    
    	function __construct(){
    		parent::__construct();
            $this->load->library("form_validation");                        
    	}
        
        function _remap($metodo){
            if($metodo=="validar"){
                $this->form_validation->set_rules("txtUser", "Nombres de Usuario", "trim|required|min_length[3]");
            
                if ($this->form_validation->run() == false) {
                    $data["error"]="";
                    $this->load->view("view_login", $data);
                }
				else{
                    $u = $this->input->post("txtUser");
                    $c = $this->input->post("txtClave");
                    
                    if($this->clslogin->login($u, $c)){
                        redirect(site_url("main"));
                    }
                    else{
                        $data["error"]="<div class='alert alert-error' style='text-align:center; 
                                                                                margin-left:470px;
                                                                                margin-right:130px' >
                                            Usuario o Contrase&ntilde;a incorrectos
                                        </div>";
                        $this->_login($data);
                    }
                }
            }
            elseif(!$this->clslogin->check()){
                $data["error"]="";
                $this->_login($data);
            }
            
            else{
                redirect(site_url("main"));
            }
        }
        
        function _login($data){
            $this->load->view("view_login", $data);
        }
        
     }
?>