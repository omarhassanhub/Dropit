<?php

require("encrypt.php");
$fileName   = $_GET['decrypt'];
$pathOfFile = '../' . $_SESSION['Directory'] . '/' . $_SESSION['fullPath'] . '/' . $fileName;
$obj = new Cryptography();
$obj->Decrypt($pathOfFile,$pathOfFile);

header("location:../dropbox.php");

?>