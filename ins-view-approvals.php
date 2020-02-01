<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title>BannerUS | Instructor</title>
    <link rel="stylesheet" href="./css/instructor_Style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
      <div class="picture">
      <img src="images\toppic_ins.jpeg"  class="d-block w-100 h-100" >
      </div>
      
		  
	  
    <section id="navBar" >
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand"><img style="max-width:60px; margin-top: -7px;" src="images\professor.png"></a>
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
                My Courses
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="ins-get-courses.php">View All Courses</a>
                <a class="dropdown-item" href="ins-create.html">Create Course</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Pending Requests
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">View All Requests</a>
              </div>
            </li>
         
          </ul>
        </div>
        <form class="form-inline" action="admin-logout.php" method="post">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign Out</button>
        </form>
      </nav>
    </section>
	
	<?php
	$link = mysqli_connect("localhost", "root", "", "BannerUS");
	$che = true;
	session_start();
	$username = $_SESSION['username'];

	$query = "SELECT * FROM ins_course WHERE Instructor = '$username'";
	$result = mysqli_query($link, $query);
	
				echo "<table class='table table-striped table-bordered table-hover' id='myTable'>";
						echo"<thead>";
							echo"<tr>";
								echo"<th>Course</th>";
								echo"<th>Request Description</th>";
								echo"<th>Student Name</th>";
								echo"<th>Status</th>";
								echo"</tr>";
						echo"</thead>";

	while($row = mysqli_fetch_array($result))
	{
		$ccrn = $row['Course'];
		$query2 = "SELECT * FROM special_request WHERE Course = '$ccrn'";
		$result2 = mysqli_query($link, $query2);
		
		while($row2 = mysqli_fetch_array($result2))
		{
			$ccrn2 = $row2['Course'];
			$query3 = "SELECT * FROM courses WHERE CRN = '$ccrn2'";
			$result3 = mysqli_query($link, $query3);
			
			while($row3 = mysqli_fetch_array($result3))
			{
				echo "<tr>";
				echo "<td>". $row3['Name']."</td>";
				echo "<td>". $row2['Description']."</td>";
				echo "<td>". $row2['Name']."</td>";
				echo "<td><form action='ins-view-approvals.php' method='post'><button onclick='myFunction' class = 'btn btn-success' name='approveBtn'>Approve</button> &nbsp; <button onclick='myFunction'  class = 'btn btn-danger' name='denyBtn'>Deny</button></form></td>";
				echo"</tr>";
			
				$course_n = $row3['Name'];
				$stu_n = $row2['Name'];
				
				if(isset($_POST['approveBtn']))
				{
					$mysql_result= mysqli_query($link,"SELECT * FROM special_request WHERE Course = '$course_n' AND Name ='$stu_n'");
					$row_arr = mysqli_fetch_array($mysql_result);

					$res1= mysqli_query($link,"UPDATE `courses` SET `approval_needed` = '0' WHERE CRN = '$ccrn2'");
												
					if($res1)
					{
						echo "<script>alert('Approval successful.');</script>";
						header("Refresh:0; url=ins-view-approvals.php");
						break;						
					}
					break;	
				}
				if(isset($_POST['denyBtn']))
				{
					
					$res1= mysqli_query($link,"UPDATE `courses` SET `approval_needed` = '1' WHERE CRN = '$ccrn2'");
					echo "<script>alert('Successfully denied.');</script>";
					header("Refresh:0; url=ins-view-approvals.php");	
					break;
				}
			}
		}
	}
	
?>

    <footer>
      <p>BannerUS Community University System Solutions,   Copyright &copy; 2017</p>
    </footer>
<script>
		function myFunction() {
		  document.getElementById("myTable").deleteRow(0);
		}
		</script>

  </body>
</html>