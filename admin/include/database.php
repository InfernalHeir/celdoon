<?php

$servername="localhost";
$username="super30a_celdoon";
$password="2LqS69Ernt+=";
$conn= new PDO("mysql:host=$servername;dbname=super30a_celdoon",$username,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
