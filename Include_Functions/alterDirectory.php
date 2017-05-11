<?php
session_start();

$_SESSION['fullPath'] .= '/' . $_GET['fullPath'];
header("location:../dropbox.php");

?>