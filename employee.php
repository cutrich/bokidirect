<?php
// Initialize the session

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username ="";
$username_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        //1st sql
        $sql = "SELECT id FROM ".$_SESSION["username"]."_employee WHERE employee = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            }
                mysqli_stmt_close($stmt);
        }
        // another sql
        if(empty($username_err)){
        $sql = "INSERT INTO ".$_SESSION["username"]."_employee (employee) VALUES (?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $_POST['username'];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: employee.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }}
        // Close statement
        mysqli_stmt_close($stmt);
    }// end else
}//end if
    mysqli_close($link);



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
			.fixed_header{
			  width: 350px;
			  table-layout: fixed;
			  border-collapse: collapse;
				}
			.fixed_header tbody{
			  display:block;
			  width: 100%;
			  overflow: auto;
			  height: 150px;
			 }
			.fixed_header thead tr {
			   display: block;
			 }
			.fixed_header thead {
				padding-top: 10px;
			  background: black;
			  color:#fff;
			 }
			 .dropdown {
		    position: relative;
		    display: inline-block;
		    vertical-align: middle;
		    padding-right: 50px;
			}
			.fixed_header th, .fixed_header td {			 
			  padding: 10px;
			  text-align: left;
			  width: 150px;
			  }
    </style>
</head>
	<body>
					<div class="pull-center">
							        <div class="pull-right">
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
							        </div>
							           </h1>
							        </div>
					
					<h3><b>Employee</b></h3>
					<hr />
		<div class="container">
			  <div class="row">
			    <div class="col-sm-4">

			    </div>
			    <div class="col-sm-4">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
					                <label>Add Employee Name</label>
					                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
					                <span class="help-block"><?php echo $username_err; ?></span>
					            </div>    
					            <div class="form-group">
					                <input type="submit" class="btn btn-primary" value="Add">
					            </div>
					            
					        </form>
			    </div>
			    <div class="col-sm-4">

			    </div>
			    </div>
			    <div class="row">
			    <div class="col-sm-4">

			    </div>
			    <div class="col-sm-4">
						<table class="fixed_header">
							  <thead>
							    <tr> <h2>
							      <th>ID</th>
							      <th>Name</th>
							    </h2></tr>
							  </thead>
							  <tbody>
									<?php
										require "config.php";
										$sql = "SELECT * FROM ".$_SESSION["username"]."_employee";
										$result = mysqli_query($link,$sql) or die ("Bad Query; $sql");
										
										while($row = mysqli_fetch_assoc($result)) {
											echo "<tr><td>".$row["id"]."</td><td>".$row["employee"]."</td></tr>";
										}
									?>
							  </tbody>
						</table>
			    </div>
			    <div class="col-sm-4">

			    </div>
			    </div>
			    </div>

	</body>
</html>