<?php


function update_list($board_name){
	  include("dbconnect.php");
	//get pins	
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
	
	//get server name
	$sql = "SELECT * FROM tbl_boards WHERE board_name = '$board_name' ";	
	$result = mysqli_query($conn, $sql);  
	$server_name = "";	
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$server_name = $row['server_name'];
		}
	} 	
	
	//get server ip
	$sql = "SELECT * FROM tbl_servers WHERE server_name = '$server_name' ";	
	$result = mysqli_query($conn, $sql);  
	$server_ip = "";
	$conf_dir = "";
	$server_timezone = "";
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$server_ip = $row['server_ip'];
			$conf_dir = addslashes($row['conf_dir']);
			$server_timezone = $row['server_timezone'];
		}
	}
	
	
	


	$url = "http://". $server_ip . "/portty/api/?b=$board_name&p=$pins&conf_dir=$conf_dir&tz=$server_timezone";	
	$response = "";
	
	//check if server ip is present if not insert
	//$sql = "SELECT * FROM tbl_url WHERE board_name = 'myboard1' ";	
	$sql = "SELECT * FROM tbl_url WHERE board_name = '$board_name' ";	
	$result = mysqli_query($conn, $sql);  
		
	if (mysqli_num_rows($result) > 0) 
	{
			//present perform update
			
			$sql = "UPDATE tbl_url SET ".	  
			//" board_name = '$board_name', ".	  
			" url = '$url', ".	  
			" pins = '$pins', ".	  
			" server_ip = '$server_ip', ".	  
			" server_name = '$server_name', ".	  
			" conf_dir = '$conf_dir', ".	  
			" server_timezone = '$server_timezone', ".	  
			" response = '$response' ".	  
			"WHERE board_name = '$board_name' ";
			  
			if ($conn->query($sql) === TRUE) {
				//	  
			} 
	} 
	else 
	{
		//not present perform insert
		$sql = "INSERT INTO tbl_url (board_name, server_ip, url, pins, server_name, conf_dir, server_timezone)
  		VALUES ('$board_name', '$server_ip', '$url', '$pins', '$server_name', '$conf_dir', '$server_timezone')";
  		$conn->query($sql);		
	}



	/*
	echo  "pins :" 		.	$pins. "</br>";
	echo  "server_name :" .	$server_name. "</br>";
	echo  "server_ip :" 	.	$server_ip. "</br>";
	echo  "conf_dir :" 	.	$conf_dir. "</br>";
	*/
		
	  
	  
} //update_url 



/*
c:
cd $confi_dir
C:\portty>porttymon.exe myboard1 com10 3




*/


function create_batch_file_monitor($board_name){
	include("dbconnect.php");
	
	//get server name
	$sql = "SELECT * FROM tbl_boards WHERE board_name = '$board_name' ";	
	$result = mysqli_query($conn, $sql);  
	$server_name = "";	
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$server_name = $row['server_name'];
			$com_port = $row['com_port'];
		}
	} 
	
	//get server ip
	$sql = "SELECT * FROM tbl_servers WHERE server_name = '$server_name' ";	
	$result = mysqli_query($conn, $sql);  
	$server_ip = "";
	$conf_dir = "";
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$server_ip = $row['server_ip'];
			$conf_dir = addslashes($row['conf_dir']);
		}
	}	
	$batch_content = "
	\n
	c: \n
	cd $conf_dir \n
	rem del /q /f $board_name.output \n
	cd ..
	rem timeout /t 5 /nobreak
	porttymon.exe $board_name $com_port 3 \n
	pause
	";	
	file_put_contents("batchfile\\$board_name.porttymon.bat", $batch_content);
} //update_url 









