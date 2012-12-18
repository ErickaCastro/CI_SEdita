<?php
    if (!defined('BASEPATH'))
        exit('No tiene Permiso para acceder directamente al Script');
    
    class export_pdf
    {
        function exportToPDF_Cursos($resultado, $año_lectivo){
            $CI = & get_instance();
            
            $CI->load->library("cezpdf");
            $CI->load->helper('pdf');
            
            header_pdf();
            footer_pdf();
            $CI->cezpdf->selectFont('fonts/Helvetica.afm');
            $CI->cezpdf->ezSetMargins(105,80,50,50);
            $CI->cezpdf->ezText("LISTADO  DE  CURSOS",10, array('justification'=>'center'));
            $CI->cezpdf->ezText("\n\n\n",10);
            $CI->cezpdf->setStrokeColor(0,0,0);            
            $CI->cezpdf->rectangle(405,680,67,20);
            $CI->cezpdf->setStrokeColor(0,0,0);
            $CI->cezpdf->rectangle(472,680,61,20);
            $CI->cezpdf->addText(408,685,10,"<b>Año Lectivo:</b>   ".$año_lectivo);
            
            $columnas = array("num"=>"<b>No.</b>",
                                "c"=>"<b>Curso</b>",
                                "e"=>"<b>Especialización</b>",
                                "p"=>"<b>Paralelo</b>",
                                "j"=>"<b>Jornada</b>");
                                
            $data = array();
            $i=0;
            foreach($resultado->result() as $fila){
                $data[] = array("num"=>$i,
                                "c"=>$fila->cur_nombre,
                                "e"=>$fila->esp_nombre,
                                "p"=>$fila->par_nombre,
                                "j"=>$fila->jor_nombre);
                $i++;
            }                    
                            
            $CI->cezpdf->ezTable($data, $columnas, '', array('width'=>480,
                                                             'shaded'=>0,
                                                             'showLines'=>2,
                                                             'cols'=>array('num'=>array('width'=>30),
                                                                           'c'=>array('justification'=>'center'),
                                                                           'e'=>array('justification'=>'center'),
                                                                           'p'=>array('justification'=>'center'),
                                                                           'j'=>array('justification'=>'center'))
                                                            )
                                );
            
            $CI->cezpdf->ezStream();
        }
        
        function exportToPDF_Usuarios($resultado, $año_lectivo){
            $CI = & get_instance();
            
            $CI->load->library("cezpdf");
            $CI->load->helper('pdf');
            
            header_pdf();
            footer_pdf();
            $CI->cezpdf->selectFont('fonts/Helvetica.afm');
            $CI->cezpdf->ezSetMargins(105,80,50,50);
            $CI->cezpdf->ezText("LISTADO  DE  USUARIOS",10, array('justification'=>'center'));
            $CI->cezpdf->ezText("\n\n\n",10);
            $CI->cezpdf->setStrokeColor(0,0,0);            
            $CI->cezpdf->rectangle(405,680,67,20);
            $CI->cezpdf->setStrokeColor(0,0,0);
            $CI->cezpdf->rectangle(472,680,61,20);
            $CI->cezpdf->addText(408,685,10,"<b>Año Lectivo:</b>   ".$año_lectivo);
            
            $columnas = array("num"=>"<b>No.</b>",
                                "u"=>"<b>Usuario</b>",
                                "c"=>"<b>Contraseña</b>",
                                "tp"=>"<b>Tipo de Usuario</b>");
                                
            $data = array();
            $i=0;
            foreach($resultado->result() as $fila){
                $data[] = array("num"=>$i,
                                "u"=>$fila->usu_nombre,
                                "c"=>$fila->usu_clave,
                                "tp"=>$fila->tip_nombre);
                $i++;
            }                    
                            
            $CI->cezpdf->ezTable($data, $columnas, '', array('width'=>480,
                                                             'shaded'=>0,
                                                             'showLines'=>2,
                                                             'cols'=>array('num'=>array('width'=>30),
                                                                           'u'=>array('justification'=>'center'),
                                                                           'c'=>array('justification'=>'center'),
                                                                           'tp'=>array('justification'=>'center'))
                                                            )
                                );
            
            $CI->cezpdf->ezStream();
        }
    }
?>