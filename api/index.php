<?php
	if(isset($_GET['p']) && $_GET['b']){
		$p = $_GET['p'];
		$b = $_GET['b'];
		$tz = $_GET['tz'];
		$conf_dir = $_GET['conf_dir'];					
		file_put_contents($conf_dir ."\\". $b .".output", $p);
		$dht_csv = file_get_contents($conf_dir ."\\". $b .".dht");
		
		
		
		
		//echo "</br>"; 
		//echo "dht temp: ". $dht_arr[0]."</br>";
		//echo "dht hum: ". $dht_arr[1]."</br>";
		date_default_timezone_set($tz);
		
		
		$new_datetime = date("H:i:s");
		echo "$b,$new_datetime,$dht_csv,0ld7vcxm72c2g3yz,$tz";

		
		
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