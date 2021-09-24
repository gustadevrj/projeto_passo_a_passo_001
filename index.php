<?php

session_start();

echo("<br><b><a href='http://www.projeto_teste_001.com.br'>www.projeto_teste_001.com.br</a></b><br>");

echo("<br><b><a href='http://localhost/phpmyadmin/index.php' target='_blank'>PHP MyAdmin</a></b><br>");

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//DOCUMENT_ROOT
//$_SERVER["DOCUMENT_ROOT"] = "C:\\xampp\\htdocs\\UDEMY\\projeto_teste_001";

//C:/xampp/htdocs/UDEMY/projeto_teste_001
//$_SERVER["DOCUMENT_ROOT"] = "C:/xampp/htdocs/UDEMY/projeto_teste_001";


//DocumentRoot "C:/xampp/htdocs/UDEMY/projeto_teste_001"
//<Directory "C:/xampp/htdocs/UDEMY/projeto_teste_001">


//echo("<br>DIRECTORY SEPARATOR: " . DIRECTORY_SEPARATOR . "<br>");
echo("<br>DOCUMENT_ROOT: " . $_SERVER["DOCUMENT_ROOT"] . "<br>");
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

//COMPOSER
require_once("vendor/autoload.php");

use \Slim\Slim;

//SLIM
$app = new Slim();

//MODO DEBUG
$app->config("debug", true);

//
require_once("functions.php");

//
/*
require_once("site.php");
require_once("admin.php");
require_once("admin-users.php");
require_once("admin-categories.php");
require_once("admin-products.php");
require_once("admin-orders.php");
*/

require_once("site.php");

//EXECUTA
$app->run();

?>