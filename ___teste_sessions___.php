<?php

session_start();

echo("<br><br><b>LIMPA SESSIONS</b><br><br>");

echo("<br><b>session_id:</b> " . session_id() . "<br>");

echo("<br>");
var_dump($_SESSION);
echo("<br>");

echo("<br><pre>");
print_r($_SESSION);
echo("</pre><br>");


//
echo("<hr>");

echo("<br><b>session_id:</b> " . session_id() . "<br>");


//
//unset($_SESSION["Categoria_ERRO"]);
//session_destroy();


echo("<br>");
var_dump($_SESSION);
echo("<br>");

echo("<br><pre>");
print_r($_SESSION);
echo("</pre><br>");


?>