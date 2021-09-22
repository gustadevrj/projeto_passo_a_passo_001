<?php

use \Vendor\Page;

use \Vendor\Model\Categoria;

//ROTA RAIZ
$app->get("/", function(){

	echo("<br><b>>>>ROTA RAIZ</b><br><hr>");

	$page = new Page();

	$page->setTpl("index", array(
		"conteudo"=>"", 
		"texto"=>""
	));

	exit;

});

//ROTA PASSANDO PARAMETRO PARA HTML
$app->get("/rota_parametro_html", function(){

	echo("<br><b>>>>ROTA PASSANDO PARAMETRO PARA HTML</b><br><hr>");

	//
	$conteudo = array(
		"001"=>"Bernardo", 
		"002"=>"Gustavo"
	);

	$page = new Page();

	$page->setTpl("index", array(
		"conteudo"=>$conteudo, 
		"texto"=>"Texto Passado para o HTML"
	));

	exit;

});

//ROTA RECEBENDO PARAMETRO VIA QUERYSTRING
$app->get("/rota_parametro_querystring/:name", function($name){

	echo("<br><b>>>>ROTA RECEBENDO PARAMETRO VIA QUERYSTRING</b><br><hr>");

	echo("<br><br>Oi, " . $name . " ! ! !<br><br>");

	$page = new Page();

	$page->setTpl("index", array(
		"conteudo"=>"", 
		"texto"=>""
	));

	exit;

});

//ROTA FORMULARIO GET
$app->get("/rota_formulario_post", function(){

	echo("<br><b>>>>ROTA FORMULARIO POST</b><br><hr>");

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_formulario_post", array(
		"msg"=> $msg
	));

	exit;

});

//ROTA RESPOSTA FORMULARIO POST
$app->post("/rota_resposta_formulario_post", function(){

	echo("<br><b>>>>ROTA RESPOSTA FORMULARIO POST</b><br><hr>");

	//
	if (!isset($_POST['texto']) || $_POST['texto'] === ''){
		$_SESSION["msg"] = "Digite Alguma Coisa!";
		header("Location: rota_formulario_post");
		exit;
	}
	else{
		$texto = strtoupper($_POST['texto']);
	}

	$page = new Page();

	$page->setTpl("rota_resposta_formulario_post", [
		"texto"=>$texto 
	]);

	exit;

});

//ROTA FORMULARIO GET
$app->get("/rota_formulario_get", function(){

	echo("<br><b>>>>ROTA FORMULARIO GET</b><br><hr>");

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_formulario_get", array(
		"msg"=> $msg
	));

	exit;

});

//ROTA RESPOSTA FORMULARIO GET
$app->get("/rota_resposta_formulario_get", function(){

	echo("<br><b>>>>ROTA RESPOSTA FORMULARIO GET</b><br><hr>");

	//
	if (!isset($_GET['texto']) || $_GET['texto'] === ''){
		$_SESSION["msg"] = "Digite Alguma Coisa!";
		header("Location: rota_formulario_get");
		exit;
	}
	else{
		$texto = strtoupper($_GET['texto']);
	}

	$page = new Page();

	$page->setTpl("rota_resposta_formulario_get", [
		"texto"=>$texto 
	]);

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - LISTAGEM - GET
$app->get("/rota_classe_categoria_listagem", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - LISTAGEM</b><br><hr>");

	//
	$categoria = new Categoria();


	$page = new Page();

	$page->setTpl("rota_classe_categoria_listagem", [
		""=>"" 
	]);

	exit;

});



?>