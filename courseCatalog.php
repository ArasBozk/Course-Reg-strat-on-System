<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
 <style>
.button {
  display: inline-block;
  padding: 15px 25px;
  font-size: 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}
</style>
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
        <a class="navbar-brand" href="mainpage.html"><img style="max-width:60px; margin-top: -7px;" src="images\student.png"></a>
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
      </nav>
    </section>



    <div class="container">




		<center><h4>Select Term:</h4>
		<form action="courseCatalog.php" method="post"> 
		 <select name="cTerm" class="form-control" id="time">
							 <option selected value= "Select Term...">Select Term...</option>
							 <option value= "2018-2019">2018-2019</option>
							 <option value= "2017-2018">2017-2018</option>
							 <option value= "2016-2017">2016-2017</option>
							 <option value= "2015-2016">2015-2016</option>
							 <option value= "2014-2015">2014-2015</option>
							 <option value= "2013-2014">2013-2014</option>
							 </select>
							<button class="button" name = "submitBtn">Submit</button>
							</form></center>
							<br>
					    
					
<?php

	if(isset($_POST['submitBtn']))
	{
		$link = mysqli_connect("localhost", "root", "", "BannerUS");
		$cTerm = $_POST['cTerm'];
		
		if($cTerm == "Select Term...")
		{
			echo "<script>alert('There are empty field/s try again!');</script>";
			header("Refresh:0; url=courseCatalog.php");	
		}
		else
		{
			$query = "SELECT * FROM courses";
			$result = mysqli_query($link, $query);
			
			$query2 = "SELECT * FROM courses WHERE Term = '$cTerm'";
			$result2 = mysqli_query($link, $query2);		
			$row_cnt2 = mysqli_num_rows($result2);
			if($row_cnt2 == 0)
			{
				echo "<script>alert('No course exists in that term.');</script>";
				header("Refresh:0; url=courseCatalog.php");	
			}
			
			echo "<table class='table table-striped table-bordered table-hover'>";
						echo"<thead>";
							echo"<tr>";
								echo"<th>Course Name</th>";
								echo"<th>Course CRN</th>";
								echo"<th>Capacity</th>";
								echo"<th>Level</th>";
								echo"<th>Description</th>";
							echo"</tr>";
						echo"</thead>";

			while($row = mysqli_fetch_array($result))
			{
				if($row['Term'] == $cTerm)
				{
					echo "<tr>";
					echo "<td>". $row['Name']."</td>";
					echo "<td>". $row['CRN']."</td>";
					echo "<td>". $row['Capacity']."</td>";
					echo "<td>". $row['Level']."</td>";
					echo "<td>". $row['Description']."</td>";
					echo"</tr>";
				}
			}
		}
	}
?>
	

          </div>

    <footer>
      <p>BannerUsCommunity University System Solutions,   Copyright &copy; 2017</p>
    </footer>

  </body>
</html>
