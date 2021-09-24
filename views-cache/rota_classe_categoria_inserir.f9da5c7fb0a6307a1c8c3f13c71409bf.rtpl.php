<?php if(!class_exists('Rain\Tpl')){exit;}?>

<b>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><br>

<br>

<?php if( $msg != '' ){ ?>

	<font color="RED"><b><?php echo htmlspecialchars( $msg, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></font>
	<br><br>
<?php } ?>

<div>

<form action="/rota_classe_categoria_inserir" method="post">

	<label for="txt_categoria">Categoria:</label>
	<input type="text" id="txt_categoria" name="txt_categoria" placeholder="Insira a Categoria">

	<input type="submit" value="Inserir">

</form>

</div>

