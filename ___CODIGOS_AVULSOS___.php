<?php

//****************************************************************************************************************************************************************************************

//Rota - ADMIN - PRODUCT - CREATE
$app->get("/admin/products/create", function(){

	//
	User::verificaLogin();

	//
	$page = new PageAdmin();

	$page->setTpl("products-create");

	exit;

});

//Rota ADMIN - PRODUCT - CREATE - POST
$app->post('/admin/products/create', function() {

	//
	User::verificaLogin();

	//
	//var_dump($_POST);

	$product = new Product();

	$product->setData($_POST);

	//var_dump($product);

	$product->save();

	header("Location: /admin/products");

	exit;

});

//Rota ADMIN - PRODUCT - DELETE - GET
$app->get('/admin/products/:idproduct/delete', function($idproduct) {

	//
	User::verificaLogin();

	//
	$product = new Product();

	$product->get((int)$idproduct);

	$product->delete();

	header("Location: /admin/products");

	exit;

});

//Rota ADMIN - PRODUCT - UPDATE
$app->get('/admin/products/:idproduct', function($idproduct) {

	//
	User::verificaLogin();

	//
	$product = new Product();

	$product->get((int)$idproduct);

	//
	$page = new PageAdmin();

	$page->setTpl("products-update", array(
		"product" => $product->getValues()
	));

	exit;

});

//Rota ADMIN - PRODUCT - UPDATE - POST
$app->post('/admin/products/:idproduct', function($idproduct) {

	//
	User::verificaLogin();

	//
	$product = new Product();

	$product->get((int)$idproduct);

	$product->setData($_POST);

	$product->save();

	//
	$product->setPhoto($_FILES["file"]);

	header("Location: /admin/products");

	exit;

});

//Rota CATEGORY - EXIBE CATEGORIA - GET
$app->get('/categories/:idcategory', function($idcategory) {

	//
	$category = new Category();

	$category->get((int)$idcategory);

	//
	$page = new Page();

	$page->setTpl("category/", array(
		"category" => $category->getValues(),
		"products" => []
	));

	exit;

});


//****************************************************************************************************************************************************************************************

	if (!isset($_POST["despassword"]) || $_POST["despassword"] === ""){

		User::setError("Preencha a Nova Senha!");

		header("Location: /admin/users/$iduser/password");

		exit;

	}

	$user = new User();

	$user->get((int)$iduser);

	$user->setPassword($_POST["despassword"]);

	User::setSuccess("Senha Alterada com Sucesso!");

	header("Location: /admin/users/$iduser/password");

	exit;

//****************************************************************************************************************************************************************************************

//Rota SITE - PRODUCT - DETALHE - GET
$app->get('/products/:desurl', function($desurl) {

	//
	$produto = new Product();

	$produto->getFromURL($desurl);

	//
	$page = new Page();

	$page->setTpl("product-detail", array(
		"product" => $produto->getValues(), 
		"categories"=> $produto->getCategories() 
	));

	exit;

});

//Rota SITE - CART - CARRINHO - GET
$app->get('/cart', function() {

	//
	$cart = Cart::getFromSession();

	//
	$page = new Page();

	//
	//var_dump($cart->getValues());

	$page->setTpl("cart", array(
		"cart"=>$cart->getValues(), 
		"products"=>$cart->getProducts(), 
		"error"=>Cart::getMsgError() 
	));

	exit;

});


//****************************************************************************************************************************************************************************************

//Rota ADMIN
$app->get('/admin', function() {

	//
	User::verificaLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

	exit;

});

//Rota ADMIN - LOGIN
$app->get('/admin/login', function() {

	$page = new PageAdmin([
		"header"=>false, 
		"footer"=>false
	]);

	$page->setTpl("login");

	exit;

});

//Rota ADMIN - LOGIN - POST
$app->post('/admin/login', function() {

	User::login($_POST["login"], $_POST["senha"]);

	header("Location: ../admin");

	exit;

});


//****************************************************************************************************************************************************************************************

//Rota - ADMIN - CATEGORY - CREATE
$app->get("/admin/categories/create", function(){

	//
	User::verificaLogin();

	//
	$page = new PageAdmin();

	$page->setTpl("categories-create");

	exit;

});

//Rota ADMIN - CATEGORY - CREATE - POST
$app->post('/admin/categories/create', function() {

	//
	User::verificaLogin();

	//
	//var_dump($_POST);

	$category = new Category();

	$category->setData($_POST);

	//var_dump($category);

	$category->save();

	header("Location: /admin/categories");

	exit;

});

//Rota ADMIN - CATEGORY - DELETE - GET
$app->get('/admin/categories/:idcategory/delete', function($idcategory) {

	//
	User::verificaLogin();

	//
	$category = new Category();

	$category->get((int)$idcategory);

	$category->delete();

	header("Location: /admin/categories");

	exit;

});

//Rota ADMIN - CATEGORY - UPDATE
$app->get('/admin/categories/:idcategory', function($idcategory) {

	//
	User::verificaLogin();

	//
	$category = new Category();

	$category->get((int)$idcategory);

	//
	$page = new PageAdmin();

	$page->setTpl("categories-update", array(
		"category" => $category->getValues()
	));

	exit;

});

//Rota ADMIN - CATEGORY - UPDATE - POST
$app->post('/admin/categories/:idcategory', function($idcategory) {

	//
	User::verificaLogin();

	//
	$category = new Category();

	$category->get((int)$idcategory);

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");

	exit;

});


//****************************************************************************************************************************************************************************************

//PAGE

namespace Hcode;

use Rain\Tpl;

class Page{

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data" => []
	];

	public function __construct($opts = array(), $tpl_dir = "/views/"){

		$this->options = array_merge($this->defaults, $opts);

		// config
		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"] . $tpl_dir,
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"] . "/views-cache/",
			"debug"         => true // set to false to improve the speed
		);

		Tpl::configure( $config );

		// create the Tpl object
		$this->tpl = new Tpl();

		$this->setData($this->options["data"]);

		if($this->options["header"] === true){
			$this->tpl->draw("header");
		}
	}

	private function setData($data = array()){
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}

	public function setTpl($name, $data = array(), $returnHTML = false){

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		if($this->options["footer"] === true){
			$this->tpl->draw("footer");
		}

	}
}


//PAGE ADMIN

namespace Hcode;

class PageAdmin extends Page{

	public function __construct($opts = array(), $tpl_dir = "/views/admin/"){

		parent::__construct($opts, $tpl_dir);

	}

}


//****************************************************************************************************************************************************************************************

//CLASSES


//******************************
	const SESSION = "Cart";
	const SESSION_ERROR = "CartError";

	public function setToSession(){

		$_SESSION[Cart::SESSION] = $this->getValues();

	}

	public function getFromSessionID(){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_carts WHERE dessessionid = :dessessionid;", array(
				":dessessionid" => session_id()
		));

		if(count($result) > 0){
			$this->setData($result[0]);
		}

	}

	public function get(int $idcart){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_carts WHERE idcart = :idcart;", array(
				":idcart" => $idcart
		));

		if(count($result) > 0){
			$this->setData($result[0]);
		}

	}

	//
	public function getValues(){

		$this->getCalculateTotal();

		return parent::getValues();

	}


//******************************
	public static function listAll(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_categories ORDER BY descategory;");

	}


//******************************
	const SUCCESS = "Order-Success";
	const ERROR = "Order-Error";

	public function get($idorder){

		$sql = new Sql();

		$result = $sql->select("
				SELECT * FROM 
				tb_orders a 
				INNER JOIN tb_ordersstatus b USING (idstatus) 
				INNER JOIN tb_carts c USING (idcart) 
				INNER JOIN tb_users d ON d.iduser = a.iduser 
 				INNER JOIN tb_addresses e ON e.idaddress = c.idaddress 
				INNER JOIN tb_persons f ON f.idperson = d.idperson 
				WHERE 
				a.idorder = :idorder;
			", array(
				":idorder"=>$idorder
			));

		if(count($result) > 0){
			$data = $result[0];

			$this->setData($data);
		}

	}

	public function delete(){

		$sql = new Sql();

		$sql->query("
			DELETE FROM tb_orders WHERE idorder = :idorder;
			", array(
				":idorder"=>$this->getidorder()
			));

	}

	public function getCart():Cart{

		$cart = new Cart();

		$cart->get((int)$this->getidcart());

		return $cart;

	}

	public static function setMsgError($msg){

		$_SESSION[Order::ERROR] = $msg;

	}

	public static function getMsgError(){

		$msg = (isset($_SESSION[Order::ERROR]) && $_SESSION[Order::ERROR]) ? $_SESSION[Order::ERROR] : '';

		Order::clearMsgError();

		return $msg;

	}

	public static function clearMsgError(){

		$_SESSION[Order::ERROR] = NULL;

	}

	public static function setMsgSuccess($msg){

		$_SESSION[Order::SUCCESS] = $msg;

	}

	public static function getMsgSuccess(){

		$msg = (isset($_SESSION[Order::SUCCESS]) && $_SESSION[Order::SUCCESS]) ? $_SESSION[Order::SUCCESS] : '';

		Order::clearMsgSuccess();

		return $msg;

	}

	public static function clearMsgSuccess(){

		$_SESSION[Order::SUCCESS] = NULL;

	}


//******************************
	public static function checkList($list){

		foreach ($list as &$row) {
			$p = new Product();
			$p->setData($row);
			$row = $p->getValues();
		}

		return $list;

	}

	public function getValues(){

		//
		$this->checkPhoto();

		//
		$values = parent::getValues();

		return $values;

	}

	//
	public function getCategories(){

		$sql = new Sql();

		return $sql->select("
				SELECT * FROM 
				tb_categories a INNER JOIN tb_productscategories b 
				ON a.idcategory = b.idcategory 
				WHERE
				b.idproduct = :idproduct;", 
			array(
				":idproduct" => $this->getidproduct()
			)
		);

	}


//******************************
	const SESSION = "User";

	const SECRET = "0123456789ABCDEF";

	const SECRET_IV = "FEDCBA9876543210";

	const ERROR = "UserError";
	const ERROR_REGISTER = "UserErrorRegister";
	const SUCCESS = "UserSucesss";

	public static function getFromSession(){

		$user = new User();

		if(isset($_SESSION[User::SESSION]) && ((int)$_SESSION[User::SESSION]["iduser"]) > 0){

			$user->setData($_SESSION[User::SESSION]);

		}

		return $user;

	}

	public static function listAll(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson;");

	}

	public function getOrders(){

		$sql = new Sql();

		$results = $sql->select("
			SELECT * 
			FROM tb_orders a 
			INNER JOIN tb_ordersstatus b USING(idstatus) 
			INNER JOIN tb_carts c USING(idcart)
			INNER JOIN tb_users d ON d.iduser = a.iduser
			INNER JOIN tb_addresses e ON e.idaddress = c.idaddress 
			INNER JOIN tb_persons f ON f.idperson = d.idperson
			WHERE a.iduser = :iduser
		", [
			':iduser'=>$this->getiduser()
		]);

		return $results;

	}

	public static function setErrorRegister($msg){

		$_SESSION[User::ERROR_REGISTER] = $msg;

	}

	public static function getErrorRegister(){

		$msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

		User::clearErrorRegister();

		return $msg;

	}

	public static function clearErrorRegister(){

		$_SESSION[User::ERROR_REGISTER] = NULL;

	}

	public static function checkLoginExists($login){

		$sql = new Sql();

		$results = $sql->select("
				SELECT * FROM tb_users WHERE deslogin = :deslogin
			", array(
				":deslogin"=>$login
		));

		return (count($results) > 0);

	}


//****************************************************************************************************************************************************************************************

//VIEWS


//******************************
{loop="$products"}
	<div class="single-product">
		<div class="product-f-image">
			<img src="{$value.desphoto}" alt="">
			<div class="product-hover">
				<a href="/cart/{$value.idproduct}/add" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Adicionar ao Carrinho</a>
				<a href="/products/{$value.desurl}" class="view-details-link"><i class="fa fa-link"></i> Ver Detalhes</a>
			</div>
		</div>

		<h2><a href="/product/{$value.desurl}">{$value.desproduct}</a></h2>

		<div class="product-carousel-price">
			<ins>R$ {function="formatPrice($value.vlprice)"}</ins> <!--<del>$100.00</del>-->
		</div> 
	</div>
{/loop}


//******************************
<input name="shippingAddressPostalCode" type="hidden" value="{$order.deszipcode}">
<input name="shippingAddressStreet" type="hidden" value="{function="utf8_encode($order.desaddress)"}">
<input name="shippingAddressCity" type="hidden" value="{function="utf8_encode($order.descity)"}">
<input name="shippingAddressState" type="hidden" value="{function="utf8_encode($order.desstate)"}">
<input name="shippingAddressCountry" type="hidden" value="{function="utf8_encode($order.descountry)"}">


//******************************
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{$product.desproduct}</h2>
                </div>
            </div>
        </div>
    </div>
</div>


//******************************
<form method="post" action="/profile">
	<div class="form-group">
	<label for="desperson">Nome completo</label>
	<input type="text" class="form-control" id="desperson" name="desperson" placeholder="Digite o nome aqui" value="{$user.desperson}">
	</div>
	<div class="form-group">
	<label for="desemail">E-mail</label>
	<input type="email" class="form-control" id="desemail" name="desemail" placeholder="Digite o e-mail aqui" value="{$user.desemail}">
	</div>
	<div class="form-group">
	<label for="nrphone">Telefone</label>
	<input type="tel" class="form-control" id="nrphone" name="nrphone" placeholder="Digite o telefone aqui" value="{$user.nrphone}">
	</div>
	<button type="submit" class="btn btn-primary">Salvar</button>
</form>


//******************************
<div class="col-md-3">
	{include="profile-menu"}
</div>


//******************************
{if="$changePassError != ''"}
	<div class="alert alert-danger">
		{$changePassError}
	</div>
{/if}

{if="$changePassSuccess != ''"}
	<div class="alert alert-success">
		{$changePassSuccess}
	</div>
{/if}


//******************************
{loop="$products"}
	<tr class="cart_item">
		<td class="product-name">
			{$value.desproduct} <strong class="product-quantity">× {$value.nrqtd}</strong> 
		</td>
		<td class="product-total">
			<span class="amount">R$ {function="formatPrice($value.vltotal)"}</span>
		</td>
	</tr>
{/loop}


//******************************
<tr class="order-total">
	<th>Total do Pedido</th>
	<td><strong><span class="amount">R$ {function="formatPrice($cart.vltotal)"}</span></strong> </td>
</tr>


//****************************************************************************************************************************************************************************************
//****************************************************************************************************************************************************************************************
//****************************************************************************************************************************************************************************************
//****************************************************************************************************************************************************************************************
//****************************************************************************************************************************************************************************************

?>