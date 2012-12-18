<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Lizbeth Cruz" />

	<title>Listado de Usuarios</title>
    <base href="<?=site_url()?>"/>
    <style type="text/css">
        @import "js/media/css/demo_table.css";
    </style>
    <script type="text/javascript" src="js/media/js/jquery.js">
    </script>
    
    <script type="text/javascript" src="js/media/js/jquery.dataTables.js">
    </script>
    
    <script>
        $(document).ready(function(){
            $("#ejemplolista").dataTable();
        });
    </script>
            
</head>

<body>

<?=$tabla?>

</body>
</html>