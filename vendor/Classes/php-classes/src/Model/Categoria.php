<?php

namespace Vendor\Model;

use Vendor\Model;
use Vendor\DB\Sql;

class Categoria extends Model{

	public static function listAll(){

		$sql = new Sql();

		return $sql->select("
				SELECT 
				c.id_categoria, 
				c.categoria 
				FROM 
				tb_categorias c;
			");

	}

	public static function pesquisaCategoria($categoria){

		$sql = new Sql();

		return $sql->select("
				SELECT 
				c.id_categoria, 
				c.categoria 
				FROM 
				tb_categorias c
				WHERE
				c.categoria LIKE :categoria;
			", array(
				":categoria" => "%" . $categoria . "%" 
		));

	}

	public static function pegaCategoriaPorID($id_categoria){

		$sql = new Sql();

		return $sql->select("
				SELECT 
				c.id_categoria, 
				c.categoria 
				FROM 
				tb_categorias c
				WHERE
				c.id_categoria = :id_categoria;
			", array(
				":id_categoria" => (int)$id_categoria 
		));

	}

	public static function verificaSeExiste($categoria){

		$sql = new Sql();

		$resultado = $sql->select("
			SELECT 
			c.id_categoria 
			FROM 
			tb_categorias c 
			WHERE 
			c.categoria = :categoria;
		", array(
			":categoria"=>ucwords(trim($categoria))
		));

		if(!isset($resultado) || $resultado == "" || $resultado == NULL){

			$resultado = 0;

		}
		else{

			$resultado = (int)$resultado[0]["id_categoria"];

		}

		return $resultado;

	}

	public static function inserir($categoria){

		$resultado = Categoria::verificaSeExiste($categoria);

		if($resultado != 0){

			$_SESSION["msg"] = "A Categoria " . ucwords(trim($categoria)) . " ja Existe!";

			return;
			exit;
		}

		$sql = new Sql();

		$sql->query("
			INSERT INTO tb_categorias 
			(categoria) 
			VALUES
			(
			:categoria
			);
		", array(
			":categoria"=>ucwords(trim($categoria))
		));

		$_SESSION["msg"] = "Categoria Criada com Sucesso!";

	}

	public static function alterar($id_categoria, $categoria){

		$sql = new Sql();

		$sql->query("
			UPDATE tb_categorias SET 
			categoria = :categoria 
			WHERE 
			id_categoria = :id_categoria;
		", array(
			":id_categoria"=>(int)$id_categoria, 
			":categoria"=>ucwords(trim($categoria)) 
		));

	}

	public static function excluir($id_categoria){

		$sql = new Sql();

		$sql->query("
			DELETE 
			FROM 
			tb_categorias 
			WHERE 
			id_categoria = :id_categoria;
		", array(
			":id_categoria"=>(int)$id_categoria 
		));

		$_SESSION["msg"] = "Categoria Excluida com Sucesso!";

	}

}

?>