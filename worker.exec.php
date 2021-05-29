<?php




	include("dbconnect.php");
	
	
	
	  //create board list   
	  $sql = "SELECT * FROM tbl_url ";
	  $result = mysqli_query($conn, $sql);  

			$server_ip = "";	
			$url = "";	
	  
	  if (mysqli_num_rows($result) > 0) 
	  {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$server_ip = $row['server_ip'];	
			$url = $row['url'];	
			//-------------------------------------------------
			//-------------------------------------------------
			//-------------------------------------------------
			//-------------------------------------------------
		
			
			
			//$url = "http://". $server_ip . "/portty/api/?b=$b&p=$p&conf_dir=$conf_dir";
			$response = file_get_contents($url);	
			//echo $content;
			
			
			
			
			
			
			//update_url($server_ip, $p, $b, $conf_dir);
			
			//check key present in content
			$confirmation_key = "0ld7vcxm72c2g3yz";
			// Test if string contains the word 
			if(strpos($response, $confirmation_key) !== false){
				echo "<h1>Worker is running!</h1>";
				echo $response;
				//update web server status				
				$active = 1;
			} else{
				echo "<h1>Worker is not running!</h1>";
				echo $response;
				//update web server status
				$active = 0;
			}			
			
			$sql = "UPDATE tbl_servers SET ". 
			" active = '$active' ".  
			"WHERE server_ip = '$server_ip' ";
		  
			if ($conn->query($sql) === TRUE) {
			  //	
			}  
			
			
			$sql = "UPDATE tbl_url SET ". 
			" response = '$response' ".  
			"WHERE server_ip = '$server_ip' ";
		  
			if ($conn->query($sql) === TRUE) {
			  //	
			} 			
			
			
			
			//$dt = date("H:i:s");
			$response_arr= str_getcsv($response);
			$temp = $response_arr[2];
			$hum = $response_arr[3];
			$board_name = $response_arr[0];
			$dt = $response_arr[1];	
			
			$sql = "INSERT INTO tbl_dht (temp, hum, dt, board_name)
			VALUES ('$temp', '$hum', '$dt', '$board_name')";
			$conn->query($sql);	
			

			  $sql = "UPDATE tbl_boards SET ".			  
			  " temp = '$temp', ".			
			  " hum = '$hum' ".				  
			  " WHERE board_name = '$board_name' ";
			  $conn->query($sql);
			 
			
			//-------------------------------------------------
			//-------------------------------------------------
			//-------------------------------------------------
		}//while
	  }//if mysqli_num_rows	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

			//--------------------------------------
			  /*
			  server_desc
			  server_ip
			  server_location
			  server_timezone
			  htdocs_dir
			  conf_dir		
			  */						
			/******************************************/
			/******************************************/	

			
			
			/******************************************/
			/******************************************/	
	

?>
