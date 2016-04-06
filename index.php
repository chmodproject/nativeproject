<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
session_start();
define("ROOTDIR", $_SERVER['DOCUMENT_ROOT']);
include("bootstrap.php");

if(DEBUGMODE){
	var_dump($_GET);
	var_dump($_POST);
}

$route=new route();
exit;