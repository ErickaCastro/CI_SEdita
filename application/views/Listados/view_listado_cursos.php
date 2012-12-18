<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <title>Sedita Cursos</title>
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
        <script src="js/jquery-ui.js"></script>
        
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
        
        <script>
            $(document).ready(function(){
                $("#cmbNivel").change(function(){
                    var id= $("#cmbNivel").find(":selected").val();
                    
                    if( id == 1){
                        var curso = -1;
                    }else{
                        if(id == 2){
                            var curso = -2;
                            var especializacion = $("#cmbEspecializacion").find(":selected").val();
                        }
                    }
        
                    var jornada = $("#cmbJornada").find(":selected").val();
                    
                    $.ajax({
                        type:"post",
                        url: "<?=site_url("alumno/cargar_curso")?>",
                        data:"nivel="+id,
                        success:function(info){
                            $("#cmbCurso").html(info);
                            $("#cmbEspecializacion").empty();
                            $("#cmbEspecializacion").attr('disabled', 'disabled');
                            
                        }
                    });
                    
                    $.ajax({
                        type:"post",
                        url: "<?=site_url("mantenimiento/cursos")?>",
                        data:"curso="+curso+"&jornada="+jornada+"&especializacion="+especializacion+"&indicador=1",
                        success:function(info){
                            $("#listadoCursos").html(info);
                        }
                    });
                });
            });
            
            $(document).ready(function(){
                $("#cmbCurso").change(function(){
                   var curso = $("#cmbCurso").find(":selected").val();
                   var jornada = $("#cmbJornada").find(":selected").val();
                   var especializacion = $("#cmbEspecializacion").find(":selected").val();
                    
                    if(curso > 11 && curso < 14){
                        $.ajax({
                            type:"post",
                            url: "<?=site_url("alumno/cargar_especializacion")?>",
                            data:"curso="+curso+"&jornada="+jornada,
                            success:function(info){
                                $("#cmbEspecializacion").removeAttr('disabled');
                                $("#cmbEspecializacion").html(info);
                            }
                       });   
                    }
                    else{
                        $("#cmbEspecializacion").empty();
                        $("#cmbEspecializacion").attr('disabled', 'disabled');
                    }
                    
                    $.ajax({
                        type:"post",
                        url: "<?=site_url("mantenimiento/cursos")?>",
                        data:"curso="+curso+"&jornada="+jornada+"&especializacion="+especializacion+"&indicador=1",
                        success:function(info){
                            $("#listadoCursos").html(info);
                        }
                    });
                });
            });
            
                        
            $(document).ready(function(){
                $("#cmbEspecializacion").change(function(){
                   var curso = $("#cmbCurso").find(":selected").val();
                   var jornada = $("#cmbJornada").find(":selected").val();
                   var especializacion = $("#cmbEspecializacion").find(":selected").val();
                    
                    $.ajax({
                        type:"post",
                        url: "<?=site_url("mantenimiento/cursos")?>",
                        data:"curso="+curso+"&jornada="+jornada+"&especializacion="+especializacion+"&indicador=1",
                        success:function(info){
                            $("#listadoCursos").html(info);
                        }
                    });
                });
            });                        
            
                                    
            $(document).ready(function(){
                $("#cmbJornada").change(function(){
                    var jornada = $("#cmbJornada").find(":selected").val();
                    
                    if(jornada == 2){
                        var curso = -3;
                        var especializacion = -3;
                    
                        $.ajax({
                            type:"post",
                            url: "<?=site_url("mantenimiento/cursos")?>",
                            data:"curso="+curso+"&jornada="+jornada+"&especializacion="+especializacion+"&indicador=1",
                            success:function(info){
                                $("#listadoCursos").html(info);
                                $("#cmbNivel").attr('disabled', 'disabled');
                                $("#cmbCurso").attr('disabled', 'disabled');
                                $("#cmbEspecializacion").attr('disabled', 'disabled');
                            }
                        });
                    }
                    else{
                        var curso = $("#cmbCurso").find(":selected").val();
                        var especializacion = $("#cmbEspecializacion").find(":selected").val();
                        
                        $("#cmbNivel").removeAttr('disabled');
                        $("#cmbCurso").removeAttr('disabled');
                        
                        if(curso > 11 && curso < 14){
                            $("#cmbEspecializacion").removeAttr('disabled');
                        }
                        else{
                            $("#cmbEspecializacion").empty();
                            $("#cmbEspecializacion").attr('disabled', 'disabled');
                        }
                        
                        $.ajax({
                            type:"post",
                            url: "<?=site_url("mantenimiento/cursos")?>",
                            data:"curso="+curso+"&jornada="+jornada+"&especializacion="+especializacion+"&indicador=1",
                            success:function(info){
                                $("#listadoCursos").html(info);
                            }
                        });
                    } 
                });
            });
            

            $(document).ready(function() {
                $( "#paralelo" ).dialog({
                    autoOpen: false,
                    height: 150,
                    width: 300,
                    modal: true,
                    buttons: {
                        Guardar: function(){
                            var paralelo = $('input[name=paralelo]').val();
                            
                            if(paralelo == "" || paralelo == null){
                                $( this ).dialog( "close" );
                            }
                            else{
                                $.ajax({
                                    type:"post",
                                    url: "<?=site_url("mantenimiento/paralelo")?>",
                                    data:"paralelo="+paralelo,
                                    success:function(info){
                                    }
                                });
                                
                                $( this ).dialog( "close" );
                            }
                        },
                        Salir: function() {
                            $( this ).dialog( "close" );
                        }
                    },
                    close: function() {
                    }
                });
                
                $( "#add-paralelo" ).button().click(function() {
                    $.ajax({
                        type: 'post',
                        dataType: 'html',
                        url:"<?=site_url("mantenimiento/agregar_paralelo")?>",
                        success: function(data){
                            $("#paralelo").empty();
                            $("#paralelo").append(data);
                            $("#paralelo").dialog( "open" );
                        }                        
                     })            
                });
            });
        </script>
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
        
        <input style="float: right;" type="button" id="add-paralelo" value="Agregar Paralelo"/>
        <div id="paralelo" title="Agregar Paralelo"></div>
        
        <form class="form-horizontal">
            <fieldset>
                <legend>Cursos Disponibles</legend>
                <div class="control-group" style="float: left;">
                    <label class="control-label"><b>Nivel</b></label>
                    <div class="controls">
                        <?php 
                            $js = "id='cmbNivel'";
                            echo form_dropdown("cmbNivel",$nivel, null, $js);
                        ?>
                    </div>
                    
                    <label class="control-label" style="margin-top: 20px;"><b>Curso </b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <select id="cmbCurso" name="cmbCurso">
                            <?php echo $curso ?>
                        </select>
                    </div>
                </div>
                
                <div class="control-group" style="float: right; margin: 20px 300px 0 0;">
                    <label class="control-label"><b>Jornada</b></label>
                    <div class="controls">
                        <?php 
                            $js = "id='cmbJornada'";
                            echo form_dropdown("cmbJornada",$jornada, null, $js);
                        ?>
                    </div>
                    
                    <label class="control-label" style="margin-top: 20px;"><b>Especializaci&oacute;n</b></label>
                    <div class="controls" style="margin-top: 20px;">
                        <select disabled="disabled" id="cmbEspecializacion" name="cmbEspecializacion"></select>
                    </div>
                </div>
            </fieldset>
        </form>
        
        <div id="listadoCursos" style="width: 1100px; margin: 0 auto;">
           <form class="span1" style="float: right;" action="<?=site_url("mantenimiento/expListCursos")?>" method="post">
                <input class="btn" type="submit" id="exportar" value="Excel" />
                <input type="hidden" id="jornada" name="jornada" value="<? echo $j?>" />
                <input type="hidden" id="curso" name="curso" value="<? echo $c?>" />
                <input type="hidden" id="especializacion" name="especializacion" value="<? echo $e?>" />
                <input type="hidden" id="indicador" name="indicador" value="1" />
            </form>
            
            <form class="span1" style="float: right;" action="<?=site_url("mantenimiento/expListCursos")?>" method="post" target="_blank">
                <input class="btn" type="submit" id="exportar" value="PDF" />
                <input type="hidden" id="jornada" name="jornada" value="<? echo $j?>" />
                <input type="hidden" id="curso" name="curso" value="<? echo $c?>" />
                <input type="hidden" id="especializacion" name="especializacion" value="<? echo $e?>" />
                <input type="hidden" id="indicador" name="indicador" value="0" />
            </form>
            
            <?php foreach($css_files as $file): ?>
            	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <base href="<?=site_url()?>" />
            <?php endforeach; ?>

            <?php foreach($js_files as $file): ?>
            	<script src="<?php echo $file; ?>"></script>
            <?php endforeach; ?>
            
            <div style="padding-top: 40px;">
                <?php echo $output ?>
            </div>
            
            <script>
                $(document).ready(function(){
                   $("div#groceryCrudTable_filter").remove();
                });
            </script>
        </div>
        
        <hr>

        <footer>
            <h6>Realizado por Sedita &nbsp;&nbsp; - &nbsp;&nbsp; &copy; Company 2012</h6>
        </footer>
    </body>
    
</html>