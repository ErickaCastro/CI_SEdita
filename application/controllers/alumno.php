<?php
    if (! defined('BASEPATH'))
    exit ('No se puede ejecutar directamente este SCRIPT');

    class alumno extends CI_Controller {
        
        function __construct(){
            parent::__construct();
             $this->load->library('grocery_CRUD');
            $this->load->model("mod_alumno","alumno");
        }
        
        function _remap($m){
            if(!$this->clslogin->check())
            {
				redirect(site_url("login"));
			}
            elseif($m == "guardar"){
                $this->guardar();
            }
            elseif($m == "cargar_niveles"){
                $m= $this->input->post("jornada");
                $r=$this->alumno->cargar_niveles($m);
                echo $r;  
            }
            elseif($m == "cargar_cursos"){      
                $m= $this->input->post("jornada");
                $n= $this->input->post("nivel");
                $r=$this->alumno->cargar_cursos($m,$n);
                echo $r;   
            }
            elseif($m == "cargar_especializaciones"){
                $m= $this->input->post("jornada");
                $n= $this->input->post("curso");
                $r=$this->alumno->cargar_especializaciones($m,$n);
                echo $r;
            }
            elseif($m == "cargar_paralelos"){
                $m= $this->input->post("jornada");
                $n= $this->input->post("curso");
                $r=$this->alumno->cargar_paralelos($m,$n);
                echo $r;
            }
            elseif($m == "cargar_paralBachill"){
                $m= $this->input->post("jornada");
                $n= $this->input->post("curso");
                $o= $this->input->post("espec");
                $r=$this->alumno->cargar_paralBachill($m,$n,$o);
                echo $r;
            }
            elseif($m == "num_Alumnos"){
                $m= $this->input->post("jornada");
                $n= $this->input->post("curso");
                $p= $this->input->post("paral");
                $r=$this->alumno->num_Alumnos($m,$n,$p);
                echo $r;
            }
            elseif($m == "num_AlumnosBach"){
                $m= $this->input->post("jornada");
                $n= $this->input->post("curso");
                $o= $this->input->post("espec");
                $p= $this->input->post("paral");
                $r=$this->alumno->num_AlumnosBach($m,$n,$o,$p);
                echo $r;
            }
            elseif($m == "autocompletar_alumno"){
                $m= $this->input->post("id_alumno");
                $r=$this->alumno->autocompletar_alumno($m);
                echo $r;
            }
            elseif($m == "listado_alumnos"){
                $j = $this->input->post("jornada");
                $c = $this->input->post("curso");
                $e = $this->input->post("espec");
                $p = $this->input->post("paral");
                $indBachill=$this->input->post("indBachill");
                $this->listado_alumnos($j,$c,$e,$p,$indBachill);       
            }
            else{
                $this->nuevo();
            }
        }
        

        function nuevo(){
            $this->load->helper("form");
            $data["categoria_alumno"]= $this->alumno->cargar_categorias();
            $data["jornada"]= $this->alumno->cargar_jornadas();
            $this->load->view("view_registroalumno",$data);
            
        }
    
    
        function nuevo1(){
            $this->load->helper("form");
            $data["categoria_alumno"]= $this->alumno->cargar_categorias();
            $data["jornada"]= $this->alumno->cargar_jornadas();
             //$output->categoria_alumno= $this->alumno->cargar_categorias();
             //$output->jornada=$this->alumno->cargar_jornadas();
             //$this->alumnos();
             //$this->_view_crud($output); 
              $this->load->view("view_registroalumno",$data);
        }
        
        function guardar(){
            $this->alumno->insertar_alumno();
            echo "GUARDADO";
            
        }
        
        
     function alumnos()
        {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('alumno');
            $crud->set_subject('Alumnos');
            $crud->display_as('alu_nombres','Nombres');
            $crud->display_as('alu_apellidos','Apellidos');
            $crud->display_as('alu_domicilio','Domicilio');
            $crud->display_as('alu_telefono','Telefono');
            
            
            $output = $crud->render();
            $output->categoria_alumno= $this->alumno->cargar_categorias();
            $output->jornada=$this->alumno->cargar_jornadas();
            $this->load->view("view_registroalumno",$output);
     
            //$this->_view_crud($output);                
        }
 
 
        function listado_alumnos($j,$c,$e,$p,$indBachill)
        {
            $crud = new grocery_CRUD();
            $crud->set_subject('Alumnos');  
            $crud->set_theme('datatables');
              
            $crud->set_table('alumno');
            $crud->set_relation('alu_curso_paralelo_id','curso_paralelo','cp_id');
            $crud->set_relation('alu_representante_id','representante','rep_id');
            $crud->set_model('users_join');
            
          
            $crud->columns('alu_nombres','alu_apellidos','alu_domicilio','alu_telefono','rep_nombres','rep_apellidos');
                
            $crud->where('cp_jornada_id',$j);
            $crud->where('cp_curso_id',$c);
                if($indBachill==1)
                {
                    $crud->where('cp_especializacion_id',$e);
                }
            $crud->where('cp_paralelo_id',$p);
             
            $crud->display_as('alu_nombres','Nombres del Alumno');
            $crud->display_as('alu_apellidos','Apellidos del Alumno');
            $crud->display_as('alu_domicilio','Domicilio');
            $crud->display_as('alu_telefono','Telefono');
            $crud->display_as('rep_nombres','Nombres del Representante');
            $crud->display_as('rep_apellidos','Apellidos del Representante');
            
            $crud->unset_operations();
            $output = $crud->render();
            
            $output->categoria_alumno= $this->alumno->cargar_categorias();
            $output->jornada=$this->alumno->cargar_jornadas();  
            $this->_view_crud($output);          
        }
 

        
        function _view_crud($output = null)
    	{
    		$this->load->view('view_cruds.php',$output);	
    	}
        
        
        

    }
?>