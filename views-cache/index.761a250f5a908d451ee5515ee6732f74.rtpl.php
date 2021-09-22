<?php if(!class_exists('Rain\Tpl')){exit;}?>
<br><br>
<b>TEMPLATE HTML</b>
<br><br>

	<?php $counter1=-1;  if( isset($conteudo) && ( is_array($conteudo) || $conteudo instanceof Traversable ) && sizeof($conteudo) ) foreach( $conteudo as $key1 => $value1 ){ $counter1++; ?>

		<?php if( $value1 == 'Gustavo' ){ ?>
			<b>Nome:</b> <?php echo formata_nome($value1); ?> - (PAI)<br>
		<?php }else{ ?>
			<b>Nome:</b> <?php echo formata_nome($value1); ?><br>
		<?php } ?>

	<?php } ?>

<?php if( $texto != '' ){ ?>
	<br>
	<b>TEXTO RECEBIDO:</b> <?php echo htmlspecialchars( $texto, ENT_COMPAT, 'UTF-8', FALSE ); ?>
<?php } ?>
