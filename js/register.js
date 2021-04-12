const validate_register = () => {
    let pass1 = document.getElementById("password1");
    let pass2 = document.getElementById("password2");
    document.getElementById("msg_password").innerHTML = "";
    document.getElementById("msg_password2").innerHTML = "";

    if(pass1.value.length < 8) {
        document.getElementById("msg_password").innerHTML = "Password must be greater than 8 characters";
        return false;
    }

    if(!(pass1.value === pass2.value)) {
        document.getElementById("msg_password2").innerHTML = "Passwords must match";
        return false;
    }
    return true;
}


const show_password1 = () => {
    let pwd = document.getElementById("password1");
    let pwd_checkbox = document.getElementById("password_checkbox1");

    if(pwd_checkbox.checked) {
        pwd.type = "text";
    } else {
        pwd.type = "password"; 
    }
}

const show_password2 = () => {
    let pwd = document.getElementById("password2");
    let pwd_checkbox = document.getElementById("password_checkbox2");

    if(pwd_checkbox.checked) {
        pwd.type = "text";
    } else {
        pwd.type = "password"; 
    }
}