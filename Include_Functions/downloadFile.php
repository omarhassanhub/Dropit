<?php
session_start();
$fileName   = $_GET['downloadFile'];
$pathOfFile = '../' . $_SESSION['Directory'] . '/' . $_SESSION['fullPath'] . '/' . $fileName;

$file = $pathOfFile . $filename;
if (headers_sent()) {
    echo 'HTTP header already sent';
} else {
    if (!is_file($file)) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        echo 'File cannot be found';
    } else if (!is_readable($file)) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
        echo 'File cannot be read';
    } else {
        while (ob_get_level()) {
            ob_end_clean();
        }
        ob_start();
        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length: " . filesize($file));
        header('Pragma: no-cache');
        header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
        ob_flush();
        ob_clean();
        readfile($file);
        exit;
    }
}
?>