<?php	
	if(isset($_GET['p'])) { 
		$p = $_GET['p']; 
	} else { 
		$p = "1"; 
	}
	
	switch ($p) {
    case '0': include('404.php'); break;    	
    case '1': include('login.php'); break;
    case '2': include('register.php'); break;
    case '3': include('forgot-password.php'); break;
    case '4': include('home.php'); break;
    case '5': include('setpass.php'); break;
    case '6': include('settings.php'); break;	
    case '7': include('logout.php'); break;	
    case '8': include('set-pass.php'); break;	
    case '9': include('settings.php'); break;	
    case '10': include('delete-modal.php'); break;	
    case '11': include('delete-exec.php'); break;	
	default : include('404.php'); break;    
	}	
?>

