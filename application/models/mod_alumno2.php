<?php
    if (! defined('BASEPATH'))
    exit ('No se puede ejecutar directamente este SCRIPT');

    class mod_alumno2 extends CI_Model {
        
        function __construct(){
            parent::__construct();
        }
        

        function cargar_categorias(){
            $this->db->group_by("cat_nombre");
            $rs=$this->db->get("categoria_alumno");
            $info=array();
            foreach ($rs->result() as $fila){
                $info[$fila->cat_id] = $fila->cat_id ."::" .$fila->cat_nombre;
            }
                
            return $info;
        }
        
        function cargar_jornadas(){
            $this->db->group_by("jor_nombre");
            $rs = $this->db->get("jornada");
            $info = array();
            
            foreach ($rs->result() as $fila){
                $info[$fila->jor_id] = $fila->jor_id ."::" .$fila->jor_nombre;
            }
                
            return $info;
        }
        
        function cargar_niveles(){
            $this->db->group_by("niv_nombre");
            $this->db->order_by("niv_id");
            $rs=$this->db->get("nivel");
            $info=array();
            $info[0] = "<< Todos >>";
            foreach ($rs->result() as $fila){
                $info[$fila->niv_id] = $fila->niv_id ."::" .$fila->niv_nombre;
            }
                
            return $info;
        }
        
        function cargar_curso($nivel){
            $info="";
            
            if($nivel == 0){
                $info .="<option value='0'>Todos los Cursos</option>";
                $this->db->where("cur_nivel_id",1);
                $this->db->or_where("cur_nivel_id",2);                                
            }elseif($nivel == 1){
                $info .="<option value='-1'>Todos los Basicos</option>";
                $this->db->where("cur_nivel_id",$nivel);                
            }else{
                $info .="<option value='-2'>Todos los Bachilleratos</option>";
                $this->db->where("cur_nivel_id",$nivel);                                
            }
            
            $this->db->order_by("cur_id");
            $rs= $this->db->get("curso");            
                        
            foreach($rs->result() as $row){
                $info .="<option value='".$row->cur_id."'>".$row->cur_nombre."</option>";
            }
            return $info;
        }
        
        function cargar_especializacion($curso, $jornada){
            $this->db->select("esp_nombre, esp_id");
            $this->db->from("curso_paralelo");
            $this->db->where("cp_curso_id",$curso);
            $this->db->where("cp_jornada_id",$jornada);
            $this->db->where("cp_paralelo_id",1);
            $this->db->join("especializacion", "cp_especializacion_id = esp_id");
            
            $rs= $this->db->get();
            $info="";
            
            $info .="<option value='0'>Todas las Especializaciones</option>";
                        
            foreach($rs->result() as $row){
                $info .="<option value='".$row->esp_id."'>".$row->esp_nombre."</option>";
            }
            return $info;
        }
        
        
        function insertar_alumno(){
            $data = array(
                            "alu_id"=>$this->input->post("txtMatric"),
                            "alu_nombres"=>$this->input->post("txtNombres"),
                            "alu_apellidos"=>$this->input->post("txtApellidos"),
                            "alu_domicilio"=>$this->input->post("txtDomicilio"),
                            "alu_telefono"=>$this->input->post("txtTelef"),
                            "alu_pais"=>$this->input->post("txtPais"),
                            "alu_lugar_nacimiento"=>$this->input->post("txtLugNac"),
                            "alu_fecha_nacimiento"=>$this->input->post("txtFecNac"),
                            "alu_sexo"=>$this->input->post("sexo"),
                            "alu_edad"=>$this->input->post("edad"),
                            "alu_madre_nombres"=>$this->input->post("txtNombMadre"),
                            "alu_madre_ocupacion"=>$this->input->post("txtOcupMadre"),
                            "alu_madre_pais"=>$this->input->post("txtPaisMadre"),
                            "alu_padre_nombres"=>$this->input->post("txtNombPadre"),
                            "alu_padre_ocupacion"=>$this->input->post("txtOcupPadre"),
                            "alu_padre_pais"=>$this->input->post("txtPaisPadre"),
                            "alu_principal_representante"=>$this->input->post("cmbModelo"),
                            "alu_documentacion"=>$this->input->post("document"),
                            "alu_comentarios"=>$this->input->post("txtComentarios"),
                            "alu_categoria_alumno_id"=>$this->input->post("cmbCategoria"),
                            "alu_representante_id"=>$this->input->post("cmbModelo"),
                            "alu_curso_paralelo_id"=>$this->input->post("cmbModelo"),
                            
            );
            $this->db->insert("alumno",$data);
        }
        
    }
?>