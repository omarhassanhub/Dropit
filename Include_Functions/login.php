<?php
require("session.php");
require("connection.php");

$Username = $_POST['logUsername'];
$Password = $_POST['logPassword'];

$salt      = 'This_is_a_random_key';
$password2 = md5($salt . $Password);

if ($st = $mysqli->prepare("SELECT * FROM $TB_NAME WHERE Username='$Username' and Password='$password2'")) {
    $st->execute();
    $st->bind_result($Username, $password2);
    
    
    if ($st->fetch() == true) {
        $_SESSION['Details']   = True;
        $_SESSION['Username']  = $Username;
        $_SESSION['fullPath']  = "";
        $_SESSION['Directory'] = 'UserFileDetails/' . $Username;
        
        echo "Login successful";
        header("location:../dropbox.php");
        exit();
    } else {
        $_SESSION['Details'] = False;
        header("location:../index.php?error=Incorrect Username or Password.");
    }
    $st->close();
    
}
$mysqli->close();

?>