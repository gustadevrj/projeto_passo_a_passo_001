<?php if(!class_exists('Rain\Tpl')){exit;}?>
<br><b>Formulario - GET</b><br><br>

<?php if( $msg != '' ){ ?>
	<div>
		<br><font color="RED"><b><?php echo htmlspecialchars( $msg, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></font><br><br>
	</div>
<?php } ?>

<form action="rota_resposta_formulario_get" method="get">

	<label for="texto">Digite um Texto Aqui:</label>
	<input type="text" id="texto" name="texto">

	<input type="submit" value="Enviar">

</form>




