<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$link = mysqli_connect("localhost", "root", "", "BannerUS");


// Check connection
if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

	echo"<script>location.assign('mainpage.html')</script>";  // go back to the login page

?>	