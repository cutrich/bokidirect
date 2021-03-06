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
			    padding-right: 50px;
			    padding-top: 0px;
				}
				.back {
	          background: #e2e2e2;
	          width: 100%;
	          position: absolute;
	          top: 0;
	          bottom: 0;
	      }

	      .div-center {
	          width: 1366px;
	          height: 768px;
	          background-color: #fff;
	          position: absolute;
	          left: 0;
	          right: 0;
	          top: 0;
	          bottom: 0;
	          margin: auto;
	          max-width: 100%;
	          max-height: 100%;
	          overflow: auto;
	          padding: 1em 2em;
	          border-bottom: 0px solid #ccc;
	          display: table;
	      }

	      div.content {
	          display: table-cell;
	          vertical-align: middle;
	      }
	        
	    </style>

</head>
<body>
	 

		       <div class="div-center">
		       	 
			       <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>


		        	<span class="pull-right">
			        	<div class="dropdown">
					    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
					    <i class="glyphicon glyphicon-list" style="font-size:20px;"></i>
					    <span class="caret"></span>
					    </button>
					    <ul class="dropdown-menu pull-right">
					      <li><a href="welcome.php">Home</a></li>
					      <li><a href="employee.php">Employee</a></li>
					      <li><a href="input.php">Data Entry</a></li>
					      <li><a href="setting.php">Setting</a></li>
					      <li><a href="reset-password.php">Reset Password</a></li>
					      <li><a href="logout.php">Log Out</a></li>
					    </ul>

					</div>
				</span>
				</h3>
				<hr />
					  
		        </div>
	
		        	</div>

		 
		    
		    
		  

</body>
</html>
