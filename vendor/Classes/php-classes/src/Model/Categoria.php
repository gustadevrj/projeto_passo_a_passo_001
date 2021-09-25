<?php

namespace Vendor\Model;

use Vendor\Model;
use Vendor\DB\Sql;

class Categoria extends Model{

	const ERRO = "Categoria_ERRO";
	const SUCESSO = "Categoria_SUCESSO";

	public static function listAll(){

		$sql = new Sql();

		$rows = $sql->select("
				SELECT 
				c.id_categoria, 
				c.categoria, 
				c.descricao 
				FROM 
				tb_categorias c;
			");

		if(count($rows) > 0){

			return $rows;

		}
		else{

			//$_SESSION["msg"] = "Nenhum Registro Encontrado!";
			Categoria::setMsgErro("Nenhum Registro Encontrado!");

			return NULL;
		}

	}

	public static function pesquisar(string $categoria){

		$sql = new Sql();

		$rows = $sql->select("
				SELECT 
				c.id_categoria, 
				c.categoria, 
				c.descricao 
				FROM 
				tb_categorias c 
				WHERE 
				(
				c.categoria LIKE :categoria 
				OR c.descricao LIKE :categoria
				) 
				ORDER BY 
				c.categoria ASC;
			", array(
				":categoria" => "%" . $categoria . "%" 
		));

		if(count($rows) > 0){

			Categoria::setMsgSucesso("Pesquisa Por: " . $categoria);

			return $rows;

		}
		else{

			//$_SESSION["msg"] = "Nenhum Registro Encontrado!";
			Categoria::setMsgErro("Nenhum Registro Encontrado!");

			return NULL;
		}

	}

	public static function pegaCategoriaPorID(int $id_categoria){

		$sql = new Sql();

		$rows = $sql->select("
				SELECT 
				c.id_categoria, 
				c.categoria, 
				c.descricao 
				FROM 
				tb_categorias c
				WHERE
				c.id_categoria = :id_categoria;
			", array(
				":id_categoria" => (int)$id_categoria 
		));

		if(count($rows) > 0){

			$categoria = new Categoria();

			//setData
			$categoria->setData($rows[0]);

			return $categoria;

		}
		else{

			//$_SESSION["msg"] = "Nenhum Registro Encontrado!";
			Categoria::setMsgErro("Nenhum Registro Encontrado!");

			return NULL;
		}

	}

	public static function verificaSeExiste(string $categoria, int $id_categoria = NULL){

		$sql = new Sql();

		if($id_categoria == NULL){

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

		}
		else{

			$resultado = $sql->select("
				SELECT 
				c.id_categoria 
				FROM 
				tb_categorias c 
				WHERE 
				c.categoria = :categoria
				AND c.id_categoria <> :id_categoria;
			", array(
				":categoria"=>ucwords(trim($categoria)), 
				":id_categoria"=>(int)$id_categoria 
			));

		}

		if(!isset($resultado) || $resultado == "" || $resultado == NULL){

			$resultado = 0;

		}
		else{

			$resultado = (int)$resultado[0]["id_categoria"];

		}

		return $resultado;

	}

	public function inserir(){

		//
		$_SESSION["categoria"] = ($this->getcategoria() == NULL) ? NULL : $this->getcategoria();
		$_SESSION["descricao"] = ($this->getdescricao() == NULL) ? NULL : $this->getdescricao();

		//
		if(($this->getcategoria() == NULL) || ($this->getcategoria() == "") || ($this->getdescricao() == NULL) || ($this->getdescricao() == "")){

			//$_SESSION["categoria"] = $this->getcategoria();
			//$_SESSION["descricao"] = $this->getdescricao();

			//
			Categoria::setMsgErro("Preencha os Campos do Formulario!");

			return;
			exit;

		}

		$resultado = Categoria::verificaSeExiste((string)$this->getcategoria());

		if($resultado != 0){

			//$_SESSION["categoria"] = $this->getcategoria();
			//$_SESSION["descricao"] = $this->getdescricao();

			//$_SESSION["msg"] = "A Categoria " . ucwords(trim($this->getcategoria())) . " ja Existe!";
			Categoria::setMsgErro("A Categoria " . ucwords(trim($this->getcategoria())) . " ja Existe!");

			return;
			exit;
		}

		$sql = new Sql();

		$sql->query("
			INSERT INTO tb_categorias 
			(categoria, descricao) 
			VALUES
			(
			:categoria, 
			:descricao 
			);
		", array(
			":categoria"=>ucwords(trim($this->getcategoria())), 
			":descricao"=>ucwords(trim($this->getdescricao())) 
		));

		//$_SESSION["msg"] = "Categoria Criada com Sucesso!";
		Categoria::setMsgSucesso("Categoria Criada com Sucesso!");

	}

	public function alterar(){

		//
		$_SESSION["categoria"] = ($this->getcategoria() == NULL) ? NULL : $this->getcategoria();
		$_SESSION["descricao"] = ($this->getdescricao() == NULL) ? NULL : $this->getdescricao();

		//
		if(($this->getcategoria() == NULL) || ($this->getcategoria() == "") || ($this->getdescricao() == NULL) || ($this->getdescricao() == "")){

			//$_SESSION["categoria"] = $this->getcategoria();
			//$_SESSION["descricao"] = $this->getdescricao();

			//
			Categoria::setMsgErro("Preencha os Campos do Formulario!");

			return;
			exit;

		}

		$resultado = Categoria::verificaSeExiste((string)$this->getcategoria(), (int)$this->getid_categoria());

		if($resultado != 0){

			//$_SESSION[Categoria::ERRO] = "A Categoria " . ucwords(trim($this->getcategoria())) . " ja Existe!";
			Categoria::setMsgErro("A Categoria " . ucwords(trim($this->getcategoria())) . " ja Existe!");

			return;
			exit;
		}

		$sql = new Sql();

		$sql->query("
			UPDATE tb_categorias SET 
			categoria = :categoria, 
			descricao = :descricao 
			WHERE 
			id_categoria = :id_categoria;
		", array(
			":id_categoria"=>(int)$this->getid_categoria(), 
			":categoria"=>ucwords(trim($this->getcategoria())), 
			":descricao"=>ucwords(trim($this->getdescricao())) 
		));

		//$_SESSION[Categoria::SUCESSO] = "Categoria Alterada com Sucesso!";
		Categoria::setMsgSucesso("Categoria Alterada com Sucesso!");

	}

	public static function excluir(int $id_categoria){

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

		//$_SESSION["msg"] = "Categoria Excluida com Sucesso!";
		Categoria::setMsgSucesso("Categoria Excluida com Sucesso!");

	}

	public static function retornaDados(int $id_categoria){

		$categoria = Categoria::pegaCategoriaPorID($id_categoria);

		return $categoria;

	}

	//
	public static function setMsgErro($msg){

		$_SESSION[Categoria::ERRO] = $msg . " - VIA FUNCTION ! ! !";

	}

	public static function getMsgErro(){

		$msg = (isset($_SESSION[Categoria::ERRO]) && $_SESSION[Categoria::ERRO]) ? $_SESSION[Categoria::ERRO] : "";

		Categoria::clearMsgError();

		return $msg;

	}

	public static function clearMsgError(){

		$_SESSION[Categoria::ERRO] = NULL;

	}

	//
	public static function setMsgSucesso($msg){

		$_SESSION[Categoria::SUCESSO] = $msg . " - VIA FUNCTION ! ! !";

	}

	public static function getMsgSucesso(){

		$msg = (isset($_SESSION[Categoria::SUCESSO]) && $_SESSION[Categoria::SUCESSO]) ? $_SESSION[Categoria::SUCESSO] : "";

		Categoria::clearMsgSucesso();

		return $msg;

	}

	public static function clearMsgSucesso(){

		$_SESSION[Categoria::SUCESSO] = NULL;

	}


}

?>