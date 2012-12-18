<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
        <title>Sedita Usuarios</title>
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
                $("#cmbUsuario").change(function(){
                    var id= $("#cmbUsuario").find(":selected").val();
                    
                    $.ajax({
                        type:"post",
                        url: "<?=site_url("mantenimiento/usuarios")?>",
                        data:"usuario="+id+"&indicador=1",
                        success:function(info){
                            $("#listadoUsuarios").html(info);
                        }
                    });
                });
            });
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
        
        <form class="form-horizontal">
            <fieldset>
                <legend>Usuarios del Sistema</legend>
                <div class="control-group">
                    <label class="control-label"><b>Tipo de Usuario</b></label>
                    <div class="controls">
                        <?php 
                            $js = "id='cmbUsuario'";
                            echo form_dropdown("cmbUsuario",$usuario, null, $js);
                        ?>
                    </div>
                </div>
            </fieldset>
        </form> 
        
        <div id="listadoUsuarios" style="width: 1100px; margin: 0 auto;">
            <form class="span1" style="float: right;" action="<?=site_url("mantenimiento/expListUsuarios")?>" method="post">
                <input class="btn" type="submit" id="exportar" value="Excel" />
                <input type="hidden" id="tipoUsuario" name="tipoUsuario" value="<? echo $u?>" />
                <input type="hidden" id="indicador" name="indicador" value="1" />
            </form>
            
            <form class="span1" style="float: right;" action="<?=site_url("mantenimiento/expListUsuarios")?>" method="post" target="_blank">
                <input class="btn" type="submit" id="exportar" value="PDF" />
                <input type="hidden" id="tipoUsuario" name="tipoUsuario" value="<? echo $u?>" />
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