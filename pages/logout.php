<?php
    session_start();
    if(count($_SESSION) > 0) {
        foreach($_SESSION as $k => $v) {
        unset($_SESSION[$k]);
        }
        session_destroy();

        setcookie('PHPSESSID', "", time()-3600, "/"); 
    }
    if (isset($_COOKIE)) {
        foreach($_COOKIE as $name => $value) {
            setcookie($name, '', 1);
            setcookie($name, '', 1, '/');
        }
    }
    header("Location: ./login.php");
    
?>