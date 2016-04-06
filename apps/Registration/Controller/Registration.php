<?php
Class Registration extends Core
{
	public $mod;

	function __construct()
	{
 		$this->mod=$this->Model("Registration","registrationModel");
	}

	public function registrationPage()
	{
		$data=[];

		$result=$this->mod->getAll('country');
		$data['country']="";
		$data['action']=WEBROOT."/index.php?url=save";
		if($result){
			while($row = $result->fetch_assoc()) { 
				$data['country'].='<option value="'.$row['country_code'].'">'.$row['country_name'].'</option>';
			}
		}

		$this->Render("Registration","registrationForm",$data);
	}

	public function save()
	{
		$post=$_POST;
		$data=[];

			if(!$this->mod->checkId($post['personal_id'])){
				if($this->mod->save('guest_registration',$post)){
				$data['message']="Registration successful!";
				$data['status']="Success:";
				$data['alert']="success";
			}
		}else{
			$data['message']="ID already exist!";
			$data['status']="Error:";
			$data['alert']="danger";
			
		}
		$this->Render("Registration","message",$data);
	}


}