<?php

Class Core 
{

	private $mdl;
	private $vw;

	function __construct() {
		$this->mdl=new model();
		$this->vw=new view();
	}

	public function View($module,$filename,$data=[],$return=false){

		if($module){
			$viewFile=ROOTDIR."/apps/".$module."/View/".$filename.".html";
		}else{
			$viewFile=ROOTDIR."/assets/html/layout/".$filename.".html";
		}
		
		if(file_exists($viewFile)){  
			$html=file_get_contents($viewFile); 
			
			foreach ($data as $key => $value) {
				$html=preg_replace("/{".$key."}/", $value, $html);
			}
			
			if($return){
				return $html;
			}else{
				echo $html;
			}
		}
	}

	public function Library($libname){
		$viewFile=ROOTDIR."/library/".$libname.".php";

		if(file_exists($viewFile)){
			include($viewFile);
			$cont=new $libname();
			return $cont;
		}
	}

	public function Model($module,$filename){
		$viewFile=ROOTDIR."/apps/".$module."/Model/".$filename.".php";

		if(file_exists($viewFile)){
			include($viewFile);
			$cont=new $filename();
			$cont->connect();
			return $cont;
		}else{
			echo "model error";
		}
	}

	public function Render($module,$viewname,$data=[]){
		$data['title']=TITLE;
		$data['copyright']=COPYRIGHT;
		$data['cssbootstrap']=CSSBOOTSTRAP;
		$data['jsbootstrap']=JSBOOTSTRAP;
		$data['jsvalidator']=JSVALIDATOR;
		$data['myjs']=JS;
		$data['mycss']=CSS;
		$this->View(false,"header",$data);
		$this->View($module,$viewname,$data);
		$this->View(false,"footer",$data);
	}

}