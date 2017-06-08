<?php // test1.php
	require_once("actions/user.php");
	require_once("actions/data.php");
	require_once("utils/errors.php");
	require_once("utils/functions.php");
	require_once("internal/available-users.php");

	if(isset($_GET["action"]))
	{
		$action = $_GET["action"];
		if($action == "user")
			user();
		elseif($action == "data")
			data();
		else
			{
				$arr = array("action"=>null, "errormsg"=>"Unknown action");
				echo json_encode($arr);
			}
	}	
	else
	{
				$arr = array("action"=>null, "errormsg"=>"Action is not set");
				echo json_encode($arr);
	}
	
	
?>