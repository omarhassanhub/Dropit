<?php
session_start();
$directoryName = $_GET['directoryDelete'];
$Directory     = $_SESSION['Directory'] . $_SESSION['fullPath'] . '/' . $directoryName;
chdir("../");

function Delete($Directory)
{
    if (is_dir($Directory) === true) {
        $files = array_diff(scandir($Directory), array(
            '.',
            '..'
        ));
        
        foreach ($files as $file) {
            Delete(realpath($Directory) . '/' . $file);
        }
        
        return rmdir($Directory);
    }
    
    else if (is_file($Directory) === true) {
        return unlink($Directory);
    }
    
    return false;
}
Delete($Directory);
header("location:../dropbox.php");
?>