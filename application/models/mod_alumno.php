<?php
    if (! defined('BASEPATH'))
    exit ('No se puede ejecutar directamente este SCRIPT');

    class mod_alumno extends CI_Model {
        
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
            $rs=$this->db->get("jornada");
            $info=array();
            foreach ($rs->result() as $fila){
                $info[$fila->jor_id] = $fila->jor_id ."::" .$fila->jor_nombre;
            }
                
            return $info;
        }
        
        function cargar_niveles(){
            $this->db->group_by("niv_nombre");
            $rs=$this->db->get("nivel");
            $info=array();
            foreach ($rs->result() as $fila){
                $info[$fila->niv_id] = $fila->niv_id ."::" .$fila->niv_nombre;
            }
                
            return $info;
        }
        
        function cargar_curso($nivel){
            $this->db->where("cur_nivel_id",$nivel);
            $rs= $this->db->get("curso");
            $info="";
            foreach($rs->result() as $row){
                $info .="<option value='".$row->cur_id."'>".$row->cur_nombre."</option>";
            }
            return $info;
        }
        
 
        
        function cargar_marcas(){
            $this->db->group_by("marca_nombre");
            $rs=$this->db->get("tbl_marca");
            $info=array();
            foreach ($rs->result() as $fila){
                $info[$fila->marca_id] = $fila->marca_id ."::" .$fila->marca_nombre;
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
                            "alu_edad"=>$this->input->post("sexo"),
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