<?php
  //rolly falco


  $title = "Chart / Graph (c)";
  $legend_sensor_name = "Temprature";
  $legend_time_name =  "Time";
  $number_of_samples =  "1000";
  //$interval_span =  "30"; //mins
  //$t_span = date("i",time()); //minute
  $t_span = 30; //minute
  //$m = 15; //minute

  date_default_timezone_set("Asia/Riyadh");

	///echo $t_span;
?>

<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

<script language="JavaScript" type="text/javascript">
	//setTimeout("location.href = 'chart3.php?t_span=<?php echo $t_span; ?>'",15000); // milliseconds, so 10 seconds = 10000ms
	setTimeout("location.href = 'chart3.php?t_span=<?php echo $t_span; ?>'", 1 * 60 * 1000 ); // milliseconds, so 10 seconds = 10000ms
	//setTimeout("location.href = 'chart3.php?t_span=<?php echo $t_span; ?>'", 3000 ); // milliseconds, so 10 seconds = 10000ms
</script>

</script>
<div id="chart_div">
<!--<div id="chart_div" style="width: 900px; height: 500px">-->
<script type="text/javascript">
google.charts.load('current', {
  callback: function () {
    drawChart();
    //setInterval(drawChart, (1 * 60 * 1000));
    setInterval(drawChart, (3000));
    function drawChart() {
      var jsonData = $.ajax({
          //url: "fetch_4.php",
          url: 'fetch.php?t_span=<?php echo $t_span; ?>',
          dataType: "json",
          async: false
          }).responseText;

          // Create our data table out of JSON data loaded from server.
          var data = new google.visualization.DataTable(jsonData);

          var options = {

			         //title: 'Date/Time: <?php echo date('h A ( M-d-Y )',time()); ?>',
               //curveType: 'function',


               chart: {
                 title: '<?php echo $title; ?>',
                 subtitle: 'Date/Time: <?php echo date('h A (M-d-Y )',time()); ?>'
               },

               //width: '100%',
               height: 500,
               //legend: { position: 'top'},
               enableInteractivity: true,
               chartArea: {
                 //width: '100%'
               },

			      hAxis: {
              //title: 'Logs from last <?php echo $t_span; ?> Minutes',
              direction: '-1',
              curveType: 'function'
            },

			      vAxis: {
              //title: 'Values',
              //direction: '-1'
            },

            gridlines: {
              count: -1,
              units: {
                days: {format: ['MMM dd']},
                hours: {format: ['HH:mm', 'ha']},
              }
            },
            minorGridlines: {
              units: {
                hours: {format: ['hh:mm:ss a', 'ha']},
                minutes: {format: ['HH:mm a Z', ':mm']}
              }
            },

			      legend: {
              position: 'bottom'
             }
          };

          var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
          //chart.draw(data, options);
          chart.draw(data, options);

    }
  },

  packages: ['corechart']

});
</script>


</div>