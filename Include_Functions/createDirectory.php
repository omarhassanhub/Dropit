<?php
session_start();
$directoryName    = $_GET['createDirectory'];
$setDirectoryPath = $_SESSION['Directory'] . $_SESSION['fullPath'] . '/' . $directoryName;
chdir("../");
if (!is_dir($setDirectoryPath)) {
    mkdir($setDirectoryPath);
}
header("location:../dropbox.php");
?>