function validateform() {
    var fname = document.registerform.regFirstName.value;
    var lname = document.registerform.regLastName.value;
    var email = document.registerform.regEmail.value;

    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");

    var uname = document.registerform.regUsername.value;
    var password = document.registerform.regPassword.value;
    var pconfirm = document.registerform.regConfirm.value;

    if (fname == null || fname == "") {
        alert("First Name must not be blank.");
        return false;

    } else if (lname == null || lname == "") {
        alert("Last Name must not be blank.");
        return false;

    } else if (uname == null || uname == "") {
        alert("User Name must not be blank.");
        return false;

    } else if (password.length < 4) {
        alert("Password must be at least 4 characters long.");
        return false;
    } else if (password != pconfirm) {

        alert("Passwords does not match.");
        return false;
    } else if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
        alert("Not a valid e-mail address");
        return false;
    }


}