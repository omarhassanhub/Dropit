<?php

require("session.php");
require("connection.php");

$FirstName = $_POST['regFirstName'];
$LastName  = $_POST['regLastName'];
$Email     = $_POST['regEmail'];
$Username  = $_POST['regUsername'];
$Password  = $_POST['regPassword'];
$Confirm   = $_POST['regConfirm'];

$salt      = 'This_is_a_random_key';
$password2 = md5($salt . $Password);

if (preg_match('/[\s|\n|\t|*|@|&|!|"|\'|:|*|<|>]/', $Username)) {
    header("location:../registration.php?error=Special characters not allowed.");
} else {
    if ($Password == $Confirm) {
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $sql = "Insert into $TB_NAME (FirstName, LastName, Email, Username, Password) values ('$FirstName', '$LastName', '$Email', '$Username', '$password2')";
        if ($mysqli->query($sql) === TRUE) {
            
            chdir("../UserFileDetails");
            mkdir($Username);
            
            echo "Registration successful";
            header("location:../dropbox.php");
        } else {
            echo "Registration unsuccessful";
            header("location:../registration.php?error='".$mysqli->error."'");
        }
        $mysqli->close();
    } else {
        echo "Registration unsuccessful";
    }
}

?>