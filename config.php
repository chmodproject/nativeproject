<?php
Class config{
	private $conf=[];
	function __construct(){

		$this->config['database']['dbname']="test";
		$this->config['database']['servername']="localhost";
		$this->config['database']['username']="root";
		$this->config['database']['password']="root";
	}

	public function getConf($key=null){
		if($key){
			return $this->config[$key];
		}
	}
}