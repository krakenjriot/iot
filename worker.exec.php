<?php
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

//GET ALL SERVERS
$sql = "SELECT * FROM tbl_servers WHERE active = 1";
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

        if (check_root_url_reachable($root_url))
        {
            $sql = "UPDATE tbl_servers SET  active = 1, web_service = 1 WHERE server_ip = '$server_ip' ";
            $conn->query($sql);
            if (check_url_page_reachable($root_url))
            {
                $sql = "UPDATE tbl_servers SET  web_page = 1 WHERE server_ip = '$server_ip' ";
                $conn->query($sql);
                //create board list
                $sql = "SELECT * FROM tbl_url ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0)
                {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        $server_ip = $row['server_ip'];
                        $board_name = $row['board_name'];
                        $htdocs_dir = $row['htdocs_dir'];
                        $exe_dir = $row['exe_dir'];
                        $server_timezone = $row['server_timezone'];
                        $pins = $row['pins'];
                        $board_refresh_sec = $row['board_refresh_sec'];

                        if (!empty($server_ip))
                        {
                            $url = "http://" . $server_ip . "/portty/api/?board_name=$board_name&pins=$pins&exe_dir=$exe_dir&server_timezone=$server_timezone&htdocs_dir=$htdocs_dir&board_refresh_sec=$board_refresh_sec";
                            $ctx = stream_context_create(['http' => ['timeout' => 5]]); // 5 seconds
                            $response = @file_get_contents($url, null, $ctx);

                            //echo $response."</br>";
                            if (!empty($response))
                            {
                                //myboard1,22:05:45,29.90,22.00,0ld7vcxm72c2g3yz,Asia/Riyadh,0
                                $response_arr = str_getcsv($response);
                                //$board_name2 = $response_arr[0];
                                $dt = $response_arr[1];
                                $temp = $response_arr[2];
                                $hum = $response_arr[3];
                                $hashed = $response_arr[4];
                                $tz = $response_arr[5];
                                $monitor = $response_arr[6];

                                //echo "exe_dir ".$exe_dir."</br>";
                                //echo "response ".$response."</br>";
                                //echo "monitor ".$monitor."</br>";
                                //echo "response_arr ".$response_arr[6]."</br>";
                                if ($monitor)
                                {
                                    $monitor_msg = 1;
                                    $sql = "INSERT INTO tbl_dht (temp, hum, dt, board_name)
											VALUES ($temp, $hum, '$dt', '$board_name')";
                                    $conn->query($sql);
                                    ///////////////////////////////////////////////
                                    $sql = "UPDATE tbl_boards SET " . " temp = $temp, " . " hum = $hum " . " WHERE board_name = '$board_name' ";
                                    $conn->query($sql);
                                    ///////////////////////////////////////////////
                                    
                                }
                                else
                                {
                                    $monitor_msg = 0;
                                }
                                ///////////////////////////////////////////////
                                $sql = "UPDATE tbl_boards SET " . " monitor = $monitor " . "WHERE board_name = '$board_name' ";
                                $conn->query($sql);
                                ///////////////////////////////////////////////
                                

                                
                            }
                            //myboard1,02:34:08,30.70,12.00,0ld7vcxm72c2g3yz,Asia/Manila
                            
                        }
                    }
                }
            }
            else
            {
                $sql = "UPDATE tbl_servers SET  web_page = 0 WHERE server_ip = '$server_ip' ";
                $conn->query($sql);
            }
        }
        else
        {
            //set web servce, page and active false
            $sql = "UPDATE tbl_servers SET  web_service = 0, web_page = 0, active = 0   WHERE server_ip = '$server_ip' ";
            $conn->query($sql);

            //get all boards in this server and set active to false
            $sql = "SELECT * FROM tbl_boards WHERE server_name = '$server_name' ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
            {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result))
                {
                    //update all boards to false
                    $sql = "UPDATE tbl_boards SET  active = 0 WHERE server_name = '$server_name' ";
                    $conn->query($sql);
                }
            }
        }
    }

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
					if($web_service){
						echo "web_service <i  style='background-color:MediumSeaGreen;'>running</i></br>";					
					} else {
						echo "web_service <i  style='background-color:Tomato;'>stopped</i></br>";					
					}
					if($web_page){
						echo "web_page <i  style='background-color:MediumSeaGreen;'>running</i></br>";					
					} else {
						echo "web_page <i  style='background-color:Tomato;'>stopped</i></br>";					
					}
						echo "**************************************************</br>";
						echo "</pre>";
                }
            }//


            //DISPLAY STATUS BOARDS
            $sql = "SELECT * FROM tbl_boards ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0)
            {                
                while ($row = mysqli_fetch_assoc($result))
                {
					$board_name = $row['board_name'];
					$server_name = $row['server_name'];
					$active = $row['active'];
					//$server_ip = $row['server_ip'];
					//$web_service = $row['web_service'];
					//$web_page = $row['web_page'];
					
					echo "<pre>";
					echo "***************** board status ******************</br>";
					echo "board_name: $board_name</br>";
					echo "server_name: $server_name</br>";
					
					
					if($active){
						echo "porttymon.exe process <i  style='background-color:MediumSeaGreen;'>running</i></br>";			
					} else {
						echo "porttymon.exe process <i  style='background-color:Tomato;'>stopped</i></br>";			
					}					
						echo "*************************************************</br>";
						echo "</pre>";
                }
            }//


















mysqli_close($conn);

?>
