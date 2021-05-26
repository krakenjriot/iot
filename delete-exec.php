<?php

	include("dbconnect.php");
	
	if(isset($_GET['server_name'])){
		$server_name = $_GET['server_name'];
		
		
		// sql to delete a record
		$sql = "DELETE FROM tbl_webservers WHERE server_name='$server_name'";

		if (mysqli_query($conn, $sql)) {
		  //echo "Record deleted successfully";
		  	header("location: ?p=4&webserverinfo=delete-server-success");
			exit();			  
		} else {
		  //echo "Error deleting record: " . mysqli_error($conn);
		  	header("location: ?p=4&webserverinfo=".mysqli_error($conn));
			exit();			  
		}

		mysqli_close($conn);
		
		
		
	} 

	
?>