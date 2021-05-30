<?php 

	$config = include 'config';		
	$refresh_sec = $config['refresh_sec'] * 1000;	

?>

<!DOCTYPE html>
<html>
	<head><title></title>
		<script src="https://code.jquery.com/jquery-1.12.4.js"	integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="	crossorigin="anonymous"></script>
		<script>
			$(document).ready(function() {
				var refresh = function () {
				//$('#worker').load('worker.exec.php');
				$('#worker').load('?p=15');
				 }
				 //setInterval(refresh, 1 * 60 * 1000); //minute interval				 
				 setInterval(refresh, <?php echo $refresh_sec; ?>); //minute interval				 
				 refresh();
			});
		</script>
	</head>
	<body>
		<div id="worker">Loading...</div>
	</body>
</html>