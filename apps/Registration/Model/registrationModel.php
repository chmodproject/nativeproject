<?php
Class registrationModel extends Model
{
	function __construct() 
	{
 		
	}

	public function checkId($id)
	{
		return $this->check('guest_registration','personal_id',$id);		
	}
}