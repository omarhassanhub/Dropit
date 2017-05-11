<?php
require("uploadVariables.php");
if (isset($_FILES['uploadedFiles'])) {
    if (($_FILES["uploadedFiles"]["allowableLimit"] + $totalDirectorySize) > ($spaceLimit * $byteConvert)) {
        $fault = "This exceeds the limit allowed and cannot be saved";
        header("location:../dropbox.php?fault=$fault");
    } else {
        if ($_FILES["uploadedFiles"]["allowableLimit"] > ($fileLimit * $byteConvert)) {
            $fault = "This file is too large";
            header("location:../dropbox.php?fault=$fault");
        } else {
            if ($_FILES["uploadedFiles"]["fault"] > 0) {
                $fault = "Fault: " . $_FILES["uploadedFiles"]["fault"];
                header("location:../dropbox.php?fault=$fault");
            }
            chdir("../");
            $uploadedFile = $_SESSION['Directory'] . $_SESSION['fullPath'] . '/' . basename($_FILES['uploadedFiles']['name']);
            
            if (move_uploaded_file($_FILES['uploadedFiles']['tmp_name'], $uploadedFile)) {
                echo "File " . basename($_FILES['uploadedFiles']['name']) . " is uploaded to the server";
            } else {
                $fault = "File could not be uploaded due to a fault.";
            }
            header("location:../dropbox.php?fault=$fault");
        }
    }
} else {
    $fault = "No file selected";
    header("location:../dropbox.php?fault=$fault");
}
?>