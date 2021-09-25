<?php if(!class_exists('Rain\Tpl')){exit;}?>

<b>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><br>

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

<form action="/rota_classe_categoria_inserir" method="post">

	<label for="categoria">Categoria:</label>
	<input type="text" id="categoria" name="categoria" placeholder="Insira a Categoria" value="<?php echo htmlspecialchars( $categoria, ENT_COMPAT, 'UTF-8', FALSE ); ?>">

	<label for="descricao">Descricao:</label>
	<input type="text" id="descricao" name="descricao" placeholder="Insira a Descricao" value="<?php echo htmlspecialchars( $descricao, ENT_COMPAT, 'UTF-8', FALSE ); ?>">

	<input type="submit" value="Inserir">&nbsp;<button type="button" onclick="window.location='/rota_classe_categoria_listagem';">Cancelar</button>

</form>

</div>

