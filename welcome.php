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
	<link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/style.css">
	<script src="/jquery/dist/jquery.min.js"></script>
	<script src="/bootstrap/dist/js/bootstrap.min.js"></script> 


	<style type="text/css">
    	.page-header h2{
      	margin-top: 0;
    }


		
	</style>

</head>
<body>
	


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
              <li><a href="daily_tr.php">Transaction</a></li>
              <li><a href="reset-password.php">Reset Password</a></li>
              <li><a href="logout.php">Log Out</a></li>
            </ul>
          </div>
      

			
	
	</div>
</div>

	
	
	
	

</body>
</html>
