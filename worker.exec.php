<?php

		include("functions.php");	
		include("dbconnect.php");

		$service_msg = "";
		$page_msg = "";
		$monitor_msg = "";



	  //create board list   
	  $sql = "SELECT * FROM tbl_url ";
	  $result = mysqli_query($conn, $sql);  

			$server_ip = "";	
			$url = "";	
			$refresh_sec = "";
			
				$board_name = "";
				//$board_name2 = "";
				$dt = "";	
				$temp = "";
				$hum = "";
				$hashed = "";
				$tz = "";
				$monitor = "";	
				$response_arr= "";				
			
			
	  
	  if (mysqli_num_rows($result) > 0) 
	  {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			
			
			
			$server_ip = $row['server_ip'];	
			$board_name = $row['board_name'];	
			$htdocs_dir = $row['htdocs_dir'];	
			$conf_dir = $row['conf_dir'];	
			$server_timezone = $row['server_timezone'];	
			$pins = $row['pins'];	
			$board_refresh_sec = $row['board_refresh_sec'];	
			
			
			if(!empty($server_ip)){
			
						$url = "http://". $server_ip . "/portty/api/?board_name=$board_name&pins=$pins&conf_dir=$conf_dir&server_timezone=$server_timezone&htdocs_dir=$htdocs_dir&board_refresh_sec=$board_refresh_sec";
						
						
						$parse = parse_url($url);
						//echo "</br>host: ".$parse['host']; // prints 'google.com'    
						
						$root_url = "http://" . $parse['host'];	
								
						//echo "</br>root url: " . $root_url . "";
						//echo "</br>url: " . $url . "";
						//echo "</br>";
						//echo "</br>";
						//echo "</br>";
					   
					   if (check_root_url_reachable($root_url))
					   {
							   //echo "</br>web service in ($server_ip) is running!";	
								$service_msg = 1;
								//$page_msg = "";
								//$monitor_msg = "";
								///////////////////////////////////////////////
								$sql = "UPDATE tbl_servers SET ". 
								" web_service = 1 ".  
								"WHERE server_ip = '$server_ip' ";
								$conn->query($sql);
								///////////////////////////////////////////////


							   
							   //set web service to online			   
							   if(check_url_page_reachable($url)){
								   //echo "</br>web page in ($server_ip) is reachable!";
								   //echo "</br>";
								   $page_msg = 1;


								///////////////////////////////////////////////
								$sql = "UPDATE tbl_servers SET ". 
								" web_page = 1 ".  
								"WHERE server_ip = '$server_ip' ";
								$conn->query($sql);
								///////////////////////////////////////////////



								   
								   
									$ctx = stream_context_create(['http'=> ['timeout' => 5]]); // 5 seconds
									$response = @file_get_contents($url,null,$ctx);
									
							//"myboard1,22:05:45,29.90,22.00,0ld7vcxm72c2g3yz,Asia/Riyadh,0";
							///////////////////////////////////////////////
							///////////////////////////////////////////////
							///////////////////////////////////////////////						
							if(!empty($response)){
							//myboard1,22:05:45,29.90,22.00,0ld7vcxm72c2g3yz,Asia/Riyadh,0
							$response_arr=str_getcsv($response);
								//$board_name2 = $response_arr[0];
								$dt = $response_arr[1];	
								$temp = $response_arr[2];
								$hum = $response_arr[3];
								$hashed = $response_arr[4];
								$tz = $response_arr[5];
								$monitor = $response_arr[6];
							} else {
							    //$board_name2 = "";
								$dt = "";
								$temp = "";
								$hum = "";
								$hashed = "";
								$tz = "";
								$monitor = "";	
							}
							
							//echo "$response ".$response."</br>";
							//echo "monitor ".$monitor."</br>";
							//echo "monitor ".$response_arr[6]."</br>";
							
							if($monitor){
								$monitor_msg = 1;
								//echo "</br>porttymon.exe process for $board_name is running @($server_ip)";	
							} else {
								$monitor_msg = 0;
								//echo "</br>porttymon.exe process for $board_name is not running @($server_ip)";
							}
							


								///////////////////////////////////////////////
								$sql = "UPDATE tbl_boards SET ". 
								" monitor = $monitor ".  
								"WHERE board_name = '$board_name' ";
								$conn->query($sql);
								///////////////////////////////////////////////


						
						
						//myboard1,02:34:08,30.70,12.00,0ld7vcxm72c2g3yz,Asia/Manila
						
						$sql = "INSERT INTO tbl_dht (temp, hum, dt, board_name)
						VALUES ($temp, $hum, '$dt', '$board_name')";
						$conn->query($sql);	
						
							///////////////////////////////////////////////
							  $sql = "UPDATE tbl_boards SET ".			  
							  " temp = $temp, ".			
							  " hum = $hum ".				  
							  " WHERE board_name = '$board_name' ";
							  $conn->query($sql);
							///////////////////////////////////////////////
							///////////////////////////////////////////////
							///////////////////////////////////////////////
									
									
									
									
									
									
								   
								   //echo "</br>response ". $response;
								   
							   } else {
								   $page_msg = 0;
								   //echo "</br>web page in ($server_ip) is not reachable!";
							   }
					   }
					   else
					   {
						   //echo "</br>web service in ($server_ip) is not running!";
							$service_msg = 0;
							
								$sql = "UPDATE tbl_servers SET ". 
								" web_service = 0, ".  
								" web_page = 0 ".  
								"WHERE server_ip = '$server_ip' ";
								$conn->query($sql);

								$sql = "UPDATE tbl_boards SET ".				
								" monitor = 0 ".  
								"WHERE board_name = '$board_name' ";
								$conn->query($sql);					
								
								
						   //set web service to offline			   
						   //set web page unreachable
						   //set porttymon not running
					   }

			}//	
			
			
			
		echo "<pre>";		
		echo "************************************</br>";		
		echo "server: $server_ip</br>";
		echo "board: $board_name</br>";
		
		if($service_msg) {
			echo "web service running</br>";
		} else {
			echo "web service stopped</br>";
		}
		
		if($page_msg) {
			echo "web page running</br>";
		} else {
			echo "web page_msg stopped</br>";
		}		
		
		if($monitor_msg) {
			echo "porttymon.exe running</br>";
		} else {
			echo "porttymon.exe stopped</br>";
		}	
		echo "************************************</br>";		
		echo "</pre>";		
			
			
			
			
			
			
			
			
			
			
		}//while
		
	  }//if (mysqli_num_rows



		




	   
		mysqli_close($conn);
	   
	   
	   
?>