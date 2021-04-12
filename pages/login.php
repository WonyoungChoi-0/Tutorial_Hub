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
                <form>
                    <h3 style="margin-bottom: 3.5%;">Welcome Back</h3>
                    <hr>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" autofocus required>
                        <span class="error_message" id="msg_email"></span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" required>
                        <span class="error_message" id="msg_password"></span>
                    </div>
                    <div class="mb-3 form-check" style="margin-top: -10px;">
                        <input type="checkbox" class="form-check-input" id="password_checkbox" onclick="show_password();">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                    <hr>
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