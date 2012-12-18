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
                if($this->clslogin->getTipoUser() == 1)
                    $data["usuario"] = "Administrador";
                else
                    $data["usuario"] = "Profesor";
                    
                $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                $data["fecha"] = $dias[date('w')] .", " .date('d') ." de " .$meses[date('n')-1] ." del " .date('Y');
                
                $this->load->view('view_administrador', $data);
            }
        }
    }
    
?>