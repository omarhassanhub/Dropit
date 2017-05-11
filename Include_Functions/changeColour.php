<?php
session_start();
if (isset($_SESSION['Colour'])) {
    if ($_SESSION['Colour'] == True) {
        $_SESSION['Colour'] = False;
    } else {
        $_SESSION['Colour'] = True;
    }
} else {
    $_SESSION['Colour'] = True;
}
header("location:../dropbox.php");

?>