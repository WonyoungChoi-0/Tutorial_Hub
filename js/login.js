const show_password = () => {
    let pwd = document.getElementById("password");
    let pwd_checkbox = document.getElementById("password_checkbox");

    if(pwd_checkbox.checked) {
        pwd.type = "text";
    } else {
        pwd.type = "password"; 
    }
}
