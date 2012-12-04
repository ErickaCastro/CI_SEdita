<?php
    if (! defined('BASEPATH'))
    exit ('No se puede ejecutar directamente este SCRIPT');

    class nuevo_alumno extends CI_Controller {
        
        function __construct(){
            parent::__construct();
            $this->load->model("mod_alumno","alumno");
        }
        
        function _remap($m){
            if($m == "guardar"){
                $this->guardar();
            }elseif($m == "cargar_curso"){
                //$this->load->library("uri");
                //$m=$this->uri->segment(3);
                //echo $this->vehiculo->cargar_curso($m);
                
                $m = $this->input->post("nivel");
                $r = $this->alumno->cargar_curso($m);
                echo $r;
                
            }
            else{
                $this->nuevo();
            }
        }
        
        function nuevo(){
            $this->load->helper("form");
            $data["jornada"]= $this->alumno->cargar_jornadas();
            $data["nivel"]= $this->alumno->cargar_niveles();
            $data["categoria_alumno"]= $this->alumno->cargar_categorias();
            $this->load->view("view_registroalumno",$data);
        }
        
        function guardar(){
            $this->alumno->insertar_alumno();
            echo "GUARDADO";
            //$this->nuevo();    
        }
    }
?>