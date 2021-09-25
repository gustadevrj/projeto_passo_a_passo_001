<?php if(!class_exists('Rain\Tpl')){exit;}?>

<b>ROTA CLASSE CATEGORIA - CRUD - LISTAGEM</b><br><br>

<div>
<a href="/rota_classe_categoria_inserir"><b>INCLUIR NOVA CATEGORIA</b></a>
</div>

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
	<form action="/rota_classe_categoria_listagem" method="post">
		<input type="text" id="pesquisa" name="pesquisa" placeholder="Pesquisar..." value="<?php echo htmlspecialchars( $pesquisa, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
		<button type="submit">Pesquisar</button>
	</form>
</div>

<br>

<?php if( $categorias != NULL ){ ?>

	<table border="3" width="950">
	<tr>
		<th align="center">CODIGO</td>
		<th align="center">CATEGORIA</td>
		<th align="center">DESCRICAO</td>
		<th width="230" colspan="3" align="center">&nbsp;</td>
	</tr>

	<?php $counter1=-1;  if( isset($categorias) && ( is_array($categorias) || $categorias instanceof Traversable ) && sizeof($categorias) ) foreach( $categorias as $key1 => $value1 ){ $counter1++; ?>
		<tr>
			<td align="center"><?php echo htmlspecialchars( $value1["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			<td align="left"><?php echo htmlspecialchars( $value1["categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			<td align="left"><?php echo htmlspecialchars( $value1["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			<td align="center"><a href="/rota_classe_categoria_detalhe/<?php echo htmlspecialchars( $value1["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">DETALHE</a></td>
			<td align="center"><a href="/rota_classe_categoria_alterar/<?php echo htmlspecialchars( $value1["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">ALTERAR</a></td>
			<td align="center"><a href="/rota_classe_categoria_excluir/<?php echo htmlspecialchars( $value1["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro?')" >EXCLUIR</a></td>
		</tr>
	<?php } ?>

	</table>

<?php } ?>

