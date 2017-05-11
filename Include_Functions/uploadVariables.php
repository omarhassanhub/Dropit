<?php
session_start();
$fault              = "";
$totalDirectorySize = $_GET['totalSize'];
$byteConvert        = 1048576;
$fileLimit          = 8;
$spaceLimit         = 30;
?>