<?php

	$config = include 'config';				
	//$conf_dir = $config['conf_dir'];
	//$htdocs_dir = $config['htdocs_dir'];
	$refresh_sec = $config['refresh_sec'];
	$ipaddress = $config['ipaddress'];
	
	
	if(isset($_GET['msg'])){
		$msg = $_GET['msg'];
	} else {
		$msg = "<div class='small mb-3 text-muted'>Update new configuration settings</div>";
	}
	
	if(isset($_POST['submit'])) {		
		//$conf_dir_post = $_POST['conf_dir'];
		//$htdocs_dir_post = $_POST['htdocs_dir'];		
		$ipaddress_post = $_POST['ipaddress'];		
		$refresh_sec_post = $_POST['refresh_sec'];		
		
		
		$config = include 'config';				
		
		//$config['conf_dir']= $conf_dir_post;				
		//$config['htdocs_dir']= $htdocs_dir_post;				
		$config['ipaddress']= $ipaddress_post;				
		$config['refresh_sec']= $refresh_sec_post;				
		
		file_put_contents('config', '<?php return ' . var_export($config, true) . ';');				
		header("location: ?p=4&msg=settings-update-successful");
		exit();		
	} 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Set Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Settings</h1>
                                        <p class="mb-4"><?php echo $msg; ?></p>
                                    </div>
                                    <form class="user" action="?p=9" method="post">
                                        <div class="form-group">
                                            
											<input type="text" class="form-control form-control-user"
                                                id="input-htdocs-dir" aria-describedby="emailHelp"
                                                placeholder="refresh_sec..." name="refresh_sec" value="<?php echo $refresh_sec; ?>">	
												
                                            <input type="text" class="form-control form-control-user"
                                                id="input-htdocs-dir" aria-describedby="emailHelp"
                                                placeholder="ip address..." name="ipaddress" value="<?php echo $ipaddress; ?>">											
                                        </div>
                                        <!--<a href="?p=1" class="btn btn-primary btn-user btn-block">
                                            Set Password
                                        </a>-->
										<button type="submit" class="btn btn-primary btn-user btn-block" name="submit" >Update Settings</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="?p=4">Return Home</a>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>