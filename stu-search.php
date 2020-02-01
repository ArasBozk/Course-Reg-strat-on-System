<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title>BannerUS | Student</title>
    <link rel="stylesheet" href="./css/instructor_Style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="picture">
     <img src="images\toppic_student.jpeg"  class="d-block w-100 h-100" >
     </div>
    <section id="navBar" >
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="student.html"><img style="max-width:60px; margin-top: -7px;" src="images\student.png"></a>
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
                My Page
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="stu-calendar.php">View My Schedule</a>
                <a class="dropdown-item" href="Stu-V.php">View My Courses</a>
    
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Courses
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="stu-search.php">Search Courses</a>
                <a class="dropdown-item" href="stu-reg-with-course.html">Register/Withdraw Course</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Approvals
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="stu-approval.html">Special Approval</a>
                
              </div>
            </li>



          </ul>
        </div>
        <form class="form-inline" action="admin-logout.php" method="post">
            <button class="btn btn-outline-success my-2 my-sm-0" name="logoutBtn" type="submit">Sign Out</button>
        </form>
      </nav>
    </section>
<br>
      <div class="container">
     <div class="center">

         	<div class="page-header">
	<h4>Find Course Info By Study Level</h4>
		<form action="stu-search.php" method="post">
			<div class="form-group">
			 <select name="sLevel" class="form-control" id="term">
			  <option selected>Select...</option>
				<option value="Un">Undergraduate</option>
				<option value="Gr">Graduate</option>
			  </select>
			</div>
			<button type="submit" name="search" class="btn btn-success">Search</button>
		  </form>
		</div>
      <br>
<?php
error_reporting(E_ALL ^ E_WARNING);
$link = mysqli_connect("localhost", "root", "", "BannerUS");

if(isset($_POST['search']))
{
	$sLevel = $_POST['sLevel'];
	$query = "SELECT * FROM courses";
	$response = mysqli_query($link, $query);
	
	if($sLevel == "Select..."    )
    {
        echo "<script>alert('You have an empty field.');</script>";
        echo"<script>location.assign('stu-search.php')</script>";  // go back to the login page
    }
	
	if($response)
	{
		echo "<table class='table table-striped table-bordered table-hover'>";
				    echo"<thead>";
						echo"<tr>";
							echo"<th>Course Name</th>";
							echo"<th>Course CRN</th>";
							echo"<th>Capacity</th>";
							echo"<th>Description</th>";
						echo"</tr>";
					echo"</thead>";
		while($row = mysqli_fetch_array($response))
		{
			if($row['Level'] == $sLevel)
			{
				echo "<tr>";
				echo "<td>". $row['Name']."</td>";
				echo "<td>". $row['CRN']."</td>";
				echo "<td>". $row['Capacity']."</td>";
				echo "<td>". $row['Description']."</td>";
				echo"</tr>";
			}
		}
	}
	else
	{
		echo "<script>alert('Couldn't issue database query. Something went wrong.');</script>";
		header("Refresh:0; url=stu-search.php");
	}
}
?>

      </div>
          </div>

    <footer>
      <p>BannerUS Community University System Solutions,   Copyright &copy; 2017</p>
    </footer>

  </body>
</html>
