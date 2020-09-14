<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Profile Page </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./includes/style.css">
    <script type="text/javascript" rel="stylesheet" src="./js/main.js"></script>
  </head>
  <body>
    <?php include_once("./templates/header.php"); ?>


    <?php
    include_once("./database/constants.php");
    echo "<br>";
    echo "<br>";



  function emailSeach(){
		$con = mysqli_connect("localhost", "root", "", "project_inv");
		if(mysqli_connect_errno()){
			die("Failed to connect to MySQL: " .mysqli_connect_error());
		}

		$userSeach = $_SESSION["userid"];
		$sqlStr = " select username,email,usertype,register_date,last_login,image from user where id LIKE '%" .$userSeach."%'";
		//echo $sqlStr;

		$qry = mysqli_query($con, $sqlStr);
		mysqli_close($con);
		return $qry;
	}

  function getImage(){
		$con = mysqli_connect("localhost", "root", "", "project_inv");
		if(mysqli_connect_errno()){
			die("Failed to connect to MySQL: " .mysqli_connect_error());
		}

		$userSeach = $_SESSION["userid"];
		$sqlStr = " select username,email,usertype,register_date,last_login,image from user where id LIKE '%" .$userSeach."%'";
		//echo $sqlStr;

		$qry = mysqli_query($con, $sqlStr);
		mysqli_close($con);
		return $qry;
	}

  $userList = emailSeach();
  $getImage = getImage();
  $row = mysqli_fetch_assoc($getImage);

 ?>
 <div class="card mx-auto" style="width: 18rem;">
  <center> <?php echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image" style="width: 150px; height: 150px>"'; ?> </center>
   <div class="card-body">
    <center> <p class="card-text">Profile Picture</p> </center>
   </div>
 </div>
 <br>


 <?php

	echo '<div class="container">';
	echo "<table class='table table-striped table-bordered'>";
	$bil = 1;

	echo "<tr>
			<th>Username</th>
			<th>Customer Email</th>
      <th>Register Date</th>
      <th>Last Login</th>
			<th>Update</th>
		</tr>";

	while($row = mysqli_fetch_assoc($userList)){
		echo "<tr>";
		$username = $row["username"];
			echo "<td scope='col'>" .$row["username"]. "</td>";
			echo "<td scope='col'>" .$row["email"]. "</td>";
      echo "<td scope='col'>" .$row["register_date"]. "</td>";
			echo "<td scope='col'>" .$row["last_login"]. "</td>";

      /*echo "<td scope='col'>";
      echo '<img src="data:image;base64,'.base64_encode($row['image']).'" alt="Image" style="width: 100px; height: 100px>"';
      echo "</td>";*/

			echo "<td>";
				echo "<form action='updateUserForm.php' method='POST'>";
				echo "<input type='hidden' value='$username' name='usernameToUpdate'>";
				echo "<input class='btn btn-warning btn-block' type='submit' name='updateUserButton' value='Edit Profile'>";
				echo "</form>";
			echo "</td>";
		echo "</tr>";
		$bil++;
	}
	echo "</table>";
echo "</div>";
echo "<div class='container'>";


echo "</div>";
?>


  </body>
</html>
