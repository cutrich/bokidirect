<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require_once "config.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <script src="/jquery/dist/jquery.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
        .dropdown {
            position: relative;
            display: inline-block;
            vertical-align: middle;
            padding-right: 0px;
        }
        .dropdown-menu {
      font-size: 20px;
        }
        .btn-success {
            margin-right: 5px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="container">
        <div class="col-sm-4"> </div>
        <div class="col-sm-4">
            <div class="page-header clearfix">
                <h2 class="pull-left">Employees </h2>
                
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
              
              <a href="create.php" class="btn btn-success pull-right">+</a>
          </div>
          <?php
                    // Include config file
          require_once "config.php";

                    // Attempt select query execution
          $sql = "SELECT * FROM ".$_SESSION["username"]."_employee";
          if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>#</th>";
                echo "<th>Name</th>";
                echo "<th>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['employee'] . "</td>";
                    echo "<td>";
                    echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                    echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";                            
                echo "</table>";
                            // Free result set
                mysqli_free_result($result);
            } else{
                echo "<p class='lead'><em>No records were found.</em></p>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

                    // Close connection
        mysqli_close($link);
        ?>
    </div>
    <div class="col-sm-4"></div>
</div>        

</body>
</html>
