<?php
session_start();
if (isset($_SESSION['Username'])) {
    unset($_SESSION['Username']);
    $_SESSION['Details'] = False;
}
header("location:../index.php");

?>