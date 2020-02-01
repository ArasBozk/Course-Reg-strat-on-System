<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title>BannerUS | Admin</title>
    <link rel="stylesheet" href="./css/instructor_Style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
      <div class="picture">
      <img src="images\toppic_admin.jpeg"  class="d-block w-100 h-100" >
      </div>
    <section id="navBar" >
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="admin.html"><img style="max-width:60px; margin-top: -7px;" src="images\kursu.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <!--
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Student
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="admin-search.php">Search Courses</a>
                <a class="dropdown-item" href="admin-reg-win.html">Reg./WD Courses</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Instructor
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="admin-view.php">View Courses</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Courses
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="admin-create.html">Create New Course</a>
              </div>
            </li>
              <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                User
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="admin-delete.html">Create-Delete Courses</a>
              </div>
            </li>
          </ul>
        </div>
        <form class="form-inline" action="admin-logout.php" method="post">
            <button class="btn btn-outline-success my-2 my-sm-0" name="logoutBtn" type="submit">Sign Out</button>
        </form>
      </nav>
    </section>
      
      <div class="page-header">
          
            <div class="container">
     <div class="center">
          <br>
		<div class="page-header">
	<h4>Find Courses By Instructor</h4>
		<form action="admin-view.php" method="post"> 
			<div class="form-group">
			  <label for="insID">Instructor ID(Name):</label>
			  <input type="text" class="form-control" name="insName" placeholder="Enter Instructor ID" >
			</div>
			<button type="submit" name="findBtn" class="btn btn-success">Find</button>
		  </form>
		</div>
				</div>	  
          </div>	
      </div>	
      

    <footer>
      <p>BannerUS Community University System Solutions,   Copyright &copy; 2017</p>
    </footer>

  </body>
</html>
         
         
<?php
error_reporting(E_ALL ^ E_WARNING);
$link = mysqli_connect("localhost", "root", "", "BannerUS");

if(isset($_POST['findBtn']))
{	
  $insName = $_POST['insName'];
	$query = "SELECT Course,Instructor FROM INS_COURSE";
	$response = mysqli_query($link, $query);
		
	if($response)
	{
		$row_cnt = mysqli_num_rows($response);
		echo "<table class='table table-striped table-bordered table-hover'>";
				    echo"<thead>";
						echo"<tr>";
							echo"<th>Course Name</th>";
							echo"<th>Course CRN</th>";
							echo"<th>Course Capacity</th>";
							echo"<th>Instructor Name</th>";
						echo"</tr>";
					echo"</thead>";
		while($row = mysqli_fetch_array($response))
		{
			if($row['Instructor'] == $insName)
			{
				$courseid = $row['Course'];
				$res2 = mysqli_query($link, "SELECT * FROM COURSES WHERE CRN = '$courseid'");
				$CN = mysqli_fetch_array($res2);
				echo "<tr>";
				echo "<td>". $CN['Name']."</td>";
				echo "<td>". $row['Course']."</td>";
				echo "<td>". $CN['Capacity']."</td>";
				echo "<td>". $row['Instructor']."</td>";
				echo"</tr>";
			}
			else
			{
				echo "<script>alert('Couldn't find user that you're searching for. Please try again.');</script>";
				header("Refresh:0; url=searchcourse.php");
			}
		}	
	}
	else
	{
		echo "<script>alert('Couldn't issue database query. Something went wrong.');</script>";
		header("Refresh:0; url=searchcourse.php");
	}
		
}
?>