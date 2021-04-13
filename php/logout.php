<?php
    session_start();
    if(count($_SESSION) > 0) {
        foreach($_SESSION as $k => $v) {
        unset($_SESSION[$k]);
        }
        session_destroy();

        setcookie('PHPSESSID', "", time()-3600, "/"); 
    }
    if(count($_COOKIE) > 0) {
        foreach($_COOKIES as $key=>$value) {
          unset($_COOKIE[$key]); //server side delete, we still need to delete client side
          setcookie($key, '', time()-3600); //client side delete
        }
    }
    header("Location: ../pages/login.php");
    
?>