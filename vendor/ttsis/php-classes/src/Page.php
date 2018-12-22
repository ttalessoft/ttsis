<?php 

namespace ttsis;

use Rain\Tpl;

define("DIR_ROOT", "/Applications/XAMPP/htdocs/ttsis");

class Page {

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"data"=>[]
    ];

	public function __construct($opts = array(), $tpl_dir = "/views/"){
		
		$this->options = array_merge($this->defaults, $opts);

		$config = array(
			"tpl_dir"       => DIR_ROOT. $tpl_dir,
			"cache_dir"     => DIR_ROOT . "/views-cache/",
			"debug"         => false
	    );

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		if ($this->options["header"] === true) $this->tpl->draw("header");

	}

	private function setData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false)
	{

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		if ($this->options["footer"] === true) $this->tpl->draw("footer");

	}

}

 ?>