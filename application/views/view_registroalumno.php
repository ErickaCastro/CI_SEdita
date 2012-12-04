<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="Lizbeth Cruz" />

	<title>Untitled</title>
    
    
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css" />
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    </script>
    
    <script>
        $(document).ready(function(){
            $("#cmbNivel").change(function(){
               var id= $("#cmbNivel").find(":selected").val();
               //alert(id);
               //$("#cmbCurso").load("<?=site_url()?>/nuevo_alumno/cargar_curso/"+id);
               
               $.ajax({
                    type:"post",
                    url: "<?=site_url("nuevo_alumno/cargar_curso")?>",
                    data:"nivel="+id,
                    success:function(info){
                        //alert ("cargado");
                        $("#cmbCurso").html(info);
                    }
               });
            });
        });
    </script>

</head>

<body>
    <form action="<?=site_url("nuevo_alumno/guardar") ?>" method="post" target="_self">
        <b>N° Ingreso:</b>
            <input type="text" name="txtIngreso"/> <br />
        
        <input type="checkbox" name="document"/>Con documentación <br />
        
        <b>Nombres </b>
            <input type="text" name="txtNombres"/> <br /><br />
        
        <b>Apellidos </b>
            <input type="text" name="txtApellidos"/> <br /><br />
        
        <b>Categoría </b>
                <?php 
                $js = "id='cmbCategoria'";
                echo form_dropdown("cmbCategoria",$categoria_alumno, null, $js);
            ?> 
        <br /><br />
        
        <b>Dirección </b>
            <input type="text" name="txtDomicilio"/> <br /><br />
         
        <b>Teléfono</b>
            <input type="text" name="txtTelef"/> <br /><br />
        
        <b>País </b>
            <input type="text" name="txtPais"/> <br /><br />
            
        <b>Lugar de nacimiento </b>
            <input type="text" name="txtLugarNac"/> <br /><br />
             
        <b>Fecha de nacimiento</b>
            <input type="text" id="datepicker" /><br />
        <b>Edad</b>
            <input type="text" name="txtEdad"/> <br /><br />
        
        <b>Sexo</b>
            <input type="radio" name="sexo" value="masculino"/>Masculino
            <input type="radio" name="sexo" value="femenino"/>Femenino<br />  
        <br />
        
        
        <b>Jornada </b>
            <?php 
                $js = "id='cmbJornada'";
                echo form_dropdown("cmbJornada",$jornada, null, $js);
            ?> 
        <br /><br />
        
        <b>Nivel </b>
            <?php 
                $js = "id='cmbNivel'";
                echo form_dropdown("cmbNivel",$nivel, null, $js);
            ?> <br /> 
        <br /><br />
        
        <b>Curso </b>
            <select id="cmbCurso" name="cmbCurso"></select> <br /> 
        <br /><br />
        
        <b>Paralelo </b>
            <select id="cmbParalelo" name="cmbParalelo"></select> <br /> 
        <br /><br />
        
        <b>Especialización </b>
            <select id="cmbEspec" name="cmbEspec"></select> <br /> 
        <br /><br />
        
        
        <b>Padre</b><br />    
        <b>Nombres</b>
            <input type="text" name="txtNombPadre"/> <br /><br />
        
        <b>Apellidos</b>
            <input type="text" name="txtApellidPadre"/> <br /><br />
            
        <b>Ocupación</b>
            <input type="text" name="txtOcupPadre"/> <br /><br />
            
        <b>Dirección</b>
            <input type="text" name="txtDirecPadre"/>  <br /><br />
            
        <b>Teléfono</b>
            <input type="text" name="txtTelefPadre"/> <br /><br />
        
        <b>Celular</b>
            <input type="text" name="txtCelPadre"/>   <br /><br />
        
        <b>País</b>
            <input type="text" name="txtPaisPadre"/>  <br /><br />
            
        <br /><br />
        <b>Madre</b><br />    
        <b>Nombres</b>
            <input type="text" name="txtNombMadre"/> <br /> <br />
        
        <b>Apellidos</b>
            <input type="text" name="txtApellidMadre"/> <br /> <br />
            
        <b>Ocupación</b>
            <input type="text" name="txtOcupMadre"/>  <br /><br />
            
        <b>Dirección</b>
            <input type="text" name="txtDirecMadre"/>  <br /><br />
            
        <b>Teléfono</b>
            <input type="text" name="txtTelefMadre"/> <br /><br />
        
        <b>Celular</b>
            <input type="text" name="txtCelMadre"/>   <br /><br />
        
        <b>País</b>
            <input type="text" name="txtPaisMadre"/>  <br /><br />
        
        <br /><br />
        <b>Representante </b><br />
            <input type="radio" name="represent" value="madre"/>Madre<br />
            <input type="radio" name="represent" value="padre"/>Padre<br />
            <input type="radio" name="represent" value="otro"/>Otro<br />
           
        <br /><br />
        <b>Otra persona</b> <br />   
        <b>Nombres</b>
            <input type="text" name="txtNombPerson"/> <br /> <br />
        
        <b>Apellidos</b>
            <input type="text" name="txtApellidPerson"/> <br /> <br />
            
        <b>Ocupación</b>
            <input type="text" name="txtOcupPerson"/>  <br /><br />
            
        <b>Dirección</b>
            <input type="text" name="txtDirecPerson"/>  <br /><br />
            
        <b>Teléfono</b>
            <input type="text" name="txtTelefPerson"/> <br /><br />
        
        <b>Celular</b>
            <input type="text" name="txtCelPerson"/>   <br /><br />
        
        <b>País</b>
            <input type="text" name="txtPaisPerson"/>  <br /><br />
        
        <br />
        
        <b>Comentarios</b>
            <input type="text" name="txtComentarios"/>
        <br /><br />
        <input type="submit" name="btnEnviar" value="Enviar"/>  <br /><br />      
            
    </form>
</body>
</html>