<?php 
    
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Mantenimiento extends CI_Controller {
        
        function __construct(){
    		parent::__construct();
            $this->load->library('grocery_CRUD');
            $this->load->model("mod_alumno2","alumno");
            $this->load->model("mod_mantenimiento","mantenimiento");
            $this->load->model("mod_curso","curso");
    	}
     
        function _remap($metodo){
            if(!$this->clslogin->check()){
				redirect(site_url("login"));
			}
            else{
                if($metodo=="usuarios"){
                    $u = $this->input->post("usuario");
                    $num = $this->input->post("indicador");
                    $this->usuarios($u, $num);
                }
                elseif($metodo=="materias"){
                    $this->materias();
                }
                elseif($metodo=="cursos"){
                    $c = $this->input->post("curso");
                    $e = $this->input->post("especializacion");
                    $j = $this->input->post("jornada");
                    $num = $this->input->post("indicador");
                    $this->cursos($j, $c, $e, $num);
                    
                }
                elseif($metodo=="expListCursos"){
                    $j = $this->input->post("jornada");
                    $c = $this->input->post("curso");
                    $e = $this->input->post("especializacion");
                    $num = $this->input->post("indicador");
                    $this->exp_list_cursos($j,$c,$e,$num);
                    
                }
                elseif($metodo=="expListUsuarios"){
                    $u = $this->input->post("tipoUsuario");
                    $num = $this->input->post("indicador");
                    $this->exp_list_usuarios($u,$num);
                    
                }
                elseif($metodo=="agregar_paralelo"){
                    $this->load->view("view_paralelo");
                }
                elseif($metodo=="paralelo"){
                    $this->curso->insertar_paralelo();
                }
                else{
                    $this->cursos(0, 0, 0, 0);
                }   
            }
        }
        
        
        function cursos($j, $c, $e, $num){
            $jornada = $this->mantenimiento->nombre_jornada($j);
            $curso = $this->mantenimiento->nombre_curso($c);
            $especializacion = $this->mantenimiento->nombre_especializacion($e);
            
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('curso_paralelo');
			$crud->set_subject('Cursos');
            
            $crud->set_relation('cp_curso_id','curso','cur_nombre');
            $crud->set_relation('cp_paralelo_id','paralelo','par_nombre');
            $crud->set_relation('cp_jornada_id','jornada','jor_nombre');
            $crud->set_relation('cp_especializacion_id','especializacion','esp_nombre');
            
            $crud->display_as('cp_curso_id','Curso');
            $crud->display_as('cp_especializacion_id','Especializacion');
            $crud->display_as('cp_paralelo_id','Paralelo');
            $crud->display_as('cp_jornada_id','Jornada');
            
            $crud->required_fields('cp_curso_id','cp_paralelo_id','cp_jornada_id');
            
            if($c > 0 && $c != null){
                $crud->where('cur_nombre',$curso[$c]);
            }else{
                foreach($curso as $cur){
                    $crud->or_where('cur_nombre',$cur);
                }  
            }
            
            if($e > 0){
                $crud->where('esp_nombre',$especializacion[$e]);
            }
            
            $output = $crud->render();
            $output->nivel = $this->alumno->cargar_niveles();
            $output->curso= $this->alumno->cargar_curso(0);
            $output->jornada = $this->alumno->cargar_jornadas();
            $output->j = $j;
            $output->c = $c;
            $output->e = $e;

            if($num == 0){
                $this->load->view('Listados/view_listado_cursos',$output);
            }else{
                $this->load->view('view_ajax_listado_cursos',$output);
            }
        }
        
        
        function usuarios($u, $num){
            $usuario = $this->mantenimiento->nombre_tipo_usuario($u);
			/* This is only for the autocompletion */
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('usuario');
			$crud->set_subject('Usuarios');
			$crud->required_fields('usu_nombre', 'usu_clave', 'usu_tipo');
            
            $crud->set_relation('usu_tipo','tipo_usuario','tip_nombre');
            
            $crud->display_as('usu_nombre','Nombre de Usuario');
            $crud->display_as('usu_tipo','Tipo de Usuario');
            $crud->display_as('usu_clave','Contrase&ntilde;a');
            
            $crud->unset_columns('usu_clave','usu_personal_id');
            $crud->add_fields('usu_nombre', 'usu_clave', 'usu_tipo');
            $crud->edit_fields('usu_nombre', 'usu_clave', 'usu_tipo');
            
            if($u > 0){
                $crud->where('tip_nombre',$usuario[$u]);
            }
            
			$output = $crud->render();
            $output->usuario = $this->mantenimiento->cargar_tipo_usuario();
            $output->u = $u;
            
            if($num == 0 || $num == null)
                $this->load->view("Listados/view_listado_usuarios", $output);
            else
                $this->load->view("view_ajax_listado_usuarios", $output);        
        }
        
        function materias(){
            $crud = new grocery_CRUD();
    
			$crud->set_theme('datatables');
			$crud->set_table('materia_curso');
			$crud->set_subject('Materias por Cursos');
			$crud->required_fields('mat_nombre', 'cp_id', 'per_nombres');
            
            $crud->set_relation('mc_materia_id','materia','mat_nombre');
            $crud->set_relation('mc_curso_paralelo_id','curso_paralelo','cp_id');
            $crud->set_relation('mc_personal_id','personal','per_nombres');
            
			$output = $crud->render();
			$this->load->view("Listados/view_listado_materias", $output);    
        }
        
        function exp_list_cursos($j, $c, $e, $num){
            $jornada = $this->mantenimiento->nombre_jornada($j);
            $curso = $this->mantenimiento->nombre_curso($c);
            $especializacion = $this->mantenimiento->nombre_especializacion($e);
            
            if($c > 0 && $c != null){
                $this->db->where("cur_nombre", $curso[$c]);
            }else{
                foreach($curso as $cur){
                    $this->db->or_where("cur_nombre", $cur);
                }  
            }
            
            if($e > 0){
                $this->db->where("esp_nombre", $especializacion[$e]);
            }

            $this->db->order_by("cur_id");
            $this->db->select("cur_nombre, esp_nombre, jor_nombre, par_nombre");
            $this->db->from("curso_paralelo");
            $this->db->join("jornada", "jor_id=cp_jornada_id");
            $this->db->join("paralelo", "par_id=cp_paralelo_id");
            $this->db->join("curso", "cur_id=cp_curso_id");
            $this->db->join("especializacion", "esp_id=cp_especializacion_id");
            
            $resultado = $this->db->get();
            
            if($num == 0 || $num == null){
                $this->load->library('export_pdf');                 
                
                $pdf = new export_pdf();
                $fecha_actual = date('Y');
                $fecha_despues = date('Y')+1;
                $a�o_lectivo = $fecha_actual ." - " .$fecha_despues ;
                
                $pdf->exportToPDF_Cursos($resultado, $a�o_lectivo);
            }
            else{
                $this->load->library('export_excel');
                
                $nom_tabla = array("cur_nombre", "esp_nombre", "par_nombre", "jor_nombre");
                $nom_columnas = array("Curso", "Especializaci�n", "Paralelo", "Jornada");
                
                $excel = new export_excel();
                $excel->exportToExcel($resultado, "ListadoCursos.xls", 4, $nom_columnas, $nom_tabla);
            }   
        }
        
        function exp_list_usuarios($u, $num){
            $usuario = $this->mantenimiento->nombre_tipo_usuario($u);
            
            if($u > 0){
                $this->db->where("tip_nombre", $usuario[$u]);
            }
            
            $this->db->order_by("usu_id");
            $this->db->select("usu_nombre, usu_clave, tip_nombre");
            $this->db->from("usuario");
            $this->db->join("tipo_usuario", "usu_tipo=tip_id");
            
            $resultado = $this->db->get();
            
            if($num == 0 || $num == null){
                $this->load->library('export_pdf');                 
                
                $pdf = new export_pdf();
                $fecha_actual = date('Y');
                $fecha_despues = date('Y')+1;
                $a�o_lectivo = $fecha_actual ." - " .$fecha_despues ;
                
                $pdf->exportToPDF_Usuarios($resultado, $a�o_lectivo);
            }
            else{
                $this->load->library('export_excel');
                
                $nom_tabla = array("usu_nombre", "usu_clave", "tip_nombre");
                $nom_columnas = array("Usuario", "Contrase�a", "Tipo de Usuario");
                
                $excel = new export_excel();
                $excel->exportToExcel($resultado, "ListadoUsuarios.xls", 3, $nom_columnas, $nom_tabla);
            }   
        }
    }
    
?>