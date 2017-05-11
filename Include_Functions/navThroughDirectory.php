<?php

session_start();
$formerDirectory = False;
$fullPath        = $_SESSION['fullPath'];

while ($formerDirectory == False) {
    if ((substr($fullPath, strlen($fullPath) - 1, strlen($fullPath) - 1) == '/') || ($fullPath == "")) {
        $formerDirectory = True;
    }
    $fullPath = substr($fullPath, 0, strlen($fullPath) - 1);
}
$_SESSION['fullPath'] = $fullPath;

echo $fullPath;
header("location:../dropbox.php");

?>