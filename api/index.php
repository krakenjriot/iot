<?php
	if(isset($_GET['pins']) && $_GET['board_name']){
		$pins = $_GET['pins'];
		$board_name = $_GET['board_name'];
		$server_timezone = $_GET['server_timezone'];
		$htdocs_dir = $_GET['htdocs_dir'];					
		$conf_dir = $_GET['conf_dir'];					
		$board_refresh_sec = $_GET['board_refresh_sec'];					
		
		
		
		
		
		file_put_contents($conf_dir ."\\". $board_name .".output", $pins);		
		$dht_file = $conf_dir ."\\". $board_name .".dht";		
		
		if(!file_exists($dht_file)) {
			//touch($dht_file, "0,0");
			file_put_contents($dht_file, "0,0");	
		}
		
	
			//$file_last_modified = filemtime($dht_file); 
			//echo "</br>Last modified " . date("l, dS F, Y, h:ia", $file_last_modified)."\n";
		
			$diff = time()-filemtime($dht_file);
			
			//echo "diff ".$diff."</br>";
			//echo "</br>";
			//echo "board_refresh_sec ".$board_refresh_sec."</br>";
			
			//value is zero then set it to 3 secs
			//if(!$board_refresh_sec) $board_refresh_sec = 3;
			
			
			if($diff < $board_refresh_sec * 3){ // 10 seconds
				//echo "</br>porttymon for board ($board_name) is running";
				//return true;
				$monitor = 1;
			} else {
				//echo "</br>porttymon for board ($board_name) is not running";
				//return false;
				$monitor = 0;
			}			
				
			//echo "</br>";
			//echo "</br>"; 
			//echo "dht temp: ". $dht_arr[0]."</br>";
			//echo "dht hum: ". $dht_arr[1]."</br>";
			date_default_timezone_set($server_timezone);
			
			$dht_csv = file_get_contents($dht_file);
			$dt = date('Y-m-d H:i:s');
			
			//echo "</br>";
			//echo "</br>";
			//echo "return porttysen.exe input file";
			
			echo "$board_name,$dt,$dht_csv,0ld7vcxm72c2g3yz,$server_timezone,$monitor";				
			
	
	}
	
	
	/*
	$new_datetime = date("H:i:s");
	echo " [0ld7vcxm72c2g3yz] ";
	echo " [". $new_datetime . "] - Board Name: $b</br>";
	echo "todo list - create auto batch file for new add board</br>";
	echo "todo list - add com ports in add/edit board</br>";
	echo "todo list - add cascading links server -> boards -> pins with filter table</br>";
	echo "todo list - create board output if not present</br>";
	echo "todo list - settings to modal to add worker refresh rate</br>";
	*/
	
	
?>