<?php
	if(isset($_GET['board_name'])){
		$board_name = $_GET['board_name'];
	} else {
		$board_name = "";
	}				
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
		$("#deleteServerModal").modal('show');
	});
</script>
</head>
<body>

    <!-- Logout Modal-->
    <div class="modal fade" id="deleteServerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete the server?
				<?php echo $board_name; ?>
				</div>
                <div class="modal-footer">
                    <!--<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>-->
                    <a class="btn btn-primary" href="?p=4&board_notif=delete-board-abort">Cancel</a>
                    <a class="btn btn-primary" href="?p=13&board_name=<?php echo $board_name; ?>">Yes</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>