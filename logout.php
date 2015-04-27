<?php
require_once("system.php");

if(isset($_COOKIE["login"])){
	$cookie = $_COOKIE["login"];

	$db = PDO_prepare("DELETE FROM `table:session` WHERE `cookie`=?");
	$db->bindValue(1, $cookie, PDO::PARAM_STR);
	try{
		$db->execute();
	}catch(PDOException $e){
		die("SQL ERROR: " . $e->getMessage());
	}

	setcookie("login",null,-1,$config["session"]["cookie_path"],$config["session"]["domain"],false,true);
}

if(isset($_GET["continue"])){
	if(checkURL($_GET["continue"])){
		header("Location: ".$_GET["continue"]);
	}else {
		$E["msg"]="Blocked link. ";
		require("template/blank.php");
	}
}else {
	header("Location: index.php");
}