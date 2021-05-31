<?php
if(isset($_GET['t_span'])) $t_span = $_GET['t_span'];
else $t_span = 0;

$title = "Temperature (ºC) / Humidity Graph (%)"; //degree symbol Alt+0186
$legend_sensor_name1 = "Temperature (ºC)";
$legend_sensor_name2 = "Humidity (%)";
$legend_time_name =  "Time";
//$number_of_samples =  "90000";
//$interval_span =  "60"; //mins

//if($t_span > $interval_span) $interval_span;
//else $interval_span = $t_span;

$interval_span = $t_span;

/*
{
  "cols":
			[
        {"id":"","label":"Time","pattern":"","type":"string"},
        {"id":"","label":"Temp","pattern":"","type":"number"},
        {"id":"","label":"Hum","pattern":"","type":"number"}
      ],
  "rows":
			[
        {"c":[{"v":4,"f":null},{"v":4,"f":null},{"v":3,"f":null}]},
        {"c":[{"v":5,"f":null},{"v":7,"f":null},{"v":9,"f":null}]}
      ]
}
*/
date_default_timezone_set("Asia/Riyadh");

echo '{
  "cols":
			[
        {"id":"","label":"Time","pattern":"","type":"datetime"},
        {"id":"","label":"'.$legend_sensor_name1.'","pattern":"","type":"number"},
        {"id":"","label":"'.$legend_sensor_name2.'","pattern":"","type":"number"}
      ],
  "rows":
			[';

//[new Date(2020,04,05,16,35,04), 1, 10.9],


$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_portty";

// Create DB connection
$conn = new mysqli($db_server, $db_user, $db_pass, $db_name);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$out = "";
$t_current = "";
$t_prev = "";
//$sql = " SELECT *  FROM tbl_sensors ORDER BY id DESC LIMIT 500 ";
//$sql = " SELECT *  FROM tbl_sensors WHERE dt BETWEEN '".date("Y-m-d H:i:s",strtotime("-$interval_span minutes"))."' AND '".date("Y-m-d H:i:s",strtotime("now"))."' ORDER BY id DESC LIMIT $number_of_samples ";
$sql = " SELECT *  FROM tbl_dht WHERE dt BETWEEN '".date("Y-m-d H:i:s",strtotime("-$interval_span minutes"))."' AND '".date("Y-m-d H:i:s",strtotime("now"))."' ORDER BY dt DESC ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $time = strtotime($row['dt']);
    $y = date("Y",$time); // year
    $mo = date("m",$time); //month
    $d = date("d",$time); //day
    $h = date("H",$time); // hour
    $m = date("i",$time); //minute
    //$s = date("s",$time); //second
    $t_current = $y.$mo.$d.$h.$m;
  }//while
}//if

$sql = " SELECT *  FROM tbl_dht WHERE dt BETWEEN '".date("Y-m-d H:i:s",strtotime("-$interval_span minutes"))."' AND '".date("Y-m-d H:i:s",strtotime("now"))."' ORDER BY dt DESC ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $time = strtotime($row['dt']);
    $y = date("Y",$time); // year
    $mo = date("m",$time); //month
    $d = date("d",$time); //day

    $h = date("H",$time); // hour
    $m = date("i",$time); //minute
    $s = date("s",$time); //second
    //$u = date("u",$time); //milliseconds

    $temp = $row['temp'];
    $hum = $row['hum'];
    $id = $row['id'];

    if($temp == 0) continue;
    if($hum == 0) continue;

    $t_prev = $t_current;
    $t_current = $y.$mo.$d.$h.$m;

    //echo "[new Date($y,$mo,$d,$h,$m,$s), $temp],";
    //echo "[new Date($y,$mo,$d,$h,$m,$s), $temp, $hum],";
    //$dt = "'new Date($y,$mo,$d)'";
    //$dt = "'2014-12-06T10:30:00-0800'";
    //$dt = "Date($time)";
    $dt = "Date($y,$mo,$d,$h,$m)";
    //echo '{"c":[{"v":'.$id.',"f":'null'},{"v":'.$temp.',"f":null},{"v":'.$hum.',"f":null}]},';
    //$out .=  '{"c":[{"v":'.$dt.',"f":"null"},{"v":'.$temp.',"f":null},{"v":'.$hum.',"f":null}]},';
    //if($s != "00") continue;
    //else $out .=  '{"c":[{"v":"'.$dt.'","2014-12-06 10:30:00":"null"},{"v":'.$temp.',"f":null},{"v":'.$hum.',"f":null}]},';

    if($t_prev == $t_current) continue;
    else $out .=  '{"c":[{"v":"'.$dt.'","f":"'.$dt.'"},{"v":'.$temp.',"f":null},{"v":'.$hum.',"f":null}]},';

  }//while
}//if

$out = rtrim($out, ",");

echo $out;
//[new Date(2020,04,05,16,35,04), 1, 10.9],

echo ']}';
