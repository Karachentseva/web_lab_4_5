<?php
	function user()
	{
		if(isset($_GET["method"]))
		{
			$method = $_GET["method"];
			if($method == "login")
				login();
			elseif($method == "logout")
				logout();
			else
			{
				$arr = array("method"=>null, "errormsg"=>"Unknown method");
				echo json_encode($arr);
			}
		}
		else
		{
			$arr = array("method"=>null, "errormsg"=>"Method is not set");
			echo json_encode($arr);
		}
	}


	function logout()
	{
		if(isset($_GET["sessionid"]))
		{
			$file = $_GET["sessionid"].".txt";
			$dir = "internal/sessions/";
			if (file_exists($dir.$file))
			{
				unlink($dir.$file);
				$arr = array("errormsg"=>null);
				echo json_encode($arr);

			}
			else{
				$arr = array("errormsg"=>"Invalid Session ID");
				echo json_encode($arr);
			}
		}
		else
		{
			$arr = array("errormsg"=>"Session ID is not set");
			echo json_encode($arr);
		}
	}


	function login()
	{
		if(isset($_GET["username"]) && isset($_GET["password"]))
		{
			$username = $_GET["username"];
			$password = $_GET["password"];
			global $users;
			if(isset($users[$username]))
			{
				if(is_match($username, $password))
				{
					$id = generate_id();
					$file = $id.".txt";
					$dir = "./internal/sessions/";
					if (!file_exists($dir.$file)){
						$fIn = fopen($dir.$file, 'w');
						fwrite($fIn, $username);
						fclose($fIn);
					}
					$arr = array("sessionid"=>$id, "errormsg"=>null);
					echo json_encode($arr);
				}	
				else
				{
					$arr = array("sessionid"=>null, "errormsg"=>"Wrong password!");
					echo json_encode($arr);
				}
			}
			else
			{
				$arr = array("sessionid"=>null, "errormsg"=>"Wrong username!");
				echo json_encode($arr);
			}
			
		}
		else
		{
			$arr = array("sessionid"=>null, "errormsg"=>"User data is not set");
			echo json_encode($arr);
		}
	}


?>