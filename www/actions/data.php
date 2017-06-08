<?php
	function data()
	{
		if(isset($_GET["method"]))
		{
			$method = $_GET["method"];
			if($method == "get")
				get();
			elseif($method == "set")
				set();
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

	
	function set()
	{
		if(isset($_GET["sessionid"]) && isset($_GET["text"]))
		{
			$username = "";
			$id = $_GET["sessionid"];
			$text = $_GET["text"];
			$file = $id.".txt";
			$dir = "internal/sessions/";
			if (file_exists($dir.$file)){
				$fIn = fopen($dir.$file, 'r');
				$username = fgets($fIn);
				fclose($fIn);
				$file = $username.".txt";
				$dir = "internal/data/";
				if (file_exists($dir.$file)){
					$fIn = fopen($dir.$file, 'w');
					fwrite($fIn, $text);
					fclose($fIn);
				}
				$arr = array("errorMsg"=>null);
				echo json_encode($arr);
			}
			else{
				$arr = array("errorMsg"=>"Invalid Session ID");
				echo json_encode($arr);
			}
		}
		else
			{
				$arr = array("errorMsg"=>"Session ID is not set");
				echo json_encode($arr);
			}
	}


function get()
	{
		if(isset($_GET["sessionid"]))
		{
			$offset = (isset($_GET["offset"]))?$_GET["offset"]:1;
			$id = $_GET["sessionid"];
			$file = $id.".txt";
			$dir = "internal/sessions/";
			$username = "";
			if (file_exists($dir.$file))
			{
				$fIn = fopen($dir.$file, 'r');
				$username = fgets($fIn);
				fclose($fIn);
				$file = $username.".txt";
				$dir = "internal/data/";
				if (file_exists($dir.$file))
				{
					$fIn = fopen($dir.$file, 'r');
					$txt = false;
					for($i = 0;$i<$offset;$i++)
						$txt = fgets($fIn);
					$arr = array("text"=>$txt, "errormsg"=>null);
					echo json_encode($arr);
					fclose($fIn);
				}
				else
				{
					$arr = array("text"=>null, "errormsg"=>"Text is not set");
					echo json_encode($arr);

				}
			}
			else
			{
				$arr = array("text"=>null, "errormsg"=>"Invalid Session ID");
				echo json_encode($arr);
			}
		}
		else
			{
				$arr = array("text"=>null, "errormsg"=>"Session ID is not set");
				echo json_encode($arr);
			}
	}



?>