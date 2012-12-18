<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <title>Sedita Registro Alumno</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="Sedita" content="" />
    	<base href="<?=site_url()?>" />
        
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="shortcut icon" href="assets/ico/favicon.ico"/>
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png" />
        
        <script src="assets/js/jquery-bootstrap.js"></script>
        <script src="assets/js/bootstrap-alert.js"></script>
        <script src="assets/js/bootstrap-modal.js"></script>
        <script src="assets/js/bootstrap-dropdown.js"></script>              
        <script src="js/jquery-1.8.3.min.js"></script>
    
        <script>
            $(document).ready(function(){
                $("#cmbNivel").html("<option>Seleccione un nivel</option>");
                $("#cmbCurso").html("<option>Seleccione un curso</option>");
                $("#cmbEspec").html("<option>Seleccione una especializaci&oacute;n</option>");
                $("#cmbParalelo").html("<option>Seleccione un paralelo</option>")
                $("#cmbCategoria").attr('disabled', 'disabled');
            });
            
            $(document).ready(function(){
                $("#cmbJornada").change(function(){
                $("#cmbNivel").html("<option>Cargando..</option>");
                   var idJornada= $("#cmbJornada").find(":selected").val();
                   var cmbNivel=document.getElementById("cmbNivel");
                   var cmbCurso=document.getElementById("cmbCurso");
                   var cmbEspec=document.getElementById("cmbEspec");
                   var cmbParal=document.getElementById("cmbParalelo");
                   cmbNivel.disabled=false;
                   cmbCurso.disabled=true;
                   cmbEspec.disabled=true;
                   cmbParal.disabled=true;                         
                   $.ajax({
                        type:"post",
                        url: "<?=site_url("alumno/cargar_niveles")?>",
                        data:"jornada="+idJornada,
                        success:function(info){
                            
                            $("#cmbNivel").html(info);
                        }
                   }); 
                });
            });
    
            $(document).ready(function(){
                $("#cmbNivel").change(function(){
                $("#cmbCurso").html("<option>Cargando..</option>");
                   var idJornada= $("#cmbJornada").find(":selected").val();
                   var idNivel= $("#cmbNivel").find(":selected").val();
                   var cmbCurso=document.getElementById("cmbCurso");
                   var cmbEspec=document.getElementById("cmbEspec");
                   var cmbParal=document.getElementById("cmbParalelo");
                  
                   cmbCurso.disabled=false;
                   cmbParal.disabled=true;
                   //nivel básico
                   if(idNivel==1)
                   {
                        cmbEspec.disabled=true;
                        
                   }
                   $.ajax({
                        type:"post",
                        url: "<?=site_url("alumno/cargar_cursos")?>",
                        data:"jornada="+idJornada+"&nivel="+idNivel,
                        success:function(info){
                            $("#cmbCurso").html(info);
                        }
                   });
                });
            });
            
            $(document).ready(function(){
                $("#cmbCurso").change(function(){
                    
                    var idJornada= $("#cmbJornada").find(":selected").val();
                    var idCurso= $("#cmbCurso").find(":selected").val();
                    var cmbParal=document.getElementById("cmbParalelo");
                
              //idCurso==12 o 13, 5to y 6to bachillerato
                   if((idCurso==12)||(idCurso==13))
                   {
                        cmbEspec.disabled=false;
                        cmbParal.disabled=true;
                        $("#cmbEspec").html("<option>Cargando..</option>");
                        $.ajax({
                            type:"post",
                            url: "<?=site_url("alumno/cargar_especializaciones")?>",
                            data:"jornada="+idJornada+"&curso="+idCurso,
                            success:function(info){
                                $("#cmbEspec").html(info);
                            }
                       });
                   }
                   else
                   {
                        cmbEspec.disabled=true;
                        cmbParal.disabled=false;
                        $("#cmbParalelo").html("<option>Cargando..</option>");
                        $.ajax({
                            type:"post",
                            url: "<?=site_url("alumno/cargar_paralelos")?>",
                            data:"jornada="+idJornada+"&curso="+idCurso,
                            success:function(info){
                                //alert ("cargado");
                                $("#cmbParalelo").html(info);
                            }
                       });
                   }
                });
            });
            
            $(document).ready(function(){
                $("#cmbEspec").change(function(){
                    $("#cmbParalelo").html("<option>Cargando..</option>");
                     var idJornada= $("#cmbJornada").find(":selected").val();
                     var idCurso= $("#cmbCurso").find(":selected").val();
                     var cmbParal=document.getElementById("cmbParalelo");
                     var idEspec= $("#cmbEspec").find(":selected").val();
       
                    cmbParal.disabled=false;
            
                   $.ajax({
                        type:"post",
                        url: "<?=site_url("alumno/cargar_paralBachill")?>",
                         data:"jornada="+idJornada+"&curso="+idCurso+"&espec="+idEspec,
                        success:function(info){
                            //alert ("cargado");
                            $("#cmbParalelo").html(info);
                        }
                   });
                });
            });
            
            $(document).ready(function(){
                $("#cmbParalelo").change(function(){
                    //$("#cmbParalelo").html("<option>Cargando..</option>");
                     var idJornada= $("#cmbJornada").find(":selected").val();
                     var idCurso= $("#cmbCurso").find(":selected").val();
                     //var cmbParal=document.getElementById("cmbParalelo");
                     
                     var idParal= $("#cmbParalelo").find(":selected").val();
                     
                       var idEspec= $("#cmbEspec").find(":selected").val();
                     //idCurso==12 o 13, 5to y 6to bachillerato
                   if((idCurso==12)||(idCurso==13))
                   {
                     
                       $.ajax({
                            type:"post",
                            url: "<?=site_url("alumno/num_AlumnosBach")?>",
                             data:"jornada="+idJornada+"&curso="+idCurso+"&espec="+idEspec+"&paral="+idParal,
                            success:function(info){
                                //alert ("cargado");
                                document.getElementById('txtNumAlumn').value =info;
                                
                                if(info>10)
                                {
                                    alert ("Este curso está lleno");
                                }
                                else
                                {
                                    $anio=<?php echo date("Y")?>;
                                    document.getElementById('txtAnoLectivo').value =""+$anio+" - "+($anio+1);
                                    //$("#txtIdAlumno").removeAttr('disabled');
                                    //$("#chkDocument").removeAttr('disabled');
                                    $("#txtNombres").removeAttr('disabled');
                                    $("#txtApellidos").removeAttr('disabled');
                                    $("#cmbCategoria").removeAttr('disabled');
                                    $("#txtDomicilio").removeAttr('disabled');
                                    $("#txtTelef").removeAttr('disabled');
                                    $("#txtPais").removeAttr('disabled');
                                    $("#txtLugarNac").removeAttr('disabled');
                                    $("#dateArrival").removeAttr('disabled');
                                    $("#txtEdad").removeAttr('disabled');
                                    //$("#rbSexo").removeAttr('disabled');
                                    $("#txtNombMadre").removeAttr('disabled');
                                    $("#txtApellidMadre").removeAttr('disabled');
                                    $("#txtOcupMadre").removeAttr('disabled'); 
                                    $("#txtPaisMadre").removeAttr('disabled');
                                    $("#txtNombPadre").removeAttr('disabled');
                                    $("#txtApellidPadre").removeAttr('disabled');
                                    $("#txtOcupPadre").removeAttr('disabled'); 
                                    $("#txtPaisPadre").removeAttr('disabled');
                                    //$("#rbRepresent").removeAttr('disabled'); 
                                    $("#txtNombPerson").removeAttr('disabled');
                                    $("#txtApellidPerson").removeAttr('disabled'); 
                                    $("#txtOcupPerson").removeAttr('disabled');
                                    $("#txtDomicilioPerson").removeAttr('disabled'); 
                                    $("#txtTelefPerson").removeAttr('disabled');
                                    $("#txtCelPerson").removeAttr('disabled');
                                    $("#txtPaisPerson").removeAttr('disabled');
                                    $("#txtComentarios").removeAttr('disabled');
                                    
                                }
                                
                                
                            }
                       });
                       
                       $.ajax({
                            type:"post",
                            url: "<?=site_url("alumno/listado_alumnos")?>",
                            data:"jornada="+idJornada+"&curso="+idCurso+"&espec="+idEspec+"&paral="+idParal+"&indBachill=1",
                            success:function(info){
                                $("#listadoAlumnos").html(info);
                            }
                      });  
                    }
                    else
                    {   
                         $.ajax({
                            type:"post",
                            url: "<?=site_url("alumno/num_Alumnos")?>",
                             data:"jornada="+idJornada+"&curso="+idCurso+"&paral="+idParal,
                            success:function(info){
                                //alert ("cargado");
                                document.getElementById('txtNumAlumn').value =info;
                                if(info>10)
                                {
                                    alert ("Este curso está lleno");
                                }
                                else
                                {
                                    $anio=<?php echo date("Y")?>;
                                    document.getElementById('txtAnoLectivo').value =""+$anio+" - "+($anio+1);
                                    //$("#txtIdAlumno").removeAttr('disabled');
                                    //$("#chkDocument").removeAttr('disabled');
                                    $("#txtNombres").removeAttr('disabled');
                                    $("#txtApellidos").removeAttr('disabled');
                                    $("#cmbCategoria").removeAttr('disabled');
                                    $("#txtDomicilio").removeAttr('disabled');
                                    $("#txtTelef").removeAttr('disabled');
                                    $("#txtPais").removeAttr('disabled');
                                    $("#txtLugarNac").removeAttr('disabled');
                                    $("#dateArrival").removeAttr('disabled');
                                    $("#txtEdad").removeAttr('disabled');
                                    //$("#rbSexo").removeAttr('disabled');
                                    $("#txtNombMadre").removeAttr('disabled');
                                    $("#txtApellidMadre").removeAttr('disabled');
                                    $("#txtOcupMadre").removeAttr('disabled'); 
                                    $("#txtPaisMadre").removeAttr('disabled');
                                    $("#txtNombPadre").removeAttr('disabled');
                                    $("#txtApellidPadre").removeAttr('disabled');
                                    $("#txtOcupPadre").removeAttr('disabled'); 
                                    $("#txtPaisPadre").removeAttr('disabled');
                                    //$("#rbRepresent").removeAttr('disabled'); 
                                    $("#txtNombPerson").removeAttr('disabled');
                                    $("#txtApellidPerson").removeAttr('disabled'); 
                                    $("#txtOcupPerson").removeAttr('disabled');
                                    $("#txtDomicilioPerson").removeAttr('disabled'); 
                                    $("#txtTelefPerson").removeAttr('disabled');
                                    $("#txtCelPerson").removeAttr('disabled');
                                    $("#txtPaisPerson").removeAttr('disabled');
                                    $("#txtComentarios").removeAttr('disabled');
                                   
                                }
                            }
                        });
                        
                      $.ajax({
                        type:"post",
                        url: "<?=site_url("alumno/listado_alumnos")?>",
                         data:"jornada="+idJornada+"&curso="+idCurso+"&paral="+idParal+"&indBachill=0",
                         success:function(info){
                            $("#listadoAlumnos").html(info);
                        }
                      });  
                    }
                });
            });
        </script>
    
    
        <!-- Autocompletar --!>
        <link type="text/css" href="<?php echo base_url(); ?>css/dark-hive/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
    	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-1.8.10.custom.min.js"></script>
    	
        <script type="text/javascript">
    		$(document).ready(function(){
    			$('#txtNombres').autocomplete({
    				source:'<?php echo site_url('autocomplete/nombApellidAlumnos'); ?>',
    				select: function(event, ui) {
    					alert(ui.item ? "Selected: " + ui.item.alu_id : "Nothing selected, input was " + this.value );
                          //document.getElementById('txtNombres').value = '1';
                          
                        
                         $.ajax({
                            type:"post",
                            url: "<?=site_url("alumno/autocompletar_alumno")?>",
                            data:"id_alumno="+ui.item.alu_id,
                            success:function(info){
                                array=info.split("_");
                                
                                //$("#txtNombres").empty();
                            //$("#txtApellidos").html(info);
                            //document.getElementById('txtEdad').value = info1;
                            document.getElementById('chkDocument').value = array[0];
                            if(document.getElementById('chkDocument').value == 0)
                            {
                                document.getElementById("chkDocument").checked=false;
                            }
                            else
                            {
                                document.getElementById("chkDocument").checked=true;
                            }
                            
                            document.getElementById('txtNombres').value = array[1];
                            document.getElementById('txtApellidos').value = array[2];
                            document.getElementById('cmbCategoria').value = array[3];
                            document.getElementById('txtDomicilio').value = array[4];
                            document.getElementById('txtTelef').value = array[5];
                            document.getElementById('txtPais').value = array[6];
                            document.getElementById('txtLugarNac').value = array[7];
                            document.getElementById('dateArrival').value = array[8];
                            document.getElementById('txtEdad').value = array[9];
                            //document.getElementById('rbSexo').value = array[10];
                            if(array[10]== "M")
                            {
                                document.getElementById("rbSexoM").checked=true;
                                document.getElementById("rbSexoF").checked=false;
                            }
                            else
                            {
                                document.getElementById("rbSexoM").checked=false;
                                document.getElementById("rbSexoF").checked=true;
                            }
                            document.getElementById('txtNombMadre').value = array[11];
                            document.getElementById('txtApellidMadre').value = array[12];
                            document.getElementById('txtOcupMadre').value = array[13];
                            document.getElementById('txtPaisMadre').value = array[14];
                            document.getElementById('txtNombPadre').value = array[15];
                            document.getElementById('txtApellidPadre').value = array[16];
                            document.getElementById('txtOcupPadre').value = array[17];
                            document.getElementById('txtPaisPadre').value = array[18];
                            //document.getElementById('rbRepresent').value = array[19];
                         
                            if(array[19]== "m")
                            {
                                document.getElementById("rbRepresentM").checked=true;
                                document.getElementById("rbRepresentP").checked=false;
                                document.getElementById("rbRepresentO").checked=false;
                            }
                            else if(array[19]== "p")
                            {
                               document.getElementById("rbRepresentM").checked=false;
                                document.getElementById("rbRepresentP").checked=true;
                                document.getElementById("rbRepresentO").checked=false;
                            }
                            
                            else{
                                document.getElementById("rbRepresentM").checked=false;
                                document.getElementById("rbRepresentP").checked=false;
                                document.getElementById("rbRepresentO").checked=true;
                                
                                
                                document.getElementById('txtNombPerson').value = array[23];
                                document.getElementById('txtApellidPerson').value = array[24];
                                document.getElementById('txtOcupPerson').value = array[25];
                                document.getElementById('txtTelefPerson').value = array[26];
                                document.getElementById('txtDomicilioPerson').value = array[27];
                                document.getElementById('txtCelPerson').value = array[28];
                                document.getElementById('txtPaisPerson').value = array[29];
                                
                            }
                            
                            document.getElementById('txtComentarios').value = array[20];
                            
                        }
                   });
                   
    				}
    			});
    		});
    	</script>   
         <!-- Fin de Autocompletar --!>
    
        <script src="js/popcalendar.js"></script> 
        
        <script>
            function toggle_otra_persona(elemento) {
                if((elemento.value=="m") || (elemento.value=="p")) {
                    document.getElementById("div_otra_persona").style.display = "none";
                } 
                else {
                    document.getElementById("div_otra_persona").style.display = "block";
                }
            }
        </script>
        
        <style type="text/css">
            body {
                width: 1320px;
                padding-top: 60px;
                padding-bottom: 40px;
                margin: 0 auto;
                font-family: Arial;
            	font-size: 14px;        
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
    </head>

    <body data-spy="scroll" data-target=".bs-docs-sidebar">
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="navbar-inner">
            <div class="container-fluid">
              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>
              <a class="brand" href="#">Sistema Sedita</a>
              <div class="nav-collapse collapse">
                <p class="navbar-text pull-right">
                    <a href="#" class="navbar-link">Cerrar Sesion</a>
                </p>
                <ul class="nav nav-pills">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">
                            Ingresos
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<?=site_url("alumno")?>">Matriculaci&oacute;n</a><li>
                            <li><a tabindex="-1" href="#">Personal</a><li>
                            <li class="dropdown-submenu">
                                <a tabindex="-1" href="#">Listados</a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="#">N&oacute;mina de Alumnos</a><li>
                                    <li><a tabindex="-1" href="#">Cursos</a><li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="">
                            Calificaciones
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Cuadro de Honor</a></li>
                            <li><a tabindex="-1" href="#">Actas de Calificaciones</a></li>
                            <li><a tabindex="-1" href="#">Libretas</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="<?=site_url("mantenimiento/usuarios") ?>">
                            Mantenimiento
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<?=site_url("mantenimiento/usuarios") ?>">Usuarios</a></li>
                            <li><a tabindex="-1" href="<?=site_url("mantenimiento/cursos") ?>">Cursos</a></li>
                            <li><a tabindex="-1" href="#">Materias</a></li>
                        </ul>
                    </li>
                    <li><a href="#contact">Ayuda</a></li>
                </ul>
              </div><!--/.nav-collapse -->
            </div>
          </div>
        </div>

        
        <form class="form-horizontal" action="<?=site_url("alumno/guardar") ?>" method="post">
            <fieldset>
                <legend>Matricular Alumno</legend>
                <div class="control-group span1" style="float: left;">
                    <label class="control-label"><b>Jornada</b></label>
                    <div class="controls">
                        <?php 
                            $js = "id='cmbJornada'";
                            echo form_dropdown("cmbJornada",$jornada, null, $js);
                        ?>
                    </div>
                    
                    <label class="control-label" style="margin-top: 20px;"><b>Nivel</b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <select id="cmbNivel" name="cmbNivel" disabled="disabled" ></select>
                    </div>
                    
                    <label class="control-label" style="margin-top: 20px;"><b>Curso </b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <select id="cmbCurso" name="cmbCurso" disabled="disabled" ></select>
                    </div>
                    
                    <label class="control-label" style="margin-top: 20px;"><b>Especializaci&oacute;n </b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <select id="cmbEspec" name="cmbEspec" disabled="disabled" ></select>
                    </div>
                    
                    <label class="control-label" style="margin-top: 20px;"><b>Paralelo </b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <select id="cmbParalelo" name="cmbParalelo" disabled="disabled" ></select>
                    </div>
                </div>
                
                <div class="control-group span11" style="float:right; margin: 20px 0 0 0;">
                    <div class="span3">
                        <label class="control-label" style="margin-top: 20px;"><b>No. de Matriculados</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input style="width: 50px;" type="text" name="txtNumAlumn" id="txtNumAlumn" disabled="disabled"/>
                        </div>
                    </div>
                    
                    <div class="span4">
                        <label class="control-label" style="margin-top: 20px;"><b>A&ntilde;o Lectivo</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input style="width: 150px;" type="text" name="txtAnoLectivo" id="txtAnoLectivo" disabled="disabled"/>
                        </div>
                    </div>
                    
                    <div class="span5">
                        <label class="control-label" style="margin-top: 20px;"><b>Con documentaci&oacute;n</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input type="checkbox" name="chkDocument" id="chkDocument" value="1"  />
                        </div>
                    </div>
                    
                    <div class="span5" >
                        <label class="control-label" style="margin-top: 20px;"><b>Categor&iacute;a</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <?php 
                                $js = "id='cmbCategoria'";
                                echo form_dropdown("cmbCategoria",$categoria_alumno, null, $js);
                            ?>
                        </div>
                    </div>
                    
                    <div class="span10">
                        <label class="control-label" style="margin-top: 20px;"><b>Nombres</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input style="width:500px;" type="text" name="txtNombres" id="txtNombres" disabled="disabled" />
                        </div>
                    </div>
                    
                    <div class="span10">
                        <label class="control-label" style="margin-top: 20px;"><b>Apellidos</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input style="width:500px;" type="text" name="txtApellidos" id="txtApellidos" disabled="disabled" />
                        </div>
                    </div>
                    
                    <div class="span10">
                        <label class="control-label" style="margin-top: 20px;"><b>Direcci&oacute;n</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input style="width: 500px;" type="text" name="txtDomicilio" id="txtDomicilio" disabled="disabled" />
                        </div>
                    </div>
                    
                    <div class="span4">
                        <label class="control-label" style="margin-top: 20px;"><b>Tel&eacute;fono</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input type="text" name="txtTelef" id="txtTelef" disabled="disabled"  />
                        </div>
                    </div>
                    
                    <div class="span4">
                        <label class="control-label" style="margin-top: 20px;"><b>Pa&iacute;s</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input style="width: 180px;" type="text" name="txtPais" id="txtPais" disabled="disabled"  />
                        </div>
                    </div>
                    
                    <div class="span4">
                        <label class="control-label" style="margin-top: 20px;"><b>Lugar de nacimiento</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input type="text" name="txtLugarNac" id="txtLugarNac" disabled="disabled"  />
                        </div>
                    </div>
                    
                    <div class="span4">
                        <label class="control-label" style="margin-top: 20px;"><b>Edad</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input style="width:50px" type="text" name="txtEdad" id="txtEdad"  disabled="disabled" />
                        </div>
                    </div>
                    
                    <div class="span4">
                        <label class="control-label" style="margin-top: 20px;"><b>Fecha de Nacimiento</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input name="dateArrival" type="text" id="dateArrival" disabled="disabled" onclick="popUpCalendar(this, form.dateArrival, 'dd/mm/yyyy');" size="10"/>
                        </div>
                    </div>
                    
                    <div class="span5">
                        <label class="control-label" style="margin-top: 20px;"><b>Sexo</b></label>
                        <div class="controls" style="margin-top: 20px;">
                            <input type="radio" name="rbSexo" value="M" id="rbSexoM" checked="checked" />Masculino
                            <input style="margin-left: 30px;" type="radio" name="rbSexo" value="F"  id="rbSexoF" />Femenino
                        </div>
                    </div>
                    
                    <div class="span6">
                        <fieldset>
                            <legend>Madre</legend>
                        
                            <label class="control-label" style="margin-top: 20px;"><b>Nombres</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtNombMadre" id="txtNombMadre" disabled="disabled" checked="checked" />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Apellidos</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtApellidMadre" id="txtApellidMadre" disabled="disabled"/>
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Ocupaci&oacute;n</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtOcupMadre" id="txtOcupMadre" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Pa&iacute;s</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtPaisMadre" id="txtPaisMadre" disabled="disabled"  />
                            </div>
                        </fieldset>
                    </div>
                        
                    <div class="span6">
                        <fieldset>
                            <legend>Padre</legend>
                        
                            <label class="control-label" style="margin-top: 20px;"><b>Nombres</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtNombPadre" id="txtNombPadre" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Apellidos</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtApellidPadre" id="txtApellidPadre" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Ocupaci&oacute;n</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtOcupPadre" id="txtOcupPadre" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Pa&iacute;s</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtPaisPadre" id="txtPaisPadre" disabled="disabled"  />
                            </div>
                        </fieldset>
                    </div>
                    
                    <label class="control-label" style="margin-top: 35px;"><b>Representante</b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <input type="radio" name="rbRepresent" value="m" onclick="toggle_otra_persona(this)" id="rbRepresentM"  />Madre<br />
                        <input type="radio" name="rbRepresent" value="p" onclick="toggle_otra_persona(this)" id="rbRepresentP"  />Padre<br />
                        <input type="radio" name="rbRepresent" value="o" onclick="toggle_otra_persona(this)" id="rbRepresentO"  />Otra persona<br />
                    </div>
                    
                    <div id="div_otra_persona" style="display:none; background-color: aqua;">
                        <fieldset>
                            <legend>Representante</legend>
                        
                            <label class="control-label" style="margin-top: 20px;"><b>Nombres</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtNombPerson" id="txtNombPerson" disabled="disabled" />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Apellidos</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtApellidPerson" id="txtApellidPerson" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Ocupaci&oacute;n</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtOcupPerson" id="txtOcupPerson" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Direcci&oacute;n</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtDomicilioPerson" id="txtDomicilioPerson" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Tel&eacute;fono</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtTelefPerson" id="txtTelefPerson"  disabled="disabled" />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Celular</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtCelPerson" id="txtCelPerson" disabled="disabled"  />
                            </div>
                            
                            <label class="control-label" style="margin-top: 20px;"><b>Pa&iacute;s</b></label>
                            <div class="controls" style="margin-top: 20px;">
                                <input type="text" name="txtPaisPerson" id="txtPaisPerson" disabled="disabled" />
                            </div>
                        </fieldset>
                    </div>
                    
                    <label class="control-label" style="margin-top: 20px;"><b>Comentarios</b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <input type="text" name="txtComentarios" id="txtComentarios" disabled="disabled"  />
                    </div>
                    
                    <input class="btn" type="submit" name="btnEnviar" value="Enviar"/>
                </div>      
            </fieldset> 
        </form>
        
        <div id="listadoAlumnos"></div>
        
        <hr>

        <footer>
            <h6>Realizado por Sedita &nbsp;&nbsp; - &nbsp;&nbsp; &copy; Company 2012</h6>
        </footer> 
    
    </body>
</html>