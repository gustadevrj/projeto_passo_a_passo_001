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

	echo("<br><font color='GREEN'><b> * * * Oi, " . strtoupper($name) . " ! ! !</b></font><br>");

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
		header("Location: /rota_formulario_post");
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
		header("Location: /rota_formulario_get");
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


//##############################
//##############################
//CLASSE CATEGORIA
//##############################
//##############################


//ROTA CLASSE CATEGORIA CRUD - LISTAGEM - GET
$app->get("/rota_classe_categoria_listagem", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - LISTAGEM</b><br><hr>");

	//

	//
	$categorias = Categoria::listAll();

	$page = new Page();

	$page->setTpl("rota_classe_categoria_listagem", array(
		"pesquisa"=>"", 
		"categorias"=>$categorias, 
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso() 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - LISTAGEM - PESQUISA - POST
$app->post("/rota_classe_categoria_listagem", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - LISTAGEM - PESQUISA</b><br><hr>");

	//

	$pesquisa = (isset($_POST["pesquisa"])) ? $_POST["pesquisa"] : "";

	//
	$categorias = Categoria::pesquisar((string)$pesquisa);

	$page = new Page();

	$page->setTpl("rota_classe_categoria_listagem", array(
		"pesquisa"=>$pesquisa, 
		"categorias"=>$categorias, 
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso() 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - INSERIR - GET
$app->get("/rota_classe_categoria_inserir", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><hr>");

	//
	$categoria = "";
	$descricao = "";

	if((($_SESSION["categoria"] != "") || ($_SESSION["categoria"] != NULL)) || (($_SESSION["descricao"] != "") || ($_SESSION["descricao"] != NULL))){
		$categoria = $_SESSION["categoria"];
		$descricao = $_SESSION["descricao"];

		$_SESSION["categoria"] = NULL;
		$_SESSION["descricao"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_classe_categoria_inserir", array(
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso(), 
		"categoria"=>$categoria, 
		"descricao"=>$descricao 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - INSERIR - POST
$app->post("/rota_classe_categoria_inserir", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><hr>");

	//
	$categoria = new Categoria();

	$categoria->setData($_POST);

	$categoria->inserir();

	if(($_SESSION["categoria"] == NULL) || ($_SESSION["descricao"] == NULL)){
		header("Location: /rota_classe_categoria_inserir");
		exit;
	}
	else{

		$_SESSION["categoria"] = NULL;
		$_SESSION["descricao"] = NULL;

		header("Location: /rota_classe_categoria_listagem");
		exit;
	}

});

//ROTA CLASSE CATEGORIA CRUD - ALTERAR - GET
$app->get("/rota_classe_categoria_alterar/:id_categoria", function($id_categoria){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - ALTERAR</b><br><hr>");

	/*********************************$msg_sucesso = NULL;

	if (!isset($_SESSION[Categoria::ERRO]) || !$_SESSION[Categoria::ERRO] === '' || !$_SESSION[Categoria::ERRO] === NULL){
		$msg_erro = NULL;
	}
	else{
		$msg_erro = $_SESSION[Categoria::ERRO];
		$_SESSION[Categoria::ERRO] = NULL;
	}*/

	//
	$categoria = "";
	$descricao = "";

	if((($_SESSION["categoria"] != "") || ($_SESSION["categoria"] != NULL)) || (($_SESSION["descricao"] != "") || ($_SESSION["descricao"] != NULL))){
		$categoria = $_SESSION["categoria"];
		$descricao = $_SESSION["descricao"];

		$_SESSION["categoria"] = NULL;
		$_SESSION["descricao"] = NULL;
	}

	//

	$categoria = Categoria::pegaCategoriaPorID((int)$id_categoria);

	$page = new Page();

	$page->setTpl("rota_classe_categoria_alterar", array( 
		"categoria"=>$categoria->getValues(), 
		"msg_erro"=>Categoria::getMsgErro(), 
		"msg_sucesso"=>Categoria::getMsgSucesso() 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - ALTERAR - POST
$app->post("/rota_classe_categoria_alterar/:id_categoria", function($id_categoria){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - ALTERAR</b><br><hr>");

	//

	/*************************************if (!isset($_POST['categoria']) || $_POST['categoria'] === ''){
		$_SESSION["msg"] = "A Categoria Nao Pode ser Vazia!";
		header("Location: /rota_classe_categoria_alterar/$id_categoria");
		exit;
	}

	if (!isset($_POST['descricao']) || $_POST['descricao'] === ''){
		$_SESSION["msg"] = "A Descricao Nao Pode ser Vazia!";
		header("Location: /rota_classe_categoria_alterar/$id_categoria");
		exit;
	}*/

	$categoria = Categoria::pegaCategoriaPorID((int)$id_categoria);

	$categoria->setData($_POST);

	$categoria->alterar();

	if(($_SESSION["categoria"] == NULL) || ($_SESSION["descricao"] == NULL)){
		header("Location: /rota_classe_categoria_alterar/$id_categoria");
		exit;
	}
	else{

		$_SESSION["categoria"] = NULL;
		$_SESSION["descricao"] = NULL;

		header("Location: /rota_classe_categoria_listagem");
		exit;
	}


	/********************************************if (isset($_SESSION[Categoria::ERRO]) || $_SESSION[Categoria::ERRO] != ''){
		header("Location: /rota_classe_categoria_alterar/$id_categoria");
		exit;
	}*/

	//$_SESSION["msg"] = "Categoria Alterada com Sucesso!";

	header("Location: /rota_classe_categoria_listagem");

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - EXCLUIR - GET
$app->get("/rota_classe_categoria_excluir/:id_categoria", function($id_categoria){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - EXCLUIR</b><br><hr>");

	//

	$categoria = Categoria::excluir((int)$id_categoria);

	//$_SESSION["msg"] = "Categoria Excluida com Sucesso!";

	header("Location: /rota_classe_categoria_listagem");

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - DETALHE - GET
$app->get("/rota_classe_categoria_detalhe/:id_categoria", function($id_categoria){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - DETALHE</b><br><hr>");

	//

	$categoria = Categoria::retornaDados((int)$id_categoria);

	$page = new Page();

	$page->setTpl("rota_classe_categoria_detalhe", array(
		"categoria"=>$categoria->getValues(), 
		"pesquisa"=>"", 
		"msg"=>"" 
	));

	exit;

});

?>