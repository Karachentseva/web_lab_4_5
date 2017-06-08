<?php
	$users = array(
		"sashakarachentsev" => "1111"
	);

	function is_match($key, $value)
	{
		global $users;
		return $users[$key] == $value;
	}
?>