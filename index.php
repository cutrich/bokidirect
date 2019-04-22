
<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";


?>
<!DOCTYPE html>
<html>
<head>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Transaction</title>
 <link rel="stylesheet" href="/css/style.css">
 <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">

 <script src="/jquery/dist/jquery.min.js"></script>
 <link rel="stylesheet" href="/bootstrap/dist/js/jquery.bootgrid.css" />
 <script src="/bootstrap/dist/js/jquery.bootgrid.min.js"></script>
 <style type="text/css">
    .page-header h2{
        margin-top: 0;
    }
</style>


</head>
<body>
    <div class="container">

        <h2 >Transaction</h2>
        

            <div class="well clearfix">
                <div class="pull-right"><button type="button" class="btn btn-xs btn-primary" id="command-add" data-row-id="0">
                    <span class="glyphicon glyphicon-plus"></span> Record</button>
                </div>
                </div>
                <table id="employee" data-toggle="bootgrid" class="table table-condensed table-hover table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th data-column-id="emp_id" data-type="numeric">Id</th>
                            <th data-column-id="emp_name">Name</th>
                            <th data-column-id="emp_cash">Cash</th>
                            <th data-column-id="emp_card">Card</th>
                            <th data-column-id="emp_tip">Tip</th>
                            <th data-column-id="emp_supply">Supply</th>
                            <th data-column-id="emp_date">Date</th>
                        </tr>
                    </thead>
                </table>

        </div>


    </body>
    </html>
    

<script type="text/javascript">

	
    $( document ).ready(function() {
        $("#employee").bootgrid({
            ajax: true,
            url: "fetch_data.php"
        });
    });
</script>
