<?php

error_reporting(E_ALL ^ E_DEPRECATED);

$link = mysqli_connect("localhost", "root", "", "BannerUS");


// Check connection
if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$username = mysqli_real_escape_string($link,$_POST['username']);     // to get rid of the tricky characters which can destroy the database.
$password = mysqli_real_escape_string($link,$_POST['password']);  // turn into a hash function.
$logintype = $_POST['logintype'];
session_start();
$_SESSION['username'] = $username;
$_SESSION['password'] = $password;


if (isset($_POST['loginBtn']))
{
    if(empty($_POST['username']) || empty($_POST['password']) || $logintype == "Choose..."    )
    {
        echo "<script>alert('You have an empty field.');</script>";
        echo"<script>location.assign('mainpage.html')</script>";  // go back to the login page
    }
   
	$passwordHash = hash('sha3-256' , $password);
    $mysql_result= mysqli_query($link,"SELECT * from PEOPLE WHERE Username = '$username' AND Password = '$password' ");
    $row_cnt = mysqli_num_rows($mysql_result);
    
    if($row_cnt!=1)   // if there is no such user like that.
    {
        echo "<script>alert('The username or the password does not exist in the database');</script>";
        echo"<script>location.assign('mainpage.html')</script>";  // go back to the login page
    }

    else
    {
		$user=mysqli_fetch_array($mysql_result);
		
		if($logintype != $user['Role'])
		{
            $logintype=strtolower($logintype);
			echo"<script>alert('This account does not belong to $logintype. Please try again!');</script>";
			echo"<script>location.assign('mainpage.html')</script>";
		}
        echo "<script>alert('You have succesfully entered the system !');</script>";

        if($user['Role'] == "Admin")
		{
			echo"<script>location.assign('admin.html')</script>";  // go to the Admin Page
		}
        else if($user['Role'] == "Student")
		{
			echo"<script>location.assign('student.html')</script>";  // go to the Student Page
        }
        else
		{
			echo"<script>location.assign('instructor.html')</script>";  // go to the Instructer Page
        }
    }
}

    
?>