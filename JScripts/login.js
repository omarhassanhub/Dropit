function validateform() {
    var uname = document.loginform.logUsername.value;
    var password = document.loginform.logPassword.value;

    if (uname == null || uname == "") {
        alert("Username must not be blank");
        return false;
    } else if (password.length < 4) {
        alert("Password must be at least 4 characters long.");
        return false;
    }
}