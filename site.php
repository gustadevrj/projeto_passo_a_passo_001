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

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_classe_categoria_listagem", array(
		"pesquisa"=>"", 
		"categorias"=>Categoria::listAll(), 
		"msg"=>$msg 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - LISTAGEM - PESQUISA - POST
$app->post("/rota_classe_categoria_listagem", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - LISTAGEM - PESQUISA</b><br><hr>");

	//

	$pesquisa = (isset($_POST["pesquisa"])) ? $_POST["pesquisa"] : "";

	if (!isset($pesquisa) || !$pesquisa == "" || !$pesquisa === NULL){
		$msg = "Pesquisa Por: " . $pesquisa;
	}
	else{
		$msg = "";
	}

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_classe_categoria_listagem", array(
		"pesquisa"=>$pesquisa, 
		"categorias"=>Categoria::pesquisaCategoria($pesquisa), 
		"msg"=>$msg 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - INSERIR - GET
$app->get("/rota_classe_categoria_inserir", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><hr>");

	//

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	$page = new Page();

	$page->setTpl("rota_classe_categoria_inserir", array(
		"msg"=>$msg 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - INSERIR - POST
$app->post("/rota_classe_categoria_inserir", function(){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - INSERIR</b><br><hr>");

	//

	if (!isset($_POST['txt_categoria']) || $_POST['txt_categoria'] === ''){
		$_SESSION["msg"] = "A Categoria Nao Pode ser Vazia!";
		header("Location: /rota_classe_categoria_inserir");
		exit;
	}

	Categoria::inserir($_POST["txt_categoria"]);

	//$_SESSION["msg"] = "Categoria Criada com Sucesso!";

	header("Location: /rota_classe_categoria_listagem");

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - ALTERAR - GET
$app->get("/rota_classe_categoria_alterar/:id_categoria", function($id_categoria){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - ALTERAR</b><br><hr>");

	if (!isset($_SESSION['msg']) || !$_SESSION['msg'] === '' || !$_SESSION['msg'] === NULL){
		$msg = "";
	}
	else{
		$msg = $_SESSION["msg"];
		$_SESSION["msg"] = NULL;
	}

	//

	$categoria = Categoria::pegaCategoriaPorID($id_categoria);

	$page = new Page();

	$page->setTpl("rota_classe_categoria_alterar", array(
		"id_categoria"=>$id_categoria, 
		"categoria"=>$categoria[0]["categoria"], 
		"msg"=>$msg 
	));

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - ALTERAR - POST
$app->post("/rota_classe_categoria_alterar/:id_categoria", function($id_categoria){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - ALTERAR</b><br><hr>");

	//

	if (!isset($_POST['txt_categoria']) || $_POST['txt_categoria'] === ''){
		$_SESSION["msg"] = "A Categoria Nao Pode ser Vazia!";
		header("Location: /rota_classe_categoria_alterar/$id_categoria");
		exit;
	}

	Categoria::alterar($id_categoria, $_POST["txt_categoria"]);

	$_SESSION["msg"] = "Categoria Alterada com Sucesso!";

	header("Location: /rota_classe_categoria_listagem");

	exit;

});

//ROTA CLASSE CATEGORIA CRUD - EXCLUIR - GET
$app->get("/rota_classe_categoria_excluir/:id_categoria", function($id_categoria){

	echo("<br><b>>>>ROTA CLASSE CATEGORIA - CRUD - EXCLUIR</b><br><hr>");

	//

	$categoria = Categoria::excluir($id_categoria);

	//$_SESSION["msg"] = "Categoria Excluida com Sucesso!";

	header("Location: /rota_classe_categoria_listagem");
/*
	$page = new Page();

	$page->setTpl("rota_classe_categoria_alterar", array(
		"id_categoria"=>$id_categoria, 
		"categoria"=>$categoria[0]["categoria"], 
		"msg"=>$msg 
	));
*/
	exit;

});

?>