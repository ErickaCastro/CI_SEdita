<?php
    if (! defined('BASEPATH'))
    exit ('No se puede ejecutar directamente este SCRIPT');

    class mod_alumno extends CI_Model {
        
        function __construct(){
            parent::__construct();
        }
        
         
        function cargar_categorias(){
            //$this->db->group_by("cat_nombre");
            $this->db->order_by("cat_nombre");
            $rs=$this->db->get("categoria_alumno");
            $info=array();
            foreach ($rs->result() as $fila){
                $info[$fila->cat_id] = $fila->cat_id ."::" .$fila->cat_nombre;
            }
                
            return $info;
        }
        
        function cargar_jornadas(){
            //$this->db->group_by("jor_nombre");
            $this->db->order_by("jor_id");
            $rs=$this->db->get("jornada");
            $info=array();
            $info[0]="Seleccione una jornada";
            foreach ($rs->result() as $fila){
                $info[$fila->jor_id] = $fila->jor_id ."::" .$fila->jor_nombre;
            }
                
            return $info;
        }
        
        function cargar_niveles($jornada){
            $this->db->distinct();
            $this->db->select("cur_nivel_id");
            $this->db->from("curso_paralelo");
            $this->db->where("cp_jornada_id",$jornada);
            $this->db->join("curso", "cp_curso_id = cur_id");
            $rs1= $this->db->get();
            $info="";
            $info .="<option value='0'>Seleccione un nivel</option>";
        
            foreach($rs1->result() as $row1){
                $this->db->distinct();
                $this->db->select("niv_id,niv_nombre"); 
                $this->db->where("niv_id",($row1->cur_nivel_id));
                $rs2= $this->db->get("nivel");
                foreach($rs2->result() as $row2){
                $info .="<option value='".$row2->niv_id."'>".$row2->niv_nombre."</option>";
                }
            }
            return $info;
        }
        
   
        function cargar_cursos($jornada,$nivel){
            $this->db->distinct();
            $this->db->select("cur_id,cur_nombre"); 
            $this->db->from("curso_paralelo");
            $this->db->where("cp_jornada_id",$jornada);
            $this->db->where("cur_nivel_id",$nivel);
            $this->db->join("curso", "cp_curso_id = cur_id");
            $rs= $this->db->get();
            $info="";
            $info .="<option value='0'>Seleccione un curso</option>";
            foreach($rs->result() as $row){
                $info .="<option value='".$row->cur_id."'>".$row->cur_nombre."</option>";
            }
            return $info;
        }
        
        
        function cargar_especializaciones($jornada,$curso){
            $this->db->distinct();
            $this->db->select("esp_id,esp_nombre");
            $this->db->from("curso_paralelo");
            $this->db->where("cp_jornada_id",$jornada);
            $this->db->where("cp_curso_id",$curso);
            $this->db->join("especializacion", "cp_especializacion_id = esp_id");
            $rs= $this->db->get();
            $info="";
            
            $info .="<option value='0'>Seleccione una especializaci&oacute;n</option>";
                        
            foreach($rs->result() as $row){
                $info .="<option value='".$row->esp_id."'>".$row->esp_nombre."</option>";
            }
            return $info;
        }
        
        //Otra forma de hacer el query de cargar especializaciones
        function cargar_especializaciones2($jornada,$curso){
            $this->db->distinct();
            $this->db->select("cp_especializacion_id");
            $this->db->where("cp_jornada_id",$jornada);
            $this->db->where("cp_curso_id",$curso);
            $rs1= $this->db->get("curso_paralelo");
 
            $info="";
            $info .="<option value='0'>Seleccione una especializaci&oacute;n</option>";
            foreach($rs1->result() as $row1){ 
                 //$this->db->order_by("esp_nombre");
                $this->db->where("esp_id",($row1->cp_especializacion_id));
                
                $rs2= $this->db->get("especializacion");
                foreach($rs2->result() as $row2){
                $info .="<option value='".$row2->esp_id."'>".$row2->esp_nombre."</option>";
                }
            }
            return $info;
        }
        
        
        function cargar_paralelos($jornada,$curso){
            $this->db->where("cp_jornada_id",$jornada);
            $this->db->where("cp_curso_id",$curso);
            $rs1= $this->db->get("curso_paralelo");
            
            $info="";
            $info .="<option value='0'>Seleccione un paralelo</option>";
            foreach($rs1->result() as $row1){
                $this->db->where("par_id",($row1->cp_paralelo_id));
                $rs2= $this->db->get("paralelo");
                foreach($rs2->result() as $row2){
                $info .="<option value='".$row2->par_id."'>".$row2->par_nombre."</option>";
                }
            }
            return $info;
        }
        
        
        function cargar_paralBachill($jornada,$curso,$espec){
            $this->db->where("cp_jornada_id",$jornada);
            $this->db->where("cp_curso_id",$curso);
            $this->db->where("cp_especializacion_id",$espec);
            $rs1= $this->db->get("curso_paralelo");
            
            $info="";
            $info .="<option value='0'>Seleccione un paralelo</option>";
            foreach($rs1->result() as $row1){
                $this->db->where("par_id",($row1->cp_paralelo_id));
                $rs2= $this->db->get("paralelo");
                foreach($rs2->result() as $row2){
                $info .="<option value='".$row2->par_id."'>".$row2->par_nombre."</option>";
                }
            }
            return $info;
        }
        
        function num_Alumnos($jornada,$curso,$paral){
                $this->db->select("cp_id");
                $this->db->where("cp_jornada_id",$jornada);
                $this->db->where("cp_curso_id",$curso);
                $this->db->where("cp_paralelo_id",$paral);
                $rs= $this->db->get("curso_paralelo");
                $strCpId="";      
                foreach($rs->result() as $row){
                    $strCpId .="".$row->cp_id."";
                }
                $cpId = (int)$strCpId;
                
                
                $this->db->where("alu_curso_paralelo_id",$cpId);
                $this->db->from("alumno");
                $numAlumnos=$this->db->count_all_results();
                 
            return $numAlumnos;
        }
        
        function num_AlumnosBach($jornada,$curso,$espec,$paral){
                $this->db->select("cp_id");
                $this->db->where("cp_jornada_id",$jornada);
                $this->db->where("cp_curso_id",$curso);
                $this->db->where("cp_especializacion_id",$espec);
                $this->db->where("cp_paralelo_id",$paral);
                $rs= $this->db->get("curso_paralelo");
                
                $strCpId="";      
                foreach($rs->result() as $row){
                    $strCpId .="".$row->cp_id."";
                }
                $cpId = (int)$strCpId;
                
                
                $this->db->where("alu_curso_paralelo_id",$cpId);
                $rs1= $this->db->from("alumno");
                $numAlumnos=$this->db->count_all_results();
 
            return $numAlumnos;
        }
        
        
        function autocompletar_alumno($idAlumno){
            
            $this->db->from("alumno");
            $this->db->join("representante", "rep_id=alu_representante_id");
            $this->db->where("alu_id",$idAlumno);
            $rs = $this->db->get();
            
            
            
            //$this->db->where("alu_id",$idAlumno);
            //$rs= $this->db->get("alumno");
            
            $info="";

            foreach($rs->result() as $row){
                //$info .="".$row->alu_apellidos."¬";
                
                 $info .="".$row->alu_documentacion."_".
                            $row->alu_nombres."_".
                            $row->alu_apellidos."_".
                            $row->alu_categoria_alumno_id."_".
                            $row->alu_domicilio."_".
                            $row->alu_telefono."_".
                            $row->alu_pais."_".
                            $row->alu_lugar_nacimiento."_".
                            $row->alu_fecha_nacimiento."_".
                            $row->alu_edad."_".
                            $row->alu_sexo."_".
                            $row->alu_madre_nombres."_".
                            $row->alu_madre_apellidos."_".
                            $row->alu_madre_ocupacion."_".
                            $row->alu_madre_pais."_".
                            $row->alu_padre_nombres."_".
                            $row->alu_padre_apellidos."_".
                            $row->alu_padre_ocupacion."_".
                            $row->alu_padre_pais."_".
                            $row->alu_principal_representante."_".
                            $row->alu_comentarios."_".
                            $row->alu_representante_id."_".
                            $row->alu_curso_paralelo_id."_".
                            $row->rep_nombres."_".
                            $row->rep_apellidos."_".
                            $row->rep_ocupacion."_".
                            $row->rep_telefono."_".
                            $row->rep_domicilio."_".
                            $row->rep_celular."_".
                            $row->rep_pais.""
                ;     
            }
            /*
            $alu_principal_representante="";
                $alu_principal_representante.="".$info[19];
                if($alu_principal_representante=="o")
                {
                    $idRepresentante=$info[21];
                    $this->db->where("rep_id",$idRepresentante);
                    $rsRepOtro= $this->db->get("representante");
                    foreach($rsRepOtro->result() as $row)
                    {
                       
                     }
                    
                    
                }
            */
            return $info;
        }
        

        
        function insertar_alumno(){
            
            $opcRepresent=$this->input->post("rbRepresent");
            $strRepId="";  
            
                if($opcRepresent=="m")
                {
                        $dataRepresentante = array(
                                    "rep_nombres"=>$this->input->post("txtNombMadre"),
                                    "rep_apellidos"=>$this->input->post("txtApellidMadre"),
                                    "rep_ocupacion"=>$this->input->post("txtOcupMadre"),
                                    "rep_telefono"=>$this->input->post("txtTelef"),
                                    "rep_domicilio"=>$this->input->post("txtDomicilio"),
                                    //"rep_celular"=>$this->input->post("txtTelef"),
                                    "rep_pais"=>$this->input->post("txtPaisMadre")
                        
                        );
                        
                        $dataExisteRepres= array(
                                    "rep_nombres"=>$this->input->post("txtNombMadre"),
                                    "rep_apellidos"=>$this->input->post("txtApellidMadre")
                        );
                }
                
                elseif($opcRepresent=="p")
                {
                        $dataRepresentante = array(
                                    "rep_nombres"=>$this->input->post("txtNombPadre"),
                                    "rep_apellidos"=>$this->input->post("txtApellidPadre"),
                                    "rep_ocupacion"=>$this->input->post("txtOcupPadre"),
                                    "rep_telefono"=>$this->input->post("txtTelef"),
                                    "rep_domicilio"=>$this->input->post("txtDomicilio"),
                                    //"rep_celular"=>$this->input->post("txtTelef"),
                                    "rep_pais"=>$this->input->post("txtPaisPadre")
                        
                        );
                        
                        $dataExisteRepres= array(
                                    "rep_nombres"=>$this->input->post("txtNombPadre"),
                                    "rep_apellidos"=>$this->input->post("txtApellidPadre")
                        );
                }
                
                else
                {
                    $dataRepresentante = array(
                                "rep_nombres"=>$this->input->post("txtNombPerson"),
                                "rep_apellidos"=>$this->input->post("txtApellidPerson"),
                                "rep_ocupacion"=>$this->input->post("txtOcupPerson"),
                                "rep_telefono"=>$this->input->post("txtTelefPerson"),
                                "rep_domicilio"=>$this->input->post("txtDomicilioPerson"),
                                "rep_celular"=>$this->input->post("txtCelPerson"),
                                "rep_pais"=>$this->input->post("txtPaisPerson")
                    
                    );
                    
                    $dataExisteRepres= array(
                                "rep_nombres"=>$this->input->post("txtNombPerson"),
                                "rep_apellidos"=>$this->input->post("txtApellidPerson")
                    );
                }
                
                     $this->db->where($dataRepresentante);
                     //$this->db->where($dataExisteRepres);
                     $this->db->from("representante");
                     $numResult=$this->db->count_all_results();
                     
                     if($numResult==0)
                     {
                        $rs=$this->db->insert("representante",$dataRepresentante);
                     }
                     
                     
                     $this->db->select("rep_id");
                     $this->db->where($dataRepresentante);
                     $rs1= $this->db->get("representante");
                        
                     foreach($rs1->result() as $row){
                            $strRepId .="".$row->rep_id."";
                     }
                
                

             //Encontrar alu_curso_paralelo_id
             $jornada=$this->input->post("cmbJornada");
             $curso=$this->input->post("cmbCurso");
             $especializacion=$this->input->post("cmbEspec");
             $paralelo=$this->input->post("cmbParalelo");
             if(($curso==12)||($curso==13))
             {
                $this->db->select("cp_id");
                $this->db->where("cp_jornada_id",$jornada);
                $this->db->where("cp_curso_id",$curso);
                $this->db->where("cp_especializacion_id",$especializacion);
                $this->db->where("cp_paralelo_id",$paralelo);
                $rs2= $this->db->get("curso_paralelo");
             }
             else
             {    
                $this->db->select("cp_id");
                $this->db->where("cp_jornada_id",$jornada);
                $this->db->where("cp_curso_id",$curso);
                $this->db->where("cp_paralelo_id",$paralelo);
                $rs2= $this->db->get("curso_paralelo");
            }
            
            $strCpId="";      
            foreach($rs2->result() as $row){
                $strCpId .="".$row->cp_id."";
            }
            $cpId = (int)$strCpId;
            //Fin de encontrar alu_curso_paralelo_id
             
             $repId = (int)$strRepId;
             
            $txtFecha=$this->input->post("dateArrival");
            $objetoFecha = DateTime::createFromFormat("d/m/Y", $txtFecha );
            $mifecha = $objetoFecha ->format("Y-m-d"); 
            
            $anioLect=date("Y");
            //$anio=explode(" - ",$anioLect);
            
            $this->db->select("anl_id");
            $this->db->where("anl_periodo",$anioLect);
            $rs3= $this->db->get("anio_lectivo"); 
            $strAnLectId="";
             foreach($rs3->result() as $row){
                $strAnLectId .="".$row->anl_id."";
            }
            $AnioId = (int)$strAnLectId;
            
            $check = $this->input->post('chkDocument',TRUE)==null ? 0 : 1;

            $data = array(
                            "alu_nombres"=>$this->input->post("txtNombres"),
                            "alu_apellidos"=>$this->input->post("txtApellidos"),
                            "alu_domicilio"=>$this->input->post("txtDomicilio"),
                            "alu_telefono"=>$this->input->post("txtTelef"),
                            "alu_pais"=>$this->input->post("txtPais"),
                            "alu_lugar_nacimiento"=>$this->input->post("txtLugarNac"),
                            "alu_fecha_nacimiento"=>$mifecha,
                            "alu_sexo"=>$this->input->post("rbSexo"),
                            "alu_edad"=>$this->input->post("txtEdad"),
                            "alu_madre_nombres"=>$this->input->post("txtNombMadre"),
                            "alu_madre_apellidos"=>$this->input->post("txtApellidMadre"),
                            "alu_madre_ocupacion"=>$this->input->post("txtOcupMadre"),
                            "alu_madre_pais"=>$this->input->post("txtPaisMadre"),
                            "alu_padre_nombres"=>$this->input->post("txtNombPadre"),
                            "alu_padre_apellidos"=>$this->input->post("txtApellidPadre"),
                            "alu_padre_ocupacion"=>$this->input->post("txtOcupPadre"),
                            "alu_padre_pais"=>$this->input->post("txtPaisPadre"),
                            "alu_principal_representante"=>$this->input->post("rbRepresent"),
                            "alu_documentacion"=>$check,
                            "alu_comentarios"=>$this->input->post("txtComentarios"),
                            "alu_categoria_alumno_id"=>$this->input->post("cmbCategoria"),
                            "alu_representante_id"=>$repId,
                            "alu_curso_paralelo_id"=>$cpId,
                            "alu_ano_lectivo_id"=>$AnioId
                            
            );
            $this->db->insert("alumno",$data);
        }


        
        function listado_alumnos1(){
            $this->db->select("alu_nombres,alu_apellidos,alu_edad");
            $this->db->from("alumno");
            return $this->db->get();
        
        }

        
        
    }
?>