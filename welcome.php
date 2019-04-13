<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Welcome</title>
	<link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
	<script src="/jquery/dist/jquery.min.js"></script>
	<script src="/bootstrap/dist/js/bootstrap.min.js"></script> 


	<style type="text/css">
		body{ font: 14px sans-serif; text-align: center; }
		.dropdown {
			position: relative;
			display: inline-block;
			vertical-align: middle;
			padding-right: 0px;
			padding-top: 0px;
		}
		.dropdown-menu {
			font-size: 20px;
		}
    .page-header h2{
      margin-top: 0;
    }


		
	</style>

</head>
<body>
	

	<div class="container">
		<div class="col-sm-4"> </div>
		<div class="col-sm-4">
			<div class="page-header clearfix">
        <h2 class="pull-left"> Hi,<?php echo htmlspecialchars($_SESSION["username"]); ?></h2>

        <div class="pull-right">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
              <i class="glyphicon glyphicon-list" style="font-size:12px;"></i>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right">
              <li><a href="welcome.php">Home</a></li>
              <li><a href="index.php">Employee</a></li>
              <li><a href="input.php">Add Record</a></li>
              <li><a href="">Setting</a></li>
              <li><a href="reset-password.php">Reset Password</a></li>
              <li><a href="logout.php">Log Out</a></li>
            </ul>
          </div>
        </div>
      </div>

			
		</div>
	</div>

	
	
	
	

</body>
</html>
