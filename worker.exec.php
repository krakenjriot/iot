<?php
	include("dbconnect.php");
	/******************************************/
	/******************************************/	
	$server_ip = "192.168.100.55";
	$p = "00000000000000000001";
	$conf_dir = "c:\portty\conf";
	$b = "myboard3";
	
	$url = "http://". $server_ip . "/porrty/api/?b=$b&p=$p&conf_dir=$conf_dir";
	$content = file_get_contents($url);	
	//echo $content;
	
	if($content == 100) {
		echo "worker is running";
		//update web server status
		$active = 1;
	}
	else {
		echo "worker is not running";
		//update web server status
		$active = 0;
	}
	
	$sql = "UPDATE tbl_servers SET ". 
	" active = '$active' ".  
	"WHERE server_ip = '$server_ip' ";
  
	if ($conn->query($sql) === TRUE) {
	  //	
	} 

  
	/******************************************/
	/******************************************/
	
	


	
	

?>
