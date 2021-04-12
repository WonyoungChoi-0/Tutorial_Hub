<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
    case '/':                   // URL (without file name) to a default screen
        require 'landing.php';
        break; 
    case '/dashboard':     // if you plan to also allow a URL with the file name 
        require 'dashboard.php';
        break;              
    case '/login':
        require 'login.php';
        break;
    case '/module_page':
        require 'module_page.php';
        break;
    case '/register':
        require 'register.php';
        break;
    default:
        http_response_code(404);
        exit('Not Found');
}  
?>