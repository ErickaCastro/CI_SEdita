<?php
    if (!defined('BASEPATH'))
        exit('No tiene Permiso para acceder directamente al Script');
    
    class export_excel
    {
        function setHeader($excel_file_name)  
        {   
            header("Content-type: application/vnd.ms-excel");  
            header("Content-Disposition: attachment; filename=$excel_file_name");  
            header("Pragma: no-cache");  
            header("Expires: 0");    
        }    
        
        function exportToExcel($resultado,$excel_file_name,$num_columnas,$nom_columnas, $nom_tabla)  
        {  
            $header="<center><table border=1px><tr>";  
                for($i=0;$i<$num_columnas;$i++){     
                    $header.="<th>".$nom_columnas[$i]."</th>";
                }
            $header.="</tr>";
            
            $body="";  
            
            foreach ($resultado->result() as $fila){
                $body.="<center><tr>";
                for($i=0;$i<$num_columnas;$i++){     
                    $body.="<td>".$fila->$nom_tabla[$i]."</td>";
                }
                $body.="</tr>";
            }
            
            $this->setHeader($excel_file_name);  
            
            echo $header.$body."</table>";  
        }
    }

?>
