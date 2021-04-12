<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started - Tutorial Hub</title>
    <link rel="stylesheet" type="text/css" href="../styles/register.css">
    <link rel="stylesheet" type="text/css" href="../styles/base.css">
</head>
<body>
    <header>
        <?php include "../components/navbar.php" ?>
    </header>

    <main>
        <div class="register-div">
            <h1>Try Tutorial Hub Now</h1>
            <hr style="margin: auto;">
            <div class="form-container">
                <form onsubmit="return validate_register();">
                    <h3 style="margin-bottom: 3.5%;">Tell us about yourself</h3>
                    <hr>
                    <div class="row" style="margin-bottom: 3.5%;">
                        <div class="col-sm">
                            <label for="exampleInputPassword1" class="form-label">First Name</label>
                            <input type="input" class="form-control" id="first_name" autofocus required> 
                        </div>
                        <div class="col-sm">
                            <label for="exampleInputPassword1" class="form-label">Last Name</label>
                            <input type="input" class="form-control" id="last_name" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password1" required>
                        <span class="error_message" id="msg_password"></span>
                    </div>
                    <div class="form-check" style="margin-top: -5%;">
                        <input type="checkbox" class="form-check-input" id="password_checkbox1" onclick="show_password1();">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                    <div class="mb-3" style="margin-top: 5%;">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" required>
                        <span class="error_message" id="msg_password2"></span>
                    </div>
                    <div class="mb-3 form-check" style="margin-top: -5%;">
                        <input type="checkbox" class="form-check-input" id="password_checkbox2" onclick="show_password2();">
                        <label class="form-check-label" for="exampleCheck1">Show Password</label>
                    </div>
                    <hr>
                    <div style="text-align: center;">
                        <button type="submit" class="header-button btn-green">Get Started</button>
                    </div>
                </form>
              </div>
        </div>
    </main>

    <script src="../js/register.js"></script>
</body>
</html>