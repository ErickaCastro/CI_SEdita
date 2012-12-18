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