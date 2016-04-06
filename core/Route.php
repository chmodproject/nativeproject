<?php
Class route
{
	public $cont;
	public $routes=[];
	function __construct() {

		$this->routes();
		$page=(isset($_GET['url']))?ucfirst($_GET['url']):DEFAULTPAGE;

		if($this->checkRoutes($page)){

			$app=$this->getApp($page);
			$route=[];
			$route=explode("@",$app);
			$controller=$route[0];
			$method=$route[1];

			$controllerFile=ROOTDIR."/apps/".$controller."/controller/".$controller.".php";

			if(file_exists($controllerFile)){
				include($controllerFile);
				$this->cont=new $controller();

				if(method_exists($this->cont,$method)){ 
					$this->cont->$method();
				}else{
					echo "error:method";
				}
			}else{
				echo "error:controller";
			}	
		}else{
			echo "error:route";
		}		
	}

	public function routes(){
		$this->addRoutes("Register","Registration@registrationPage");
		$this->addRoutes("Save","Registration@save");
		
	}

	public function addRoutes($url,$cont){
		$this->routes[$url]=$cont;
	}

	public function checkRoutes($url){
		if(array_key_exists($url, $this->routes)){
			return true;
		}else{
			return false;
		}
	}
	public function getApp($url){
		return $this->routes[$url];
	}
}