<?php 

namespace Vendor;

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

		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		/*
		$parte_final_path = $_SERVER["SCRIPT_NAME"];
		$pos = strripos($parte_final_path, "/");
		$parte_final_path = substr($parte_final_path, 0, $pos);

		$path = $_SERVER["DOCUMENT_ROOT"] . $parte_final_path;

		$path_views = $path . $tpl_dir;
		$path_views_cache = $path . "/views-cache/";

		$path_views = str_replace("//", "/", $path_views);
		$path_views_cache = str_replace("//", "/", $path_views_cache);

		//echo("<br>**********<br><b>DOCUMENT_ROOT:</b> " . $_SERVER["DOCUMENT_ROOT"]);
		//echo("<br><b>SCRIPT_NAME:</b> " . $_SERVER["SCRIPT_NAME"] . "<br>**********<br>");
		*/
		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		$path_views = $_SERVER["DOCUMENT_ROOT"] . $tpl_dir;
		$path_views_cache = $_SERVER["DOCUMENT_ROOT"] . "/views-cache/";
		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
		//echo("<br>DIRECTORY SEPARATOR: " . DIRECTORY_SEPARATOR . "<br>");

		//echo("<br>views: " . $path_views . "<br>");
		//echo("<br>views-cache: " . $path_views_cache . "<br>");
		//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX

		// config
		$config = array(
			"tpl_dir" => $path_views, 
			"cache_dir" => $path_views_cache, 
			"debug" => true // set to false to improve the speed
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
?>