<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Sedita Administrador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="Sedita" content="" />
	<base href="<?=site_url()?>" />
    
    <!-- Le styles -->
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
    
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
            <div class="hero-unit">
                <div class="cuadro_titulo2">
                    <h1>Unidad Educativa<br />"La Luz de Dios"!</h1>
                </div>
                <dl class="dl-horizontal" style="float: left;">
                    <dt>Usuario:</dt>
                    <dd><?php echo $usuario ?></dd>
                    <dt>Fecha:</dt>
                    <dd><?php echo $fecha ?></dd>
                </dl>
            </div>
        </div><!--/span-->
        <div class="span6">
            <img style="margin-left: 100px;" width="250px" alt="Imagen Login" src="assets/img/logo-escuela.png" />
        </div>
        <div class="span4">
            <p style="margin-top: 20px;"><a class="btn btn-large btn-block btn-primary" type="button" href="<?=site_url("alumno")?>" >Matriculaci&oacute;n de Estudiantes</a></p>
            <p style="margin-top: 20px;">
                <button class="span6 btn btn-large btn-primary" type="button">Listados</button>
                <button class="span6 btn btn-large btn-primary" type="button">Actualizaci&oacute;n de Datos</button>
            </p>
            <p style="margin-top: 80px;">
                <button class="span6 btn btn-large btn-primary" type="button">Actas de Caificaciones</button>
                <button class="span6 btn btn-large btn-primary" type="button">Libretas</button>
            </p>
            <p style="margin-top: 180px;">
                <button class="span12 btn btn-large btn-primary" type="button">Control de Activos</button>
            </p>
        </div>
        <div class="span2"></div>
      </div><!--/row-->

      <hr>

      <footer>
        <h6>Realizado por Sedita &nbsp;&nbsp; - &nbsp;&nbsp; &copy; Company 2012</h6>
      </footer>

    </div><!--/.fluid-container-->
    
  </body>
</html>