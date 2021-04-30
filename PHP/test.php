<?php
/*if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
{
    $url = "https";
}
else
{
    $url = "http"; 
}  
$url .= "://"; 
$url .= $_SERVER['HTTP_HOST']; 
$url .= $_SERVER['REQUEST_URI']; 
echo $url; */


echo pathinfo($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])["basename"];


?>
   
   