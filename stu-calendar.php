<?php
        session_start();
		$username = $_SESSION['username'];
	?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <title>BannerUS | Student</title>
    <link rel="stylesheet" href="./css/calendar.css">
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
                  <a class="dropdown-item" href="">View My Grades</a>
                  <a class="dropdown-item" href="">Generate Transkript</a>
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
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sign Out</button>
          </form>
        </nav>
      </section>
      <form action="stu-calendar.php" method="post">
			<div class="form-group">
			</div>
			<button type="submit" name="ButtonX" class="btn btn-success">Search</button>
		  </form>

      <br>
      <center><h4>Weekly Schedule</h4></center>
      <br>

      <?php
        error_reporting(E_ALL ^ E_WARNING);
        $link = mysqli_connect("localhost", "root", "", "bannerus");
 

        if(isset($_POST['ButtonX'])){ 
        $query = "SELECT TS.time_index,CT.Course FROM stu_course SC, course_time CT, time_slots TS 
        WHERE SC.Student = '$username' AND SC.Course = CT.Course AND CT.Time_D_H = TS.time_D_H
        ORDER BY TS.time_index ASC";
        $response = mysqli_query($link, $query);

        if($response)
        {
          
          echo "<table class='calendar table table-bordered' align='center'>";
              echo"<thead>";
              echo"<tr>";
                echo"<th>&nbsp;</th>";
                echo"<th width='20%'>Monday</th>";
                echo"<th width='20%'>Tuesday</th>";
                echo"<th width='20%'>Wednesday</th>";
                echo"<th width='20%'>Thursday</th>";
                echo"<th width='20%'>Friday</th>";
              echo"</tr>";
            echo"</thead>";

          $i = 0;
          while($row = mysqli_fetch_array($response))
          {
            $check = 0 ;
            while($i < 72)
            {
              if($i == 0){echo "<tr>";echo"<td>08:40</td>";$check = 1 ;}
              if($i == 6){echo"</tr>";echo "<tr>";echo"<td>09:40</td>";$check = 1 ;}
              if($i == 12){echo"</tr>";echo "<tr>";echo"<td>10:40</td>";$check = 1 ;}
              if($i == 18){echo"</tr>";echo "<tr>";echo"<td>11:40</td>";$check = 1 ;}
              if($i == 24){echo"</tr>";echo "<tr>";echo"<td>12:40</td>";$check = 1 ;}
              if($i == 30){echo"</tr>";echo "<tr>";echo"<td>13:40</td>";$check = 1 ;}
              if($i == 36){echo"</tr>";echo "<tr>";echo"<td>14:40</td>";$check = 1 ;}
              if($i == 42){echo"</tr>";echo "<tr>";echo"<td>15:40</td>";$check = 1 ;}
              if($i == 48){echo"</tr>";echo "<tr>";echo"<td>16:40</td>";$check = 1 ;}
              if($i == 54){echo"</tr>";echo "<tr>";echo"<td>17:40</td>";$check = 1 ;}
              if($i == 60){echo"</tr>";echo "<tr>";echo"<td>18:40</td>";$check = 1 ;}
              if($i == 66){echo"</tr>";echo "<tr>";echo"<td>19:40</td>";$check = 1 ;}

              if($row['time_index'] == $i)
              {
                $courseid = $row['Course'];
                $res2 = mysqli_query($link, "SELECT Name FROM courses WHERE CRN = '$courseid'");
                $CN = mysqli_fetch_array($res2);

                echo"<td class= 'has-events' rowspan='1'>";
                  echo"<div class='row-fluid lecture' style='width: 99%; height: 100%;' align='center' >". $CN['Name'] ."</div>";
                echo"</td>";
                $i++;
                break;
              }
              else if($check == 0)
              {
                echo"<td class='no-events' rowspan='1'></td>";
              }
              $i++;
              $check = 0 ;

            }
            
          }
          $check = 0 ;
          while($i < 72)
          {
            if($i == 0){echo "<tr>";echo"<td>08:40</td>";$check = 1 ;}
            if($i == 6){echo"</tr>";echo "<tr>";echo"<td>09:40</td>";$check = 1 ;}
            if($i == 12){echo"</tr>";echo "<tr>";echo"<td>10:40</td>";$check = 1 ;}
            if($i == 18){echo"</tr>";echo "<tr>";echo"<td>11:40</td>";$check = 1 ;}
            if($i == 24){echo"</tr>";echo "<tr>";echo"<td>12:40</td>";$check = 1 ;}
            if($i == 30){echo"</tr>";echo "<tr>";echo"<td>13:40</td>";$check = 1 ;}
            if($i == 36){echo"</tr>";echo "<tr>";echo"<td>14:40</td>";$check = 1 ;}
            if($i == 42){echo"</tr>";echo "<tr>";echo"<td>15:40</td>";$check = 1 ;}
            if($i == 48){echo"</tr>";echo "<tr>";echo"<td>16:40</td>";$check = 1 ;}
            if($i == 54){echo"</tr>";echo "<tr>";echo"<td>17:40</td>";$check = 1 ;}
            if($i == 60){echo"</tr>";echo "<tr>";echo"<td>18:40</td>";$check = 1 ;}
            if($i == 66){echo"</tr>";echo "<tr>";echo"<td>19:40</td>";$check = 1 ;}

            if($check == 0)
            {
              echo"<td class='no-events' rowspan='1'></td>";
            }
            $i++;
            $check = 0 ;

          }
        }
        else
        {
          echo "<script>alert('Couldn't issue database query. Something went wrong.');</script>";
          header("Refresh:0; url=admin-search.php");
        }
        echo"</tr>";
        }
      ?>


    <footer>
      <p>BannerUsCommunity University System Solutions,   Copyright &copy; 2017</p>
    </footer>

  </body>
</html>
