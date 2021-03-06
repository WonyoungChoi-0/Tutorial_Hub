<?php 
session_start();
require("../database/connect-db.php");

function isValidCredentials($email, $password) {
    global $db; 

    $query = "SELECT * FROM users";

    $statement = $db->prepare($query);
    $statement->execute();
    
    $results = $statement->fetchAll(); //fetch() returns 1 row 

    $statement->closeCursor(); // release the lock 
    foreach($results as $result) {
        if($result['email'] == $email && $result['password'] == $password) {
            $_SESSION['firstName'] = $result['firstName'];
            $_SESSION['lastName'] = $result['lastName'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['userID'] = $result['userID'];
            setcookie('firstName', $result['firstName'], time() + 3600);
            setcookie('lastName', $result['lastName'], time() + 3600);
            setcookie('email', $result['email'], time() + 3600);
            setcookie('userID', $result['userID'], time() + 3600);
            return True;
        }
    }
    return False;
}

function authenticate() {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = hash("md5", $_POST['password']);

        if(isValidCredentials($email, $password)) {
            header("Location: ./dashboard.php");
        } 
    }
}

authenticate();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tutorial Hub</title>
    <link rel="stylesheet" type="text/css" href="../styles/login.css">
    <link rel="stylesheet" type="text/css" href="../styles/base.css">
</head>
<body>
    <header>
        <?php include "../components/navbar.php" ?>
    </header>

    <main>
        <div class="login-div">
            <h1>Try Tutorial Hub Now</h1>
            <hr style="margin: auto;">
            <div class="form-container">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <h3 style="margin-bottom: 3.5%;">Welcome Back</h3>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?php if(!empty($_POST['email'])) echo $_POST['email'] ?>"autofocus required>
                        <span class="error_message" id="msg_email"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <span class="error_message" id="msg_password"></span>
                    </div>
                    <div class="mb-3 form-check" style="margin-top: -10px;">
                        <input type="checkbox" class="form-check-input" id="password_checkbox" onclick="show_password();">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                    <hr>
                    <span class="error_message"><?php if(!empty($_POST['email']) && !isValidCredentials($_POST['email'], hash("md5", $_POST['password']))) echo "Email or password is invalid"?></span>
                    <div style="text-align: center;">
                        <button type="submit" class="header-button btn-green">Login</button>
                    </div>
                </form>
              </div>
        </div>   
    </main>

    <script src="../js/login.js"></script>
</body>
</html>