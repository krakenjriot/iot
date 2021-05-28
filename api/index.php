<?php

	if(isset($_GET['p']) && $_GET['b']){
		$p = $_GET['p'];
		$b = $_GET['b'];
		$conf_dir = $_GET['conf_dir'];					
		file_put_contents($conf_dir ."\\". $b .".output", $p);
	}
	
	$new_datetime = date("H:i:s");
	echo 100;

?>