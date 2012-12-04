<?php 
    
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Mantenimiento extends CI_Controller {
        
        function __construct(){
    		parent::__construct();
            $this->load->library('grocery_CRUD');
    	}
     
        function _remap($metodo){
            if(!$this->clslogin->check()){
				redirect(site_url("login"));
			}
            else{
                if($metodo=="contrasenas"){
                    $this->usuario();
                }
                elseif($metodo=="materias"){
                    $this->materias();
                }
                else{
                    $this->load->view('view_mantenimiento');
                }
            }
        }
        
        function _view_crud($output = null)
    	{
    		$this->load->view('view_cruds.php',$output);	
    	}
        
        function usuario(){
            try{
    			/* This is only for the autocompletion */
    			$crud = new grocery_CRUD();
    
    			$crud->set_theme('datatables');
    			$crud->set_table('usuario');
    			$crud->set_subject('Usuarios');
    			$crud->required_fields('usu_nombre', 'usu_clave', 'usu_tipo');
                
                $crud->display_as('usu_nombre','Nombre de Usuario');
                $crud->display_as('usu_tipo','Tipo de Usuario');
                $crud->display_as('usu_clave','Contrase&ntilde;a');
                
                $crud->unset_columns('usu_clave','usu_personal_id');
                $crud->add_fields('usu_nombre', 'usu_clave', 'usu_tipo');
                $crud->edit_fields('usu_nombre', 'usu_clave', 'usu_tipo');
                
    			$output = $crud->render();
    			$this->_view_crud($output);
    			
    		}catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}        
        }
        
        function materias(){
            try{
    			/* This is only for the autocompletion */
    			$crud = new grocery_CRUD();
    
    			$crud->set_theme('datatables');
    			$crud->set_table('materia');
    			$crud->set_subject('Materias');
    			$crud->required_fields('mat_nombre');
                
                $crud->display_as('mat_nombre','Nombre de Materia');
                
                $crud->add_fields('mat_nombre');
                $crud->edit_fields('mat_nombre');
                
    			$output = $crud->render();
    			$this->_view_crud($output);
    			
    		}catch(Exception $e){
    			show_error($e->getMessage().' --- '.$e->getTraceAsString());
    		}        
        }
        
    }
    
?>