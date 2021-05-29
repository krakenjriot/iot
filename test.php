<?php 
	include("dbconnect.php");
	include("functions.php");
	
	
	//$board_name = "board #1 lighting";
	
	//update_list($board_name);
	$server_ip = "192.168.100.55";
	$board_name = "myboard1";
	
	
	/*
	//get server ip
	$sql = "SELECT * FROM tbl_url WHERE server_ip = '$server_ip' ";	
	//$sql = "SELECT * FROM tbl_url WHERE board_name = '$board_name' ";	
	$result = mysqli_query($conn, $sql);  
	$server_ip = "";
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			echo "server_ip: ". $row['server_ip'] ."</br>";
			echo "url: ". $row['url'] ."</br>";
			echo "active: ". $row['active'] ."</br>";
			echo "response: ". $row['response'] ."</br>";
			echo "pins: ". $row['pins'] ."</br>";
			echo "server_name: ". $row['server_name'] ."</br>";
			echo "conf_dir: ". $row['conf_dir'] ."</br>";
		
			
			
		}
	}


	$sql = "SELECT * FROM tbl_pins WHERE board_name = '$board_name' ORDER BY pin_num ASC";	
	$result = mysqli_query($conn, $sql);  
	$pins = "";	
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$pins .= $row['active'];
		}
	} 
	
	echo "pins [$board_name]: $pins</br>";
	
	
	
	
	
	
	update_list($board_name); */
	
	
	create_batch_file_monitor($board_name);
	
	
	
?>