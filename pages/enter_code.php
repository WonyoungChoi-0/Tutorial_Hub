<?php 
session_start();
require("../database/connect-db.php");

if (isset($_POST['submit'])){	
   $code = strtoupper($_POST['code']);
   header('Location: ./viewpage.php?index=1&code=' . "$code");
   exit();
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Enter Code | Tutorial Hub</title>
        <link rel="stylesheet" type="text/css" href="../styles/enter_code.css">
        <link rel="stylesheet" type="text/css" href="../styles/base.css">
</head>

<body>
    <?php require("../components/navbar.php"); ?>

    <div class="header-div">
        <h1>Enter Your 4 Character Code Below</h1>
        <hr style="margin: auto;">

        <div class="form-container"> 
            <form  action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <div class="row" style="margin-bottom: 3.5%;">
                    <div class="col-sm">     
                        <label for="code" class="form-label">Code</label>
                        <input type="input" class="form-control" id="code" name="code" autofocus required> 
                    </div>
                </div>
                <input type="submit" name="submit" class="button-submit btn-secondary" value="View">
            </form>
        </div>
    </div>
</body>


</html>