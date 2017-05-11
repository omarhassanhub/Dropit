<!DOCTYPE html>
<html>
<head>
<title>DropIt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  
  <script type="text/JavaScript">
		function createDirectory() {
			var link="Include_Functions/createDirectory.php?createDirectory=";
			link += document.getElementById('directoryName').value;
			window.location = link;
		}
   </script>
	
		
		
	
<?php
include 'start.php';


$grantUser = false;
if (isset($_SESSION['Details']) == True) {
    $verifyUser = $_SESSION['Details'];
    if ($verifyUser == True) {
        $grantUser = True;
    }
}
if ($grantUser == False) {
    header("Location: index.php");
    exit;
}
?>
   
    <?php
$totalSize   = 0;
$spaceLimit  = 31457280;
$byteConvert = 1048576;
$totalSize   = directorySize($_SESSION['Directory']);

function directorySize($fullPath)
{
    $getTotalSize = 0;
    $readFiles    = scandir($fullPath);
    $clearPath    = rtrim($fullPath, '/') . '/';
    
    foreach ($readFiles as $rd) {
        if ($rd <> "." && $rd <> "..") {
            $selectedFile = $clearPath . $rd;
            if (is_dir($selectedFile)) {
                $determineSize = directorySize($selectedFile);
                $getTotalSize += $determineSize;
            } else {
                $determineSize = filesize($selectedFile);
                $getTotalSize += $determineSize;
            }
        }
    }
    return $getTotalSize;
}

echo "<form id = \"dropbox\" action=\"Include_Functions/fileUpload.php?totalSize=$totalSize\" method=\"post\" enctype=\"multipart/form-data\">";
?>

</head>

<body class="markermenu">

<div class="container">
<div >
  
  <div align="right">
  <br/>
  <?php

$verifyUser = false;
if (isset($_SESSION['Details']) == True) {
    $verifyUser = $_SESSION['Details'];
    if ($verifyUser == True) {
        $displayUserName = "";
        
        $displayUserName .= "Logged in as: <b>" . $_SESSION['Username'] . "</b>, <a href=\"Include_Functions/userLogout.php\">logout</a> ";
        $displayUserName .= " <a href=\"Include_Functions/changeColour.php\">[Change Theme]</a>";
        echo $displayUserName;
    }
}
if ($verifyUser == False) {
    echo "<a href=\"index.php\">Log in</a> | <a href=\"registration.php\">Register</a>";
}
?>
		
</div><br/>
<div class="logo"><a href="dropbox.php"><img src="css/Images/drop.png"></img></a></div>
<h2>DropIt</h2>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-md-2" >
<div id="leftcolumn">
<li>

<?php

echo "<li><strong> Space Left:</strong></li>";
echo "<li> Total: " . $spaceLimit / $byteConvert . 'Mb' . "</li>";
echo "<li> Used: " . round($totalSize / $byteConvert) . 'Mb' . "</li>";

?>
</li>
</div>
</div>
<div class="col-md-2">
   <input type="file" name="uploadedFiles" id="uploadedFiles" >
</div>
<div class="col-md-4">
   <input type="submit" name="submit" value="Upload"/>
</div>
<div class="col-md-6" >
   <br/>
   <input type="text" id="directoryName" name="directoryName" value="New" size="8">
   <a href="#" id="btn4" onclick="createDirectory();" >New Folder</a>
</div>
<div class="col-md-10">
<br/>
<table id="t01">
<tr>
   <th>Name</th>
   <th>Delete</th>
   <th>Rename</th>
   <th>Encrypt</th>
   <th>Decrypt</th>
   
	<?php

$readFiles = array();

$Directory = @opendir($_SESSION['Directory'] . $_SESSION['fullPath']);

while ($readFile = @readdir($Directory)) {
    if (!is_dir($_SESSION['Directory'] . $_SESSION['fullPath'] . $readFile)) {
        
        $readFiles[] = $readFile;
    }
}

@closedir($Directory);
sort($readFiles);
$Display = '';

$Display .= '<table id="myTableData">';

if ($_SESSION['fullPath'] != "") {
    $Display .= '<tr><a href=Include_Functions/navThroughDirectory.php> < Back</a></tr><tr>';
}

if (count($readFiles) == 0) {
    $Display .= "<tr><td>Upload a file or add a new folder</td></tr>";
} else {
    for ($i = 0; $i < count($readFiles); $i++) {
        $downloadButton = "";
        $deleteButton   = "";
        $renameButton   = "";
		$encryptButton   = "";
		$decryptButton   = "";
        $file_extension = pathinfo($readFiles[$i], PATHINFO_EXTENSION);
        
        if (is_dir($_SESSION['Directory'] . $_SESSION['fullPath'] . '/' . $readFiles[$i])) {
            $downloadButton = "Include_Functions/alterDirectory.php?fullPath=$readFiles[$i]";
            $deleteButton   = "Include_Functions/directoryDelete.php?directoryDelete=$readFiles[$i]";
            $renameButton   = "Include_Functions/directoryRename.php?directoryRename=$readFiles[$i]";
			
            
        } else {
            $downloadButton = "Include_Functions/downloadFile.php?downloadFile=$readFiles[$i]";
            $deleteButton   = "Include_Functions/fileDelete.php?fileDelete=$readFiles[$i]";
            $renameButton   = "Include_Functions/fileRename.php?fileRename=$readFiles[$i]";
			$encryptButton   = "Include_Functions/encrypt.php?encrypt=$readFiles[$i]";
			$decryptButton   = "Include_Functions/decrypt.php?decrypt=$readFiles[$i]";
        }
        $Display .= "<td ><a href=\"$downloadButton\">" . $readFiles[$i] . "</a></td> 
            <td><a href=\"$deleteButton\">Delete</a></td>
            <td>
            <form action=\"$renameButton\" method=\"post\" name=\"rename_form\">
            <input type=\"text\" id=\"rename\" name=\"rename\" value=\"" . ".$file_extension\" size=\"8\">
            
            <input type=\"submit\" name=\"submit\" value=\"Rename\">
            </form>
            </td>
            <td><a href=\"$encryptButton\">Encrypt</a></td>
            <td><a href=\"$decryptButton\">Decrypt</a></td>    
            
            </tr>";
        
    }
}
$Display .= "</table>";
echo $Display;

?>

</tr>
</table>
</div>
<br/>
</div>
</div>
<div class="container">
   <div >
      <hr/>
      <ul id="navfooter" align="center">
         <li><a href="index.php">Home</a>
         </li>
         <li>|
         </li>
         <li><a href="about.php">About</a>
         </li>
         <br/><br/>
         <li>&copy; 2014 DropIt
         </li>
      </ul>
   </div>
</div>
</body>
</html>