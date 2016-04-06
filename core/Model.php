<?php

Class Model
{
	private $servername;
	private $username;
	private $password;
	private $dbname;
	public $conn;

	public function connect()
	{

		$conf=new config();
		$database=$conf->getConf('database');

		$this->servername=$database['servername'];
		$this->username=$database['username'];
		$this->password=$database['password'];
		$this->dbname=$database['dbname'];
		
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
		if ($this->conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}	
	}


	public function getAll($table_name)
	{
		$sql="select * from ".$table_name;
		return $this->conn->query($sql);
	} 

	public function update($data){

		$sql = "UPDATE songs SET name='".$data['name']."',artist='".$data['artist']."',album='".$data['album']."',genre='".$data['genre']."' WHERE id='".$data['id']."' AND owner_id='".$_SESSION['id']."'";
		$result = $this->conn->query($sql);
		if ($result) {
		    return true;
		}else{
			return false;
		} 
	}

	public function get($table_name,$data){
		$sql = "SELECT * FROM songs WHERE ".$data['key']."='".$data['value'];
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
		    return $result;
		}else{
			return false;
		} 
	}

	public function delete($table_name,$id){
		$sql = "DELETE FROM ".$table_name." WHERE id='".$id;
		$result = $this->conn->query($sql);
		if ($result) {
		    return true;
		}else{
			return false;
		} 
	}

	public function search($table_name,$columns,$data=array()){
		$sql = "SELECT * FROM ".$table_name." WHERE CONCAT_WS('', ".$columns.") LIKE '%".$data['search']."%'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
		    return $result;
		}else{
			return false;
		} 
	}
	
	public function countAll($table_name){
		$sql="select * from ".$table_name;
		return $this->conn->query($sql);
	} 

	public function save($table_name,$data){
		$columns=[];
		$values=[];

		if($table_name=="user"){
			$data['password'] = md5($data['password']);
			if($this->checkemail($data['email'])){
				return false;
			}	
		}
		
		foreach ($data as $key => $value) {
			$columns[]=$key;
			$values[]="'".$value."'";
		}

		$strcolumns = implode(",", $columns);
		$strvalues = implode(",", $values);
		$sql="INSERT INTO $table_name ($strcolumns) VALUES ($strvalues)";
		
		return $this->conn->query($sql);
	}

	public function check($tablename,$key,$value){
		$sql = "SELECT * FROM ".$tablename." WHERE ".$key."='".$value."'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
		    return true;
		}else{
			return false;
		} 
	}

	public function auth($data=array()){
		$email = $data['email'];
		$password = md5($data['password']);
		$sql = "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'";
		$result = $this->conn->query($sql);
		if ($result->num_rows > 0) {
		    return $result;
		}else{
			return false;
		} 
	} 

}