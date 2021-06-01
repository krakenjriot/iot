<?php

		include("functions.php");	
		include("dbconnect.php");
		
	$server_ip = ""; 		
	$url = 	"";	
	$parse = "";	
	$root_url = "";		
	$web_service_s = "";
	$web_page_s = "";		

		echo "<pre>";			
		echo "timestamp: ".date('Y-m-d H:i:s')."</br>";			
		echo "</pre>";	

	  //CHECK BASED URL AND PAGE STATUS  
	  $sql = "SELECT * FROM tbl_servers ";
	  $result = mysqli_query($conn, $sql); 
	  if (mysqli_num_rows($result) > 0) 
	  {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$server_ip = $row['server_ip'];	
			$url = "http://$server_ip/portty/";
			$parse = parse_url($url); 
			$root_url = "http://" . $parse['host'];					
						
			if (check_root_url_reachable($root_url)){			
				echo "<pre>";	
				echo "*************** web server status ***************</br>";			
				echo "server: $server_ip</br>";
				echo "web service <i  style='background-color:MediumSeaGreen;'>running</i></br>";				 

				$web_service_s = 1;	
				///////////////////////////////////////////////
				$sql = "UPDATE tbl_servers SET ". 
				" web_service = 1 ".  
				"WHERE server_ip = '$server_ip' ";
				$conn->query($sql);
				///////////////////////////////////////////////					
				if(check_url_page_reachable($url)){				
					echo "web page <i  style='background-color:MediumSeaGreen;'>running</i></br>";	
					echo "*************************************************</br>";		
					echo "</pre>";	
					$web_page_s = 1;	
					///////////////////////////////////////////////
					$sql = "UPDATE tbl_servers SET ". 
					" web_page = 1 ".  
					"WHERE server_ip = '$server_ip' ";
					$conn->query($sql);
					///////////////////////////////////////////////	
				} else {
					echo "web page <i  style='background-color:Tomato;'>stopped</i></br>";	
					echo "*************************************************</br>";		
					echo "</pre>";	
					$web_page_s = 0;	
					///////////////////////////////////////////////
					$sql = "UPDATE tbl_servers SET ". 
					" web_page = 0 ".  
					"WHERE server_ip = '$server_ip' ";
					$conn->query($sql);
					///////////////////////////////////////////////						
				}
			} else {
				echo "<pre>";	
				echo "*************** web server status ***************</br>";				
				echo "server: $server_ip</br>";	
				echo "web service <i  style='background-color:Tomato;'>stopped</i></br>";	
				echo "web page <i  style='background-color:Tomato;'>stopped</i></br>";					
				echo "*************************************************</br>";		
				echo "</pre>";				
				$web_service_s = 0;
				$web_page_s = 0;
				///////////////////////////////////////////////
				$sql = "UPDATE tbl_servers SET ". 
				" web_service = 0, ".  
				" web_page = 0 ".  
				"WHERE server_ip = '$server_ip' ";
				$conn->query($sql);
				///////////////////////////////////////////////					
			}	
		}//while
	  }//if

	

	  //create board list   
	  $sql = "SELECT * FROM tbl_url ";
	  $result = mysqli_query($conn, $sql);  

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
			
							//echo "$board_name,$dt,$dht_csv,0ld7vcxm72c2g3yz,$server_timezone,$monitor";
							$url = "http://". $server_ip . "/portty/api/?board_name=$board_name&pins=$pins&conf_dir=$conf_dir&server_timezone=$server_timezone&htdocs_dir=$htdocs_dir&board_refresh_sec=$board_refresh_sec";
							//$url = "http://". $server_ip . "/portty/api/?b=$board_name&p=$pins&conf_dir=$conf_dir&server_timezone=$server_timezone";
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
							
							//echo "response ".$response."</br>";
							//echo "monitor ".$monitor."</br>";
							//echo "response_arr ".$response_arr[6]."</br>";
							
							if($monitor){
								$monitor_msg = 1;	
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
							} else {
								$monitor_msg = 0;								
							}
								///////////////////////////////////////////////
								$sql = "UPDATE tbl_boards SET ". 
								" monitor = $monitor ".  
								"WHERE board_name = '$board_name' ";
								$conn->query($sql);
								///////////////////////////////////////////////
						
						//myboard1,02:34:08,30.70,12.00,0ld7vcxm72c2g3yz,Asia/Manila
						

							///////////////////////////////////////////////
							///////////////////////////////////////////////		

				if($monitor_msg) {
					
					echo "<pre>";	
					echo "***************** board status ******************</br>";		
								
					echo "server: $server_ip</br>";	
					echo "board: $board_name</br>";	
					echo "porttymon.exe process <i  style='background-color:MediumSeaGreen;'>running</i></br>";					
					echo "*************************************************</br>";
					echo "</pre>";
				} else {
					echo "<pre>";	
					echo "***************** board status ******************</br>";							
					echo "server: $server_ip</br>";	
					echo "board: $board_name</br>";	
					echo "porttymon.exe process <i  style='background-color:Tomato;'>stopped</i></br>";				
					echo "*************************************************</br>";
					echo "</pre>";	
				}//	

			}//	server_ip empty
			
		
			

	
			
			
		}//while
		
	  }//if (mysqli_num_rows
	   
	mysqli_close($conn);
	   
	   
	   
?>













									