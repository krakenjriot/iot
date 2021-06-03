<?php
<<<<<<< HEAD
include ("functions.php");
include ("dbconnect.php");

echo "<pre>";
echo "timestamp: " . date('Y-m-d H:i:s') . "</br>";
echo "</pre>";

$server_ip = "";
$url = "";
$parse = "";
$root_url = "";
$web_service_s = "";
$web_page_s = "";
$monitor_msg = "";

$sql = "SELECT * FROM tbl_servers WHERE active = 1 ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    // output data of each row
    while ($row = mysqli_fetch_assoc($result))
    {
        $server_ip = $row['server_ip'];
        $server_name = $row['server_name'];
        $url = "http://$server_ip/portty/";
        $parse = parse_url($url);
        $root_url = "http://" . $parse['host'];

        //echo $row['server_ip']."</br>";
        //echo $server_name."</br>";
        //echo $root_url."</br>";
        //echo "check_root_url_reachable ".check_root_url_reachable($root_url)."</br>";
        //echo "check_root_url_reachable ".check_root_url_reachable("http://192.168.100.55")."</br>";
        

        if (check_root_url_reachable($root_url))
        {
            //echo "test</br>";
            $sql = "UPDATE tbl_servers SET  active = 1 , web_service = 1 WHERE server_ip = '$server_ip' ";
            $conn->query($sql);

            if (check_url_page_reachable($root_url))
            {
                $sql = "UPDATE tbl_servers SET  web_page = 1 WHERE server_ip = '$server_ip' ";
                $conn->query($sql);
				
				check_monitor();				

            }
            else
            {
                $sql = "UPDATE tbl_servers SET  web_page = 0 WHERE server_ip = '$server_ip' ";
                $conn->query($sql);
            }

        }
        else
        {
            echo "test</br>";
            $sql = "UPDATE tbl_servers SET  active = 0 , web_service = 0, web_page = 0 WHERE server_ip = '$server_ip' ";
            $conn->query($sql);
        }

    } //while
    
}
else
{
    echo "<pre>";
    echo "no active servers available";
    echo "</pre>";
}



//DISPLAY STATUS SERVERS
$sql = "SELECT * FROM tbl_servers ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $server_name = $row['server_name'];
        $server_ip = $row['server_ip'];
        $web_service = $row['web_service'];
        $web_page = $row['web_page'];

        echo "<pre>";
        echo "***************** server status ******************</br>";
        echo "server_name name: $server_name</br>";
        echo "server_ip: $server_ip</br>";
        if ($web_service)
        {
            echo "web_service <i  style='background-color:MediumSeaGreen;'>running</i></br>";
        }
        else
        {
            echo "web_service <i  style='background-color:Tomato;'>stopped</i></br>";
        }
        if ($web_page)
        {
            echo "web_page <i  style='background-color:MediumSeaGreen;'>running</i></br>";
        }
        else
        {
            echo "web_page <i  style='background-color:Tomato;'>stopped</i></br>";
        }
        echo "**************************************************</br>";
        echo "</pre>";
    }
} //


//DISPLAY STATUS BOARDS
$sql = "SELECT * FROM tbl_boards ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        $board_name = $row['board_name'];
        $server_name = $row['server_name'];
        $monitor = $row['monitor'];

        echo "<pre>";
        echo "***************** board status ******************</br>";
        echo "board_name: $board_name</br>";
        echo "server_name: $server_name</br>";

        if ($monitor)
        {
            echo "porttymon.exe process <i  style='background-color:MediumSeaGreen;'>running</i></br>";
        }
        else
        {
            echo "porttymon.exe process <i  style='background-color:Tomato;'>stopped</i></br>";
        }
        echo "*************************************************</br>";
        echo "</pre>";
    }
} //


mysqli_close($conn);
=======




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
	
>>>>>>> d64ecdc97dd7f6a15e89416c7874694e63949b22

?>
