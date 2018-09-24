<?php
header('Access-Control-Allow-Origin: *');
include_once"conect.php";
session_start();
session_destroy();
header ("location: index.php");
 ?>
