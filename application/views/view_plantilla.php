<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Sedita's Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="Sedita" content="" />
	<base href="<?=site_url()?>" />
    
    <script src="js/jquery.js"></script>
    <script src="js/jquery.validate.js"></script>
    
    <script>
        $(document).ready(function(){
            var va = $("#forma").validate({
                rules:{
					txtUser:{
                        required: true,
                        minlength: 4
                    },
                    
                    txtClave:{
                        required: true,
                        minlength: 5
                    }
                },
                
                messages:{
					txtUser:{
                        required: "Este campo es requerido",
                        minlength: "Debe escribir por lo menos 5 caracteres"
                    },
                    
                    txtClave:{
                        required: "Este campo es requerido",
                        minlength: "Debe escribir por lo menos 5 caracteres"
                    }
                 }
            });
        });
    </script>
    
  </head>

  <body>
  
    <?=$error?>
    <form id="forma" name="forma" action="<?=site_url("login/validar")?>" method="post" >
        <select name="tipoUser">
            <option selected="selected" value="adm">Administrador</option>
            <option value="prof">Profesor</option>
        </select>
        
        <input type="text" id="txtUser"  name="txtUser" placeholder="Usuario" />
        <input type="password" id="txtClave" name="txtClave" placeholder="Contrase&ntilde;a" />
        <input type="submit" value="Ingresar" />
    </form>
    
  </body>
</html>