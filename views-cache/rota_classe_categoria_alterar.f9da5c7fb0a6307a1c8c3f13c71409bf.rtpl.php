<?php if(!class_exists('Rain\Tpl')){exit;}?>

<b>ROTA CLASSE CATEGORIA - CRUD - ALTERAR</b><br><br>

<br>

<?php if( $msg_erro != '' ){ ?>

	<font color="RED"><b><?php echo htmlspecialchars( $msg_erro, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></font>
	<br><br>
<?php } ?>

<?php if( $msg_sucesso != '' ){ ?>

	<font color="GREEN"><b><?php echo htmlspecialchars( $msg_sucesso, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></font>
	<br><br>
<?php } ?>

<div>

<form action="/rota_classe_categoria_alterar/<?php echo htmlspecialchars( $categoria["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">

	<label for="categoria">Categoria:</label>
	<input type="text" id="categoria" name="categoria"  placeholder="Insira a Categoria" value="<?php echo htmlspecialchars( $categoria["categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

	<label for="descricao">Descricao:</label>
	<input type="text" id="descricao" name="descricao" placeholder="Insira a Descricao"  value="<?php echo htmlspecialchars( $categoria["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

	<input type="submit" value="Alterar">&nbsp;<button type="reset" value="resetar">Resetar</button>&nbsp;<button type="button" onclick="window.location='/rota_classe_categoria_listagem';">Cancelar</button>

</form>

</div>

