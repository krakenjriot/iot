<?php

	include("dbconnect.php");
	
	if(isset($_GET['board_name'])){
		$board_name = $_GET['board_name'];
		
		
		// sql to delete a record
		$sql = "DELETE FROM tbl_boards WHERE board_name='$board_name'";

		if (mysqli_query($conn, $sql)) {
		  //echo "Record deleted successfully";
		  	//header("location: ?p=4&board_notif=delete-board-success");
			//exit();			  
		} 
		
		
		// sql to delete a record
		$sql = "DELETE FROM tbl_switches WHERE board_name='$board_name'";

		if (mysqli_query($conn, $sql)) {
		  //echo "Record deleted successfully";
		  	header("location: ?p=4&board_notif=delete-board-success");
			exit();			  
		} else {
		  //echo "Error deleting record: " . mysqli_error($conn);
		  	header("location: ?p=4&board_notif=".mysqli_error($conn));
			exit();			  
		}		

		mysqli_close($conn);
		
		
		
	} 

	
?>