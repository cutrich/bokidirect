<?php

session_start();


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";

// define variables and set to empty values
$nameErr = $cardErr = $cashErr = $tipErr = $supplyErr = "";
$name = $card = $cash = $tip = $supply = $date = "";
$selected ="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if($_POST['submit']=='Clear'){
   $card = $cash = $tip = $supply = $date = "";
  }

  if($_POST['submit'] =='Save'){
  if (isset($_POST["name"]))
    {
      $selected = $_POST["name"];
    }


  if (empty($_POST["name"])) {
    $name = "0";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!is_numeric($name)) {
      $name = $_POST["name"];
    } else {
    	$name = $_POST["name"];
    }
  }

  if (empty($_POST["card"])) {
    $card = 0;
  } else {
    $card = test_input($_POST["card"]);
    // check if name only contains letters and whitespace
    if (!is_numeric($card)) {
      $cardErr = "Number Only";
    } else {
    	$card = $_POST["card"];
    }
  }

  if (empty($_POST["cash"])) {
    $cash = 0;
  } else {
    $cash = test_input($_POST["cash"]);
    // check if name only contains letters and whitespace
    if (!is_numeric($cash)) {
      $cashErr = "Number Only";
    } else {
    	$cash = $_POST["cash"];
    }
  }

  if (empty($_POST["tip"])) {
    $tip = 0;
  } else {
    $tip = test_input($_POST["tip"]);
    // check if name only contains letters and whitespace
    if (!is_numeric($tip)) {
      $tipErr = "Number Only";
    } else {
    	$tip = $_POST["tip"];
    }
  }

  if (empty($_POST["supply"])) {
    $supply = 0;
  } else {
    $supply = test_input($_POST["supply"]);
    // check if name only contains letters and whitespace
    if (!is_numeric($supply)) {
      $supplyErr = "Number Only";
    } else {
    	$supply = $_POST["supply"];
    }
  }
  if (empty($_POST["date"])) {
    $dateErr = "Select Date";
  } else {
    $date = test_input($_POST["date"]);
    // check if name only contains letters and whitespace
    if (!is_numeric($date)) {
      $date = date('Y-m-d',strtotime($_POST['date']));
    } else {
    	$date = date('Y-m-d',strtotime($_POST['date']));
    }
  }

  if(empty($nameErr) && empty($cardErr) && empty($cashErr) && empty($supplyErr) && empty($tipErr) && empty($dateErr)){
      $session_user= $_SESSION["username"];
      $sql = "INSERT INTO booki_tbl (id, booki_employee, booki_cash, booki_card, booki_tip, booki_supply, booki_date) VALUES ((SELECT id FROM users WHERE username = '$session_user'),'$name','$cash', '$card', '$tip','$supply','$date')";

      if (mysqli_query($link, $sql)) {
        $card = $cash = $tip = $supply = "";
        $msg= "New record created successfully";
        echo '<script type="text/javascript">alert("' . $msg. '")</script>';
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }


  }
}
} // post function

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function get_options($select) {
    require "config.php";
    $sql = "SELECT * FROM ".$_SESSION["username"]."_employee";
    $result = mysqli_query($link,$sql) or die ("Bad Query; $sql");

    while($name1 = mysqli_fetch_array($result)) {
      if ($select==$name1['employee']) {
        echo "<option value='".$name1['employee']."' selected>".$name1['employee']."</option>";
      }
      else {
        echo "<option value='".$name1['employee']."'>".$name1['employee']."</option>";
      }
    }
    echo "</select>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <meta http-equiv="pragma" content="no-cache" />   
  <title>Add Record</title>
  <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
  <script src="/jquery/dist/jquery.min.js"></script>
  <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/jquery/dist/jquery.js"></script>
  <script type="text/javascript" src="/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css"/>
  

  <style type="text/css">
    body{ font: 14px sans-serif; text-align: left; }
    .dropdown {
      position: relative;
      display: inline-block;
      vertical-align: middle;
      padding-right: 0px;
    }
    .dropdown-menu {
      font-size: 20px;
    }
    .page-header h2{
      margin-top: 0;
    }
    .btn-success {
      margin-right: 5px;
    }

  </style>
</head>
<body>
  <div class="container">
    <div class="col-sm-4"> </div>
    <div class="col-sm-4">
      <div class="page-header clearfix">
        <h2 class="pull-left"> Add Record </h2>

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
        <div class="form-group">
          <div id="filterDate2">

            <label for="input_name">Name</label>
            <select class="form-control" id="input_name" name="name" >
              <?php echo get_options($selected); ?>
            </select>
            <span class="error"><?php echo $nameErr;?></span>
            <br>
            <label for="input_cash">Cash</label>
            <input type="tel" id="input_cash" name="cash" class="form-control" value="<?php echo $cash;?>" autocomplete="off">
            <span class="error"><?php echo $cashErr;?></span>
            <br>
            <label for="input_card">Card</label>
            <input type="tel" id="input_card" name="card" class="form-control" value="<?php echo $card;?>" autocomplete="off">
            <span class="error"><?php echo $cardErr;?></span>
            <br>
            <label for="input_tip">Tip</label>
            <input type="tel" name="tip" id="input_tip" class="form-control" value="<?php echo $tip;?>" autocomplete="off">
            <span class="error"><?php echo $tipErr;?></span>
            <br>
            <label for="input_supply">Supply</label>
            <input type="tel" name="supply" id="input_supply" class="form-control" value="<?php echo $supply;?>" autocomplete="off">
            <span class="error"><?php echo $supplyErr;?></span>
            <br>
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control"  value="<?php echo $date;?>" autocomplete="off">
            <span class="error"><?php echo $dateErr;?></span>
            <br>
            <input type="submit" name="submit" class="btn btn-primary" value="Save">
            <input type="submit" name="submit" class="btn btn-primary" value="Clear">
          </div>
        </div>
      </form>
    </div>

    <div class="col-sm-4">

    </div>

  </div>




</body>
</html>
