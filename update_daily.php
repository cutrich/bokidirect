<?php
// Include config file
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $cassh = $card = $tip = $supply = "";
$name_err = $cassh_err = $card_err = $tip_err = $supply_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $name = trim($_POST["name"]);
    $cassh = trim($_POST["cassh"]);
    $card = trim($_POST["card"]);
    $tip = trim($_POST["tip"]);
    $supply = trim($_POST["supply"]);
    
    if(empty($cassh)){
        $cash =0 ;
    }
    if(empty($card)){
        $card =0 ;
    }
    if(empty($tip)){
        $tip =0 ;
    }
    if(empty($supply)){
        $supply =0 ;
    }


    
    // Check input errors before inserting in database
    if(empty($name_err)){
        // Prepare an update statement
        $sql = "UPDATE booki_tbl SET booki_cash = ?, booki_card = ?, booki_tip = ?, booki_supply = ? WHERE booki_id = ?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iiiii", $param_cash, $param_card, $param_tip, $param_supply, $param_id);
            
            
            
            
            
            $param_cash = $cassh;
            $param_card = $card;
            $param_tip = $tip;
            $param_supply = $supply;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: update_daily.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM booki_tbl WHERE booki_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["booki_employee"];
                    $card = $row["booki_card"];
                    $cassh = $row["booki_cash"];
                    $tip = $row["booki_tip"];
                    $supply = $row["booki_supply"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try  again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: daily_tr.php");
        exit();
    }

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <script src="/jquery/dist/jquery.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: left; }
          input[type=text], input[type=tel], input[date]{
                width: 50%;
          }
    </style>
</head>
<body>
   
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" readonly="readonly">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($cassh_err)) ? 'has-error' : ''; ?>">
                            <label>Cash</label>
                            <input type="tel" name="cassh" class="form-control" value="<?php echo $cassh; ?>" autocomplete="off">
                            <span class="help-block"><?php echo $cassh_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($card_err)) ? 'has-error' : ''; ?>">
                            <label>Card</label>
                            <input type="tel" name="card" class="form-control" value="<?php echo $card; ?>" autocomplete="off">
                            <span class="help-block"><?php echo $card_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($tip_err)) ? 'has-error' : ''; ?>">
                            <label>Tip</label>
                            <input type="tel" name="tip" class="form-control" value="<?php echo $tip; ?>"autocomplete="off">
                            <span class="help-block"><?php echo $tip_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($supply_err)) ? 'has-error' : ''; ?>">
                            <label>Supply</label>
                            <input type="tel" name="supply" class="form-control" value="<?php echo $supply; ?>" autocomplete="off">
                            <span class="help-block"><?php echo $supply_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Save">
                        <a href="daily_tr.php" class="btn btn-default">Cancel</a>
                    </form>
                
        
</body>
</html>
