<?php
session_start();
$fileName   = $_GET['fileDelete'];
$pathOfFile = '../' . $_SESSION['Directory'] . '/' . $_SESSION['fullPath'] . '/' . $fileName;
unlink($pathOfFile);
header("location:../dropbox.php");
?>