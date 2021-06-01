<?php


function update_list($board_name){

	$server_ip = "";
	$conf_dir = "";
	$htdocs_dir = "";
	$board_refresh_sec  = "";
	$server_timezone = "";
	$pins = "";	
	$server_name = "";	
	$response = "";
	$url = "";
	
	include("dbconnect.php");
	//get pins	
	$sql = "SELECT * FROM tbl_pins WHERE board_name = '$board_name' ORDER BY pin_num ASC";	
	$result = mysqli_query($conn, $sql);  

	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$pins .= $row['active'];
		}
	} 
	
	echo "pins ".$pins."</br>";
	
	//get server name
	$sql = "SELECT * FROM tbl_boards WHERE board_name = '$board_name' ";	
	$result = mysqli_query($conn, $sql);  
	
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$server_name = $row['server_name'];
			$board_refresh_sec = $row['refresh_sec'];
		}
	} 	

	echo "server_name ".$server_name."</br>";
	
	//get server ip
	$sql = "SELECT * FROM tbl_servers WHERE server_name = '$server_name' ";	
	$result = mysqli_query($conn, $sql);  

	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$server_ip = $row['server_ip'];
			$conf_dir = addslashes($row['conf_dir']);
			$htdocs_dir = addslashes($row['htdocs_dir']);
			$server_timezone = $row['server_timezone'];
		}
	}
	
	echo "server_ip ".$server_ip."</br>";
	echo "conf_dir ".$conf_dir."</br>";
	echo "server_timezone ".$server_timezone."</br>";

	$url = "http://". $server_ip . "/portty/api/?board_name=$board_name&pins=$pins&conf_dir=$conf_dir&server_timezone=$server_timezone&htdocs_dir=$htdocs_dir&board_refresh_sec=$board_refresh_sec";
	
	echo "url ".$url."</br>";	
	//check if server ip is present if not insert
	//$sql = "SELECT * FROM tbl_url WHERE board_name = 'myboard1' ";	
	$sql = "SELECT * FROM tbl_url WHERE board_name = '$board_name' ";	
	$result = mysqli_query($conn, $sql);  
		
	if (mysqli_num_rows($result) > 0) 
	{
			//present perform update
			
			$sql = "UPDATE tbl_url SET ".	
			" url = '$url', ".	  
			" pins = '$pins', ".	  
			" server_ip = '$server_ip', ".	  
			" server_name = '$server_name', ".	  
			" htdocs_dir = '$htdocs_dir', ".	  
			" conf_dir = '$conf_dir', ".	  
			" server_timezone = '$server_timezone', ".	  
			" board_refresh_sec = '$board_refresh_sec', ".	  
			" response = '$response' ".	  
			"WHERE board_name = '$board_name' ";
			  
			if ($conn->query($sql) === TRUE) {
				//	  
			} 
	} 
	else 
	{
		//not present perform insert
		$sql = "INSERT INTO tbl_url (board_name, server_ip, url, pins, server_name, htdocs_dir, conf_dir, server_timezone, board_refresh_sec)
  		VALUES ('$board_name', '$server_ip', '$url', '$pins', '$server_name', '$htdocs_dir', '$conf_dir', '$server_timezone', '$board_refresh_sec')";
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
	$refresh_sec = "";
	$com_port =  "";
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			$server_name = $row['server_name'];
			$com_port = $row['com_port'];
			$refresh_sec = $row['refresh_sec'];
		}
	} 
	
	//get server ip
	$sql = "SELECT * FROM tbl_servers WHERE server_name = '$server_name' ";	
	$result = mysqli_query($conn, $sql);  
	//$server_ip = "";
	$conf_dir = "";
	
	if (mysqli_num_rows($result) > 0) 
		{
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			//$server_ip = $row['server_ip'];
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
	porttymon.exe $board_name $com_port $refresh_sec \n
	pause
	";	
	file_put_contents("batchfile\\$board_name.porttymon.bat", $batch_content);
	
} //update_url 




function check_url_page_reachable($url){
	
	//$url = "http://myservers.nwc.com.sa";
	$headers = @get_headers($url);
	if(strpos($headers[0],'404') === false)
	{
	  //echo "</br>web page is reachable!";
	  //set web page to online
	  return true;
	  
	}
	else
	{
	  //echo "</br>web page is not reachable!";
	  //set web page to offline
	  return false;
	}
	
}//

function check_conf_dir_exist($url){
	
}//

function check_htdocs_dir_exist($url){
	
}//



       //returns true, if domain is availible, false if not
       function check_root_url_reachable($url)
       {
               //check, if a valid url is provided
               if(!filter_var($url, FILTER_VALIDATE_URL))
               {
                       return false;
               }

               //initialize curl
               $curlInit = curl_init($url);
               //curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
               curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,5);
               curl_setopt($curlInit,CURLOPT_HEADER,true);
               curl_setopt($curlInit,CURLOPT_NOBODY,true);
               curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

               //get answer
               $response = curl_exec($curlInit);

               curl_close($curlInit);

               if ($response) return true;

               return false;
       }//




