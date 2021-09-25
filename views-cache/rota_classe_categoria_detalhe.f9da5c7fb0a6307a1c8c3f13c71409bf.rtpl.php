<?php if(!class_exists('Rain\Tpl')){exit;}?>

<b>ROTA CLASSE CATEGORIA - CRUD - DETALHE</b><br><br>

<div>
<a href="/rota_classe_categoria_inserir"><b>INCLUIR NOVA CATEGORIA</b></a>
</div>

<br>

<?php if( $msg != '' ){ ?>

	<font color="GREEN"><b><?php echo htmlspecialchars( $msg, ENT_COMPAT, 'UTF-8', FALSE ); ?></b></font>
	<br><br>
<?php } ?>

<div>
	<form action="/rota_classe_categoria_listagem" method="post">
		<input type="text" id="pesquisa" name="pesquisa" placeholder="Pesquisar Por Categoria" value="<?php echo htmlspecialchars( $pesquisa, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
		<button type="submit">Pesquisar</button>
	</form>
</div>

<hr>

<p><b>>>>CATEGORIA <?php echo formata_nome($categoria["categoria"]); ?></b></p>

<div>
	<p><b>CODIGO:</b> <?php echo htmlspecialchars( $categoria["id_categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
	<p><b>CATEGORIA:</b> <?php echo htmlspecialchars( $categoria["categoria"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
	<p><b>DESCRICAO:</b> <?php echo htmlspecialchars( $categoria["descricao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
</div>


<button type="button" onclick="window.location='/rota_classe_categoria_listagem';">Voltar</button>

</table>

