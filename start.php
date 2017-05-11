<?php
if (!isset($_SESSION)) {
    session_start();
}
$colour = 'purple';

if (isset($_SESSION['Colour'])) {
    if ($_SESSION['Colour'] == False) {
        $colour = 'white';
    }
}
echo "<link href=\"css/style_$colour.css\" rel=\"stylesheet\" type=\"text/css\" />";
?>