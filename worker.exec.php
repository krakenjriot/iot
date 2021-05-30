<?php


	include("dbconnect.php");
	



			echo "<pre>";
			echo "Server Status</br>";
			echo "Server 192.168.100.88 offline </br>";
			echo "Server 192.168.100.33 online </br>";
			echo "</br>";
			
			echo "Board Staus</br>";
			echo "Board myboard1 offline </br>";
			echo "Board myboard2 online </br>";
			echo "</br>";
			
			echo "porrtymon monitor status</br>";
			echo "porttymon for myboard1 offline </br>";
			echo "porttymon for myboard2 online </br>";
			
			

			echo "</pre>";




	
	
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
			$board_name = $row['board_name'];	
			$conf_dir = $row['conf_dir'];	
			$server_timezone = $row['server_timezone'];	
			$pins = $row['pins'];	
			//$url = $row['url'];	
			
			
			//-------------------------------------------------
			//-------------------------------------------------
			//-------------------------------------------------
			//-------------------------------------------------
		
			
			
			$url = "http://". $server_ip . "/portty/api/?b=$board_name&p=$pins&conf_dir=$conf_dir&tz=$server_timezone";
			
			//$response = file_get_contents($url);	
			
			
			$ctx = stream_context_create(['http'=> ['timeout' => 5]]); // 5 seconds
			$response = @file_get_contents($url,null,$ctx);
			//echo $content;
			
			//??????????????????????
			//if($response == "") $active = 1;
			//else $active = 0;
			
			
			//echo "$response dddd" . $response . "</br>";
			
			
			
			//update_url($server_ip, $p, $b, $conf_dir);
			
			//check key present in content
			$confirmation_key = "0ld7vcxm72c2g3yz";
			// Test if string contains the word 
			if(strpos($response, $confirmation_key) !== false){
				echo "<h1>Worker $board_name $server_ip is running!</h1>";
				echo $response;
				//update web server status				
				$active = 1;
			} else {
				echo "<h1>Worker $board_name $server_ip is not running!</h1>";
				echo $response;
				//update web server status
				$active = 0;
			}
			

			
			


			//if dht file is not existing
			if(strpos($response, ".dht") !== false){
				echo "</br><b><h3>*</b><i>verify porttymon.exe for board $board_name is running</i></h3></br>";
			} //





















			
			
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
			
			
			if($response == ""){			
				$response_arr= "";
				$temp = "";
				$hum = "";
				$board_name = "";
				$dt = "";					
			} else {
				$response_arr=str_getcsv($response);
				$temp = $response_arr[2];
				$hum = $response_arr[3];
				$board_name = $response_arr[0];
				$dt = $response_arr[1];					
			}
			
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
