<?php

session_start();

$old = '../' . $_SESSION['Directory'] . '/' . $_SESSION['fullPath'] . '/' . $_GET['directoryRename'];

$new = '../' . $_SESSION['Directory'] . '/' . $_SESSION['fullPath'] . '/' . $_POST['rename'];

$renameResult = rename($old, $new) or die("Failed to move file");

header("location:../dropbox.php");

if ($renameResult == true) {
    echo $old . " is now named " . $new;
} else {
    echo "Could not rename that file";
}

?>