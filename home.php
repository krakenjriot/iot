<?php	
   include("dbconnect.php");
   $online_servers = "";
   $offline_servers = "";
   //get server_notif
   if(isset($_GET['server_notif'])){
   	$server_notif = $_GET['server_notif'];
   } else {
   	$server_notif = "";
   }
   
   //get board-notif
   if(isset($_GET['board_notif'])){
   	$board_notif = $_GET['board_notif'];
   } else {
   	$board_notif = "";
   }
   
   
   //get board-notif
   if(isset($_GET['switch_notif'])){
   	$switch_notif = $_GET['switch_notif'];
   } else {
   	$switch_notif = "";
   }	
   
   
   $config = include 'config';
   $email = $config['email'];
   $fname = $config['fname'];
   $lname = $config['lname'];
   $ipaddress = $config['ipaddress'];
   $fullname = ucfirst($fname)." ".ucfirst($lname);
   
   //count online server	
   $sql = "SELECT * FROM tbl_servers WHERE active=1";
   if ($result = mysqli_query($conn,$sql))
    {	  
     $online_servers = mysqli_num_rows($result);	  
     mysqli_free_result($result);
    }
   
   //count offline server
   $sql = "SELECT * FROM tbl_servers WHERE active=0";
   if ($result = mysqli_query($conn,$sql))
    {	  
     $offline_servers = mysqli_num_rows($result);	  
     mysqli_free_result($result);
    }	
    
   //count online board	
   $sql = "SELECT * FROM tbl_boards WHERE active=1";
   if ($result = mysqli_query($conn,$sql))
    {	  
     $online_boards = mysqli_num_rows($result);	  
     mysqli_free_result($result);
    }
   
   //count offline board
   $sql = "SELECT * FROM tbl_boards WHERE active=0";
   if ($result = mysqli_query($conn,$sql))
    {	  
     $offline_boards = mysqli_num_rows($result);	  
     mysqli_free_result($result);
    }	 
    
    
   //count online board	
   $sql = "SELECT * FROM tbl_switches WHERE active=1";
   if ($result = mysqli_query($conn,$sql))
    {	  
     $online_switches = mysqli_num_rows($result);	  
     mysqli_free_result($result);
    }
   
   //count offline board
   $sql = "SELECT * FROM tbl_switches WHERE active=0";
   if ($result = mysqli_query($conn,$sql))
    {	  
     $offline_switches = mysqli_num_rows($result);	  
     mysqli_free_result($result);
    }	 
    
    
    
	if(isset($_POST['delete_server']))
	{
		$server_name = $_POST['server_name'];
		
		
		// sql to delete a record
		$sql = "DELETE FROM tbl_servers WHERE server_name='$server_name'";

		if (mysqli_query($conn, $sql)) {
		  //echo "Record deleted successfully";
		  	header("location: ?p=4&server_notif=delete-server-success#mark-server");
			exit();			  
		} else {
		  //echo "Error deleting record: " . mysqli_error($conn);
		  	header("location: ?p=4&server_notif=".mysqli_error($conn));
			exit();			  
		}	
   }     
    
	if(isset($_POST['delete_board']))
	{
		$board_name = $_POST['board_name'];
		
		
		// sql to delete a record
		$sql = "DELETE FROM tbl_boards WHERE board_name='$board_name'";

		if (mysqli_query($conn, $sql)) {
			//
		} 
		
		
		$sql = "DELETE FROM tbl_switches WHERE board_name='$board_name'";
		
		if (mysqli_query($conn, $sql)) {
		  //echo "Record deleted successfully";
		  	header("location: ?p=4&board_notif=delete-board-success#mark-board");
			exit();			  
		} else {
		  //echo "Error deleting record: " . mysqli_error($conn);
		  	header("location: ?p=4&board_notif=".mysqli_error($conn));
			exit();			  
		}
   }      
    
    
    
   	
   	
   if(isset($_POST['submit_server'])){
   	/*
   	server_name
   	server_desc
   	server_ip
   	server_location
   	server_timezone
   	htdocs_dir
   	conf_dir
   	*/		
   	$server_name = $_POST['server_name'];
   	$server_desc = $_POST['server_desc'];
   	$server_ip = $_POST['server_ip'];
   	$server_location = $_POST['server_location'];
   	$server_timezone = $_POST['server_timezone'];
   	$htdocs_dir = addslashes($_POST['htdocs_dir']);
   	$conf_dir = addslashes($_POST['conf_dir']);
   
   	//$sql = "SELECT * FROM tbl_serverss ";
   	//$result = mysqli_query($conn, $sql);
   
   	$sql = "INSERT INTO tbl_servers (server_name, server_desc, server_ip, server_location, server_timezone, htdocs_dir, conf_dir)
   	VALUES ('$server_name', '$server_desc', '$server_ip', '$server_location', '$server_timezone', '$htdocs_dir', '$conf_dir')";
   
   	if ($conn->query($sql) === TRUE) {
   		//echo "New record created successfully";
   	  	header("location: ?p=4&server_notif=new-server-added-successfull#mark-server");
   		exit();	
   	} else {
   	  echo "Error: " . $sql . "<br>" . $conn->error;
   	}
   	//$conn->close();
   } 
   
   
   
   if(isset($_POST['submit_board'])){
   	/*
   	board_name
   	board_desc
   	board_location
   	server_name
   	active
   	*/		
   	$board_name = $_POST['board_name'];
   	$board_desc = $_POST['board_desc'];
   	$server_name = $_POST['server_name'];
   	$board_type = $_POST['board_type'];
   	$active = $_POST['active'];
   
   	$sql = "INSERT INTO tbl_boards (board_name, board_desc, server_name, active, board_type)
   	VALUES ('$board_name', '$board_desc', '$server_name', '$active', '$board_type')";
   	$conn->query($sql);
   	
   	//if ($conn->query($sql) === TRUE) {
   		//echo "New record created successfully";
   	  	//header("location: ?p=4&board_notif=new-board-added-successfull");
   		//exit();	
   	//} 
   	
   	//$conn->close();
   	
   	
   	/*
   		pin_name
   		pin_desc
   		pin_num
   		server_name
   		active				
   	*/
   
   if($board_type == 'uno') $total_pins = 19;
   else $total_pins = 69;
   	
   	for ($x = 0; $x <= $total_pins; $x++) {
   		
   		$sql = "INSERT INTO tbl_switches (pin_num, pin_desc, pin_name, board_name, active)
   		VALUES ('$x', 'default_desc', 'default_name', '$board_name', '$active')";
   		$conn->query($sql);
   		
   		//if ($conn->query($sql) === TRUE) {
   			//do nothing	
   		//} 			  
   	}
   	
   	header("location: ?p=4&board_notif=new-board-added-successfull#mark-board");
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
      <title>SB Admin 2 - Dashboard</title>

      
	  
      <!-- Bootstrap core JavaScript-->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- Core plugin JavaScript-->
      <script src="vendor/jquery-easing/jquery.easing.min.js"></script>     

	  
 	  
      <!-- Custom fonts for this template-->
      <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link
         href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
         rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="css/sb-admin-2.min.css" rel="stylesheet">
      <!-- Custom styles for this page -->
      <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
      <link href="css/mycss.css" rel="stylesheet">
	  


	  
	  
	  
	  
	  
	  
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         <!-- Sidebar -->
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
               <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
               </div>
               <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
               <a class="nav-link" href="index.php">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
               Interface
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseTwo">
               <i class="fas fa-fw fa-cog"></i>
               <span>Switch Boards</span>
               </a>
               <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">Custom Components:</h6>
                     <a class="collapse-item" href="buttons.php">Buttons</a>
                     <a class="collapse-item" href="cards.php">Cards</a>
                  </div>
               </div>
            </li>
            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                  aria-expanded="true" aria-controls="collapseUtilities">
               <i class="fas fa-fw fa-wrench"></i>
               <span>Sensor Data</span>
               </a>
               <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                  data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">Custom Utilities:</h6>
                     <a class="collapse-item" href="utilities-color.php">Colors</a>
                     <a class="collapse-item" href="utilities-border.php">Borders</a>
                     <a class="collapse-item" href="utilities-animation.php">Animations</a>
                     <a class="collapse-item" href="utilities-other.php">Other</a>
                  </div>
               </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
               Addons
            </div>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                  aria-expanded="true" aria-controls="collapsePages">
               <i class="fas fa-fw fa-folder"></i>
               <span>Pages</span>
               </a>
               <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">Login Screens:</h6>
                     <a class="collapse-item" href="login.php">Login</a>
                     <a class="collapse-item" href="register.php">Register</a>
                     <a class="collapse-item" href="forgot-password.php">Forgot Password</a>
                     <div class="collapse-divider"></div>
                     <h6 class="collapse-header">Other Pages:</h6>
                     <a class="collapse-item" href="404.php">404 Page</a>
                     <a class="collapse-item" href="blank.php">Blank Page</a>
                  </div>
               </div>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
               <a class="nav-link" href="#mark-server">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>Servers</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
               <a class="nav-link" href="#mark-board">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>Boards</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
               <a class="nav-link" href="#pin">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>Switches [Pins]</span></a>
            </li>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
               <a class="nav-link" href="charts.php">
               <i class="fas fa-fw fa-chart-area"></i>
               <span>Charts</span></a>
            </li>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
               <a class="nav-link" href="tables.php">
               <i class="fas fa-fw fa-table"></i>
               <span>Tables</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
               <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
               <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
               <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>
         </ul>
         <!-- End of Sidebar -->
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
               <!-- Topbar -->
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                  <!-- Sidebar Toggle (Topbar) -->
                  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
                  </button>
                  <!-- Topbar Search -->
                  <!--
                     <form
                         class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                         <div class="input-group">
                             <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                 aria-label="Search" aria-describedby="basic-addon2">
                             <div class="input-group-append">
                                 <button class="btn btn-primary" type="button">
                                     <i class="fas fa-search fa-sm"></i>
                                 </button>
                             </div>
                         </div>
                     </form>-->
                  <!-- Topbar Navbar -->
                  <ul class="navbar-nav ml-auto">
                     <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                     <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                           aria-labelledby="searchDropdown">
                           <form class="form-inline mr-auto w-100 navbar-search">
                              <div class="input-group">
                                 <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                 <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                    </button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </li>
                     <!-- Nav Item - Alerts -->
                     <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-bell fa-fw"></i>
                           <!-- Counter - Alerts -->
                           <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                           aria-labelledby="alertsDropdown">
                           <h6 class="dropdown-header">
                              Alerts Center
                           </h6>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                 <div class="icon-circle bg-primary">
                                    <i class="fas fa-file-alt text-white"></i>
                                 </div>
                              </div>
                              <div>
                                 <div class="small text-gray-500">December 12, 2019</div>
                                 <span class="font-weight-bold">A new monthly report is ready to download!</span>
                              </div>
                           </a>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                 <div class="icon-circle bg-success">
                                    <i class="fas fa-donate text-white"></i>
                                 </div>
                              </div>
                              <div>
                                 <div class="small text-gray-500">December 7, 2019</div>
                                 $290.29 has been deposited into your account!
                              </div>
                           </a>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="mr-3">
                                 <div class="icon-circle bg-warning">
                                    <i class="fas fa-exclamation-triangle text-white"></i>
                                 </div>
                              </div>
                              <div>
                                 <div class="small text-gray-500">December 2, 2019</div>
                                 Spending Alert: We've noticed unusually high spending for your account.
                              </div>
                           </a>
                           <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                     </li>
                     <!-- Nav Item - Messages -->
                     <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fas fa-envelope fa-fw"></i>
                           <!-- Counter - Messages -->
                           <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                           aria-labelledby="messagesDropdown">
                           <h6 class="dropdown-header">
                              Message Center
                           </h6>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="dropdown-list-image mr-3">
                                 <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                    alt="...">
                                 <div class="status-indicator bg-success"></div>
                              </div>
                              <div class="font-weight-bold">
                                 <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                    problem I've been having.
                                 </div>
                                 <div class="small text-gray-500">Emily Fowler · 58m</div>
                              </div>
                           </a>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="dropdown-list-image mr-3">
                                 <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                    alt="...">
                                 <div class="status-indicator"></div>
                              </div>
                              <div>
                                 <div class="text-truncate">I have the photos that you ordered last month, how
                                    would you like them sent to you?
                                 </div>
                                 <div class="small text-gray-500">Jae Chun · 1d</div>
                              </div>
                           </a>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="dropdown-list-image mr-3">
                                 <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                    alt="...">
                                 <div class="status-indicator bg-warning"></div>
                              </div>
                              <div>
                                 <div class="text-truncate">Last month's report looks great, I am very happy with
                                    the progress so far, keep up the good work!
                                 </div>
                                 <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                              </div>
                           </a>
                           <a class="dropdown-item d-flex align-items-center" href="#">
                              <div class="dropdown-list-image mr-3">
                                 <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                    alt="...">
                                 <div class="status-indicator bg-success"></div>
                              </div>
                              <div>
                                 <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                    told me that people say this to all dogs, even if they aren't good...
                                 </div>
                                 <div class="small text-gray-500">Chicken the Dog · 2w</div>
                              </div>
                           </a>
                           <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                     </li>
                     <div class="topbar-divider d-none d-sm-block"></div>
                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $fullname;  ?></span>
                        <img class="img-profile rounded-circle"
                           src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                           aria-labelledby="userDropdown">
                           <a class="dropdown-item" href="#">
                           <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                           Profile
                           </a>
                           <a class="dropdown-item" href="?p=9">
                           <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                           Settings
                           </a>
                           <a class="dropdown-item" href="#">
                           <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                           Activity Log
                           </a>
                           <a class="dropdown-item" href="?p=8">
                           <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                           Set Password
                           </a>								
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="?p=7" data-toggle="modal" data-target="#logoutModal">
                           <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                           Logout
                           </a>
                        </div>
                     </li>
                  </ul>
               </nav>
               <!-- End of Topbar -->
               <!-- Begin Page Content -->
               <div class="container-fluid">
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                     <h1 class="h3 mb-0 text-gray-800">Switch Board (<?php echo $ipaddress; ?>)</h1>
                     <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                  </div>
                  <!--<a class="dropdown-item" href="?p=7" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                     </a>-->
                  <!--
                     <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addServer">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-flag"></i>
                                                    </span>
                                                    <span class="text">Add Servers</span>										
                                                </a>									
                     								
                     <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addBoard">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-flag"></i>
                                                    </span>
                                                    <span class="text">Add Boards</span>										
                                                </a>
                     <div class="my-4"></div>
                     -->
                  <!-- Content Row -->
                  <div class="row">
                     <!-- Earnings (Monthly) Card Example -->
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                       Servers (<?php echo $online_servers + $offline_servers; ?>)
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $online_servers ."/". $offline_servers; ?></div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="fas fa-server fa-2x text-gray-300"></i>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Earnings (Monthly) Card Example -->
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                       Boards (<?php echo $online_boards + $offline_boards; ?>)
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $online_boards ."/". $offline_boards; ?></div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="fas fa-microchip fa-2x text-gray-300"></i>											
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Earnings (Monthly) Card Example -->
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                       Switches (<?php echo $online_switches + $offline_switches; ?>)
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $online_switches ."/". $offline_switches; ?></div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="fas fa-toggle-on fa-2x text-gray-300"></i>											
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- Earnings (Monthly) Card Example -->
                     <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                 <div class="col mr-2">
                                    <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                       Others (<?php echo $online_switches + $offline_switches; ?>)
                                    </div>
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?php echo $online_switches ."/". $offline_switches; ?></div>
                                 </div>
                                 <div class="col-auto">
                                    <i class="fas fa-toggle-on fa-2x text-gray-300"></i>											
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                           <!-- Card Header - Dropdown -->
                           <div
                              class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">Max Temperature</h6>
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                 </div>
                              </div>
                           </div>
                           <!-- Card Body -->
                           <div class="card-body">
                              <div class="chart-area">
                                 <canvas id="myAreaChart"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4">
                           <!-- Card Header - Dropdown -->
                           <div
                              class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                              <h6 class="m-0 font-weight-bold text-primary">Max Humidity</h6>
                              <div class="dropdown no-arrow">
                                 <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                 </a>
                                 <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                 </div>
                              </div>
                           </div>
                           <!-- Card Body -->
                           <div class="card-body">
                              <div class="chart-area">
                                 <canvas id="myAreaChart2"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Page Heading -->
                  <!--<h1 class="h3 mb-2 text-gray-800">Tables</h1>
                     <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                         For more information about DataTables, please visit the <a target="_blank"
                             href="https://datatables.net">official DataTables documentation</a>.</p>-->
                  <!--<a href="html_demo.html#server">Jump to Chapter 4</a>
                     <h2 id="C4">Chapter 4</h2>
                     <a href="#C4">Jump to Chapter 4</a>-->
                  <!-- SERVER BOOKMARK -->
				  
				  
				  
                  
				  <h2 id="mark-server"></h2>
                  <!-- DataTales Example -->
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Servers</h4>
                        <div class="my-2">
                           <p><?php echo $server_notif; ?></p>
                        </div>
                        <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addServer" data-id="@getbootstrap" >
                        
                        
						<span class="icon text-white-50">
                        <i class="fas fa-flag"></i>
                        </span>
                        <span class="text">Add Servers</span>										
                        </a>
                     </div>
                    
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="display table table-bordered" id="" width="100%" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th>edit</th>
                                    <th>name</th>
                                    <th>desc</th>
                                    <th>ip</th>
                                    <th>timezone</th>
                                    <th>htdocs_dir</th>
                                    <th>conf_dir</th>
                                    
                                    <th>trash</th>
                                 </tr>
                              </thead>
                              <tfoot>
                                 <tr>
                                    <th>edit</th>
                                    <th>name</th>
                                    <th>desc</th>
                                    <th>ip</th>
                                    <th>timezone</th>
                                    <th>htdocs_dir</th>
                                    <th>conf_dir</th>
                                    
                                    <th>trash</th>
                                 </tr>
                              </tfoot>
                              <tbody>
                                 <?php
                                    /*
                                    server_name
                                    server_desc
                                    server_ip
                                    server_location
                                    server_timezone
                                    htdocs_dir
                                    conf_dir
                                    */
                                    
                                    $sql = "SELECT * FROM tbl_servers ";
                                    $result = mysqli_query($conn, $sql);
                                    $i = 1;
                                    if (mysqli_num_rows($result) > 0) 
                                    	{
                                    	  // output data of each row
                                    		while($row = mysqli_fetch_assoc($result)) {
                                    			echo "<tr>" . 
                                    			//"<td>". $i++ . "</td>" .
                                    			"<td><a href='?p=10&server_name=". $row["server_name"] ."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-edit'></i></td>" .				
                                    			"<td>". $row["server_name"] . "</td>" .
                                    			"<td>". $row["server_desc"] . "</td>" .
                                    			"<td>". $row["server_ip"] . "</td>" .
                                    			//"<td>". $row["server_location"] . "</td>" .
                                    			"<td>". $row["server_timezone"] . "</td>" .
                                    			"<td>". $row["htdocs_dir"] . "</td>" .									 
                                    			"<td>". $row["conf_dir"] . "</td>" .
                                    			//"<td>". $row["active"] . "</td>" .									
                                    			//"<td><a href='?p=10&server_name=". $row["server_name"] ."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></td>" .								
                                    			
												"<td><a href='#' data-toggle='modal' data-target='#delServer' class='btn btn-danger btn-circle btn-sm' data-whatever='" . $row["server_name"] . "'><i class='fas fa-trash'></i></a></td>" .		 												
                                    			//"<a href='#' class='btn btn-primary btn-icon-split' data-toggle='modal' data-target='#addServer' data-id='@getbootstrap' ><i class='fas fa-trash'></i></button></td>".
												//"<td><a href='javascript:;' data-toggle='modal' data-target='#deleteServerModal' data-mykey='123456' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-trash'></i></td>" .		 
                                    			//"<td><a href='javascript:;' data-toggle='modal' data-target='#deleteServerModal' data-id='1' data-name='Computer' data-duration='255' data-date='27-04-2020' > Edit</a></td>" .
                                    			"</tr>";
                                    		}
                                    	} 
                                    else 
                                    	{
                                    	  echo "0 results";
                                    	}
                                    	
                                    //mysqli_close($conn);
                                    
                                    
                                    					
                                    
                                    ?>
                                 <!--
                                    <tr>
                                        <td>Jonas Alexander</td>
                                        <td>Developer</td>
                                        <td>San Francisco</td>
                                        <td>30</td>
                                        <td>2010/07/14</td>
                                        <td>$86,500</td>
                                    </tr>
                                    <tr>
                                        <td>Shad Decker</td>
                                        <td>Regional Director</td>
                                        <td>Edinburgh</td>
                                        <td>51</td>
                                        <td>2008/11/13</td>
                                        <td>$183,000</td>
                                    </tr>  -->                                   
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <!-- BOARD BOOKMARK -->
                  <h2 id="mark-board"></h2>
                  <!-- DataTales Example -->
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Boards</h4>
                        <div class="my-2">
                           <p><?php echo $board_notif; ?></p>
                        </div>
                        <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#addBoard">
                        <span class="icon text-white-50">
                        <i class="fas fa-flag"></i>
                        </span>
                        <span class="text">Add Boards</span>										
                        </a>
                        <div class="my-4"></div>
                     </div>
                    
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="display table table-bordered" id="" width="100%" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th>edit</th>
                                    <th>board_name</th>
                                    <th>board_desc</th>
                                    <th>server_name</th>
                                    <th>board_type</th>
                                    <th>trash</th>
                                 </tr>
                              </thead>
                              <tfoot>
                                 <tr>
                                    <th>edit</th>
                                    <th>board_name</th>
                                    <th>board_desc</th>
                                    <th>server_name</th>
                                    <th>board_type</th>
                                    <th>trash</th>
                                 </tr>
                              </tfoot>
                              <tbody>
                                 <?php
                                    /*
                                    	<th>id</th>
                                    	<th>edit</th>
                                    	<th>board_name</th>
                                    	<th>board_desc</th>
                                    	<th>server_name</th>                                            
                                    	<th>active</th>                                                                                     
                                    	<th>trash</th>
                                    */
                                    
                                    $sql = "SELECT * FROM tbl_boards ";
                                    $result = mysqli_query($conn, $sql);
                                    $i = 1;
                                    if (mysqli_num_rows($result) > 0) 
                                    	{
                                    	  // output data of each row
                                    		while($row = mysqli_fetch_assoc($result)) {
                                    			echo "<tr>" . 
                                    			//"<td>". $i++ . "</td>" .
                                    			"<td><a href='?p=12&board_name=". $row["board_name"] ."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-edit'></i></td>" .				
                                    			"<td>". $row["board_name"] . "</td>" .
                                    			"<td>". $row["board_desc"] . "</td>" .
                                    			"<td>". $row["server_name"] . "</td>" .								
                                    			"<td>". $row["board_type"] . "</td>" .								
                                    			//"<td>". $row["active"] . "</td>" .									 
                                    			"<td><a href='#' data-toggle='modal' data-target='#delBoard' class='btn btn-danger btn-circle btn-sm' data-whatever='" . $row["board_name"] . "'><i class='fas fa-trash'></i></a></td>" .		 												
                                    			"</tr>";
                                    		}
                                    	} 
                                    else 
                                    	{
                                    	  echo "0 results";
                                    	}
                                    	
                                    //mysqli_close($conn);
                                    
                                    
                                    					
                                    
                                    ?>
                                 <!--
                                    <tr>
                                        <td>Jonas Alexander</td>
                                        <td>Developer</td>
                                        <td>San Francisco</td>
                                        <td>30</td>
                                        <td>2010/07/14</td>
                                        <td>$86,500</td>
                                    </tr>
                                    <tr>
                                        <td>Shad Decker</td>
                                        <td>Regional Director</td>
                                        <td>Edinburgh</td>
                                        <td>51</td>
                                        <td>2008/11/13</td>
                                        <td>$183,000</td>
                                    </tr>  -->                                   
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <h2 id="pin"></h2>
                  <!-- DataTales Example -->
                  <div class="card shadow mb-4">
                     <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Switches [Pins]</h4>
                        <div class="my-2">
                           <p><?php echo $switch_notif; ?></p>
                        </div>
                     </div>
                  
                     <div class="card-body">
                        <div class="table-responsive">
                           <table class="display table table-bordered" id="" width="100%" cellspacing="0">
                              <thead>
                                 <tr>
                                    <th>edit</th>
                                    <th>pin_num</th>
                                    <th>pin_name</th>
                                    <th>pin_desc</th>
                                    <th>board_name</th>
                                    <th>active</th>
                                 </tr>
                              </thead>
                              <tfoot>
                                 <tr>
                                    <th>edit</th>
                                    <th>pin_num</th>
                                    <th>pin_name</th>
                                    <th>pin_desc</th>
                                    <th>board_name</th>
                                    <th>active</th>
                                 </tr>
                              </tfoot>
                              <tbody>
                                 <?php
                                    /*
                                    	pin_num
                                    	pin_name
                                    	pin_desc						
                                    	board_name
                                    	active
                                    */
                                    
                                    $sql = "SELECT * FROM tbl_switches ";
                                    $result = mysqli_query($conn, $sql);
                                    $i = 1;
                                    if (mysqli_num_rows($result) > 0) 
                                    	{
                                    	  // output data of each row
                                    		while($row = mysqli_fetch_assoc($result)) {
                                    			echo "<tr>" . 
                                    			//"<td>". $i++ . "</td>" .
                                    			"<td><a href='?p=10&board_name=". $row["board_name"] ."' class='btn btn-danger btn-circle btn-sm'><i class='fas fa-edit'></i></td>" .				
                                    			"<td>". $row["pin_num"] . "</td>" .
                                    			"<td>". $row["pin_name"] . "</td>" .
                                    			"<td>". $row["pin_desc"] . "</td>" .
                                    			"<td>". $row["board_name"] . "</td>" .
                                    			"<td>". $row["active"] . "</td>" .
                                    			"</tr>";
                                    		}
                                    	} 
                                    else 
                                    	{
                                    	  echo "0 results";
                                    	}
                                    	
                                    //mysqli_close($conn);
                                    
                                    
                                    					
                                    
                                    ?>
                                 <!--
                                    <tr>
                                        <td>Jonas Alexander</td>
                                        <td>Developer</td>
                                        <td>San Francisco</td>
                                        <td>30</td>
                                        <td>2010/07/14</td>
                                        <td>$86,500</td>
                                    </tr>
                                    <tr>
                                        <td>Shad Decker</td>
                                        <td>Regional Director</td>
                                        <td>Edinburgh</td>
                                        <td>51</td>
                                        <td>2008/11/13</td>
                                        <td>$183,000</td>
                                    </tr>  -->                                   
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; Your Website 2021</span>
                  </div>
               </div>
            </footer>
            <!-- End of Footer -->
         </div>
         <!-- End of Content Wrapper -->
      </div>
      <!-- End of Page Wrapper -->
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
	  
	  
      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                  <a class="btn btn-primary" href="?p=7">Logout</a>
               </div>
            </div>
         </div>
      </div>
     
 

 
      <!-- SERVER -->
      <div class="modal fade" id="delServer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Server</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form class="user" action="?p=4" method="post">                     
					 <div class="form-group">
                        <input type="text" class="form-control" id="server_name" name="server_name" hidden>
						<h5 class="modal-message"></h5>
						</div>		
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="delete_server" >Delete</button>					 
                  </form>
               </div>
            </div>
         </div>
      </div>
 	  
      <script type="text/javascript">
         $('#delServer').on('show.bs.modal', function (event) {
           var link = $(event.relatedTarget) // Button that triggered the modal
           var recipient = link.data('whatever') // Extract info from data-* attributes
           var modal = $(this)
           modal.find('.modal-body input').val(recipient)
           modal.find('.modal-body .modal-message').text('Are you sure you want to delete ' + recipient + '?')		   
         })           
      </script>	 	  	


      <!-- SERVER -->
      <div class="modal fade" id="delBoard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Board</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form class="user" action="?p=4" method="post">                     
					 <div class="form-group">
                        <input type="text" class="form-control" id="board_name" name="board_name" hidden>
						<h5 class="modal-message"></h5>
						</div>		
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="delete_board" >Delete</button>					 
                  </form>
               </div>
            </div>
         </div>
      </div>
 	  
      <script type="text/javascript">
         $('#delBoard').on('show.bs.modal', function (event) {
           var link = $(event.relatedTarget) // Button that triggered the modal
           var recipient = link.data('whatever') // Extract info from data-* attributes
           var modal = $(this)
           modal.find('.modal-body input').val(recipient)
           modal.find('.modal-body .modal-message').text('Are you sure you want to delete ' + recipient + '?')		   
         })           
      </script>	 	 

	  
	  
      <!-- SERVER -->
      <div class="modal fade" id="addServer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Server</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form class="user" action="?p=4" method="post">
                     
					 <div class="form-group">
                        <label for="server_name" class="col-form-label">server_name:</label>
                        <input type="text" class="form-control" id="server_name" name="server_name">
                     </div>
					 
					 
                     <div class="form-group">
                        <label for="server_desc" class="col-form-label">server_desc:</label>
                        <textarea class="form-control" id="server_desc" name="server_desc"></textarea>
                     </div>
					 
			         <div class="form-group">
                        <label for="server_ip" class="col-form-label">server_ip:</label>
                        <input class="form-control" id="server_ip" name="server_ip"></input>
                     </div>
					 
					 
			         <div class="form-group">
                        <label for="server_location" class="col-form-label">server_location:</label>
                        <input class="form-control" id="server_location" name="server_location"></input>
                     </div>
					 
					 
					 
					 
                     <div class="form-group">
                        <label for="server_timezone">server_timezone:</label>
                        <select id="server_timezone" class="form-control" name="server_timezone" >
                           <option value="Asia/Manila">Asia/Manila</option>
                           <option value="Asia/Riyadh">Asia/Riyadh</option>                         
                        </select>
                     </div>
                    
					 
			         <div class="form-group">
                        <label for="htdocs_dir" class="col-form-label">htdocs_dir:</label>
                        <input class="form-control" id="htdocs_dir" name="htdocs_dir" ></input>
                     </div>

		 
			         <div class="form-group">
                        <label for="conf_dir" class="col-form-label">conf_dir:</label>
                        <input class="form-control" id="conf_dir" name="conf_dir" ></input>
                     </div>	
					 </br>
					 
					 
                     
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit_server" >Submit</button>
                     </div>
					 
                  </form>
               </div>
            </div>
         </div>
      </div>
	  
	  
      <!-- BOARD -->
      <div class="modal fade" id="addBoard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Board</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form class="user" action="?p=4" method="post">
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">board_name:</label>                        
                        <!--<input type="text" class="form-control" id="recipient-name">-->
                        <input type="text" class="form-control" id="board_name" name="board_name" >
                     </div>
                     <div class="form-group">
                        <label for="message-text" class="col-form-label">board_desc:</label>
                        <textarea class="form-control" id="board_desc" name="board_desc" ></textarea>
                     </div>
                     <div class="form-group">
                        <label for="inputState">board_location:</label>
                        <select id="inputState" class="form-control" name="board_location">
                           <option>Board1</option>
                           <option>Board2</option>
                           <option>Board3</option>
                           <option>Board4</option>
                           <option>Board4</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="inputState">server_name:</label>
                        <select id="inputState" class="form-control" name="server_name">
                           <option>Board1</option>
                           <option>Board2</option>
                           <option>Board3</option>
                           <option>Board4</option>
                           <option>Board4</option>
                        </select>
                     </div>
                     <!--
                        <div class="form-group">
                           <label for="example-datetime-local-input" >Creation Date</label>
                           <input class="form-control" type="date" id="example-datetime-local-input" name="creationdate" require>
                        </div>-->
                     <fieldset class="form-group">
                        <legend class="col-form-legend col-sm-2"></legend>
                        <label for="inputState">board_type:</label>
                        <div class="col-sm-10">
                           <div class="form-check">
                              <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="board_type" id="board_type" value="uno" checked> Uno
                              </label>
                           </div>
                           <div class="form-check">
                              <label class="form-check-label">
                              <input class="form-check-input" type="radio" name="board_type" id="board_type" value="mega"> Mega
                              </label>
                           </div>
                        </div>
                     </fieldset>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit_board" >Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
	  
    


      <script>
         $(document).ready(function() {
           //$('#dataTable').DataTable();
           $('table.display').DataTable();
         });
      </script>	
	
	
	
		 

      <!-- Custom scripts for all pages-->
      <script src="js/sb-admin-2.min.js"></script>
      <!-- Page level plugins -->
      <script src="vendor/chart.js/Chart.min.js"></script>
      <!-- Page level custom scripts -->
      <script src="js/demo/chart-area-demo.js"></script>
      <script src="js/demo/chart-area-demo2.js"></script>
      <script src="js/demo/chart-pie-demo.js"></script>
      <!-- Page level plugins -->
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
      <!-- Page level custom scripts -->
      <!--<script src="js/demo/datatables-demo.js"></script>-->

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
 
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  

      <?php 	mysqli_close($conn); ?>
   </body>
</html>