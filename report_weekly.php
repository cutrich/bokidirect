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
  <title>Add Record</title>
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
  <script src="/jquery/dist/jquery.min.js"></script>
  <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/jquery/dist/jquery.js"></script>
  

  <style type="text/css">
    input[type=date] {
      width: 50%;

    }
    .page-header h2{
      margin-top: 0;
    }
    table tr td:last-child a{
      margin-right: 15px;
    }
  </style>
  <script type="text/javascript">
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
  </script>
</head>
<body>
  
      <div class="page-header clearfix">
        <h2 class="pull-left">Daily </h2>

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

        <a href="daily_tr.php" class="btn btn-success pull-right" >
          <i class="glyphicon glyphicon-list-alt" style="font-size:12px;"></i>
        </a>
      </div>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="input-group">
         <input type="date" name="date" class="form-control" id="date" value="<?php echo $date;?>" autocomplete="off">

         <span class="input-group-btn errr" ><?php echo $dateErr;?>
         <input type="submit" name="submit" class="btn btn-primary" value="Go">
       </span>
     </div>
     <br>
   </form>
   <?php
   $session_user= $_SESSION["username"];
   $date = $dateErr = "";


   if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["date"])) {
      $dateErr = "Select Valid Date";
    } else {

     $date = date('Y-m-d',strtotime($_POST['date']));
   }

$name_="";                    // Close connection
$sql1 = "SELECT * FROM ".$_SESSION["username"]."_employee";
if($result1 = mysqli_query($link, $sql1)){
  if(mysqli_num_rows($result1) > 0){
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead>";
    echo "<tr>";

    echo "<th>Name</th>";
    echo "<th>Cash</th>";
    echo "<th>Card</th>";
    echo "<th>Tip</th>";
    echo "<th>Supply</th>";
    echo "<th>Total</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while($row1 = mysqli_fetch_array($result1)){
      echo "<tr>";
      echo "<td>" . $row1['employee'] . "</td>";
      $sql2 = "SELECT SUM(booki_cash)as sumcash FROM booki_tbl WHERE booki_date='$date' and booki_employee='".$row1['employee']."'";
      if ($result2 = mysqli_query($link, $sql2)) {
        if (mysqli_num_rows($result2) > 0){
         $val_cash = mysqli_fetch_array ($result2);
       } else{
        $val_cash['sumcash']=0;
      }

                        # code...
    } else{
      echo "ERROR";
    }
    $sql2 = "SELECT SUM(booki_card)as sumcash FROM booki_tbl WHERE booki_date='$date' AND booki_employee='".$row1['employee']."'";
    if ($result2 = mysqli_query($link, $sql2)) {
      if (mysqli_num_rows($result2) > 0){
       $val_card = mysqli_fetch_array ($result2);
     } else{
      $val_card['sumcash']=0;
    }

                        # code...
  } else{
    echo "ERROR";
  }
  $sql2 = "SELECT SUM(booki_tip)as sumcash FROM booki_tbl WHERE booki_date='$date' AND booki_employee='".$row1['employee']."'";
  if ($result2 = mysqli_query($link, $sql2)) {
    if (mysqli_num_rows($result2) > 0){
     $val_tip = mysqli_fetch_array ($result2);
   } else{
    $val_tip['sumcash']=0;
  }

                        # code...
} else{
  echo "ERROR";
}
$sql2 = "SELECT SUM(booki_supply)as sumcash FROM booki_tbl WHERE booki_date='$date' AND booki_employee='".$row1['employee']."'";
if ($result2 = mysqli_query($link, $sql2)) {
  if (mysqli_num_rows($result2) > 0){
   $val_supply = mysqli_fetch_array ($result2);
 } else{
  $val_supply['sumcash']=0;
}

                        # code...
} else{
  echo "ERROR";
}
echo "<td>". $val_cash['sumcash'] ."</td>";
echo "<td>". $val_card['sumcash'] ."</td>";
echo "<td>". $val_tip['sumcash'] ."</td>";
echo "<td>". $val_supply['sumcash'] ."</td>";
echo "<td>". $val_supply['sumcash'] ."</td>";
echo "</tr>";
}
echo "</tbody>";

echo "</table>";
                            // Free result set
mysqli_free_result($result1);
} else{
  echo "<p class='lead'><em>No records were found.</em></p>";
}
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

                    // Close connection
mysqli_close($link);
}
?>
      

</body>
</html>
