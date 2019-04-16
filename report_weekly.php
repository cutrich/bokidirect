<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("location: login.php");
  exit;
}
require_once "config.php";

$weekly="";
$selected="";
$test="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["weekly"]))
  {
    $selected = $_POST["weekly"];
  }

  $weekly=$_POST["weekly"];
  echo $weekly;
}

function get_options($select) {

  for ($i = 0; $i < 20; $i++) {

    if ($select == date("Y-m-d", strtotime("this sunday - $i week"))){
      echo '<option value="' . date("Y-m-d", strtotime("this sunday - $i week")) . '" selected>' . date("M j", strtotime("this monday - $i week")) . " - " . date("M j", strtotime("this sunday - $i week")) .'</option>';
    } else {

      echo '<option value="' . date("Y-m-d", strtotime("this sunday - $i week")) . '">' . date("M j", strtotime("this monday - $i week")) . " - " . date("M j", strtotime("this sunday - $i week")) .'</option>';
    }

  }
  echo "</select>";    


}
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
    <h2 class="pull-left">Weekly </h2>

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
   <select class = "form-control" id="input_name" name="weekly">
    <?php echo get_options($selected); ?>
  </select>
  <span class="error"><?php echo $weeklyErr;?></span>
  <br>
  <input type="submit" name="submit" class="btn btn-primary" value="Save">

</form>


</body>
</html>
