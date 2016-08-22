<?php
function sql($sql,$dbName='')
	{	
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS)
				or die("<p class='text-danger bg-danger' >Could not connect: " . mysqli_error()."</p>");
	 	if($dbName=='')
			{$dbName=DB_NAME;}
		mysqli_select_db($link,$dbName) or die ('<p class="text-danger bg-danger" >Can\'t select database : ' . mysqli_error()."</p>");
			 
		$result = mysqli_query($link,$sql)
				or die("<p class='text-danger bg-danger' >Could not query:" . mysqli_error()."</p>");
		return $result;
	}
?>
