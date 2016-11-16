<?php
header('Content-Type: text/html');

$file = file_get_contents('https://www.pinterest.com/SurfingChef/pins/');
echo $file;

?>
