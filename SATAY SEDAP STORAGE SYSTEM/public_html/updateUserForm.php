<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
<br><br>
    <div class="container">
    <div class="card mx-auto" style="width: 30rem;">
    <div class="card-header">Change Profile</div>
    <div class="card-body">

    <form action='updateUserForm.php' enctype="multipart/form-data" method='POST'>


    <div class="form-group">
      <label >Profile Picture</label>
      <div class="input-group mb-3">
        <div class="custom-file">
          <input type="file" name="image" >
        </div>
          <button type="submit" name="updateImage" class="input-group-text">Upload Image</button>
      </div>
    </div>

      <div class="form-group">
        <label >Username</label>
        <input type="text" class="form-control" name="change_username" id="change_username">
        <small id="e_error" class="form-text text-muted"></small>
        <button type="submit" name="updateUsername" class="btn btn-primary">Change Username</button>
      </div>

      <div class="form-group">
        <label >Password</label>
        <input type="password" class="form-control" name="change_password" id="change_password">
        <small id="p_error" class="form-text text-muted"></small>
        <button type="submit" name="updatePassword" class="btn btn-primary">Change Password</button>
      </div>


    </form>
  </div>
  </div>
  </div>

  </body>
</html>

<?php
include_once("./database/constants.php");

if(isSet($_POST["updateUsername"])){
		updateUsername();
	}

if(isSet($_POST["updatePassword"])){
  		updatePassword();
  	}

if(isSet($_POST["updateImage"])){
      updateImage();
    }



function updateUsername(){
  $con = mysqli_connect("localhost", "root", "", "project_inv");

  if(mysqli_connect_errno()){
    die("Failed to connect to MySQL: " .mysqli_connect_error());
  }

  else{
    header("refresh: 3; url=profilePage.php");
    //echo "Connected: ";
  }

  $change_username = $_POST["change_username"];
  $change_password = $_POST["change_password"];
  $userChange = $_SESSION["userid"];


  $sqlStr = "UPDATE user SET username = '" .$change_username. "' WHERE id = '" .$userChange. "'";

  //echo $sqlStr;
  mysqli_query($con, $sqlStr);


}




function updatePassword(){
  $con = mysqli_connect("localhost", "root", "", "project_inv");

  if(mysqli_connect_errno()){
    die("Failed to connect to MySQL: " .mysqli_connect_error());
  }

  else{
    header("refresh: 3; url=profilePage.php");
    //echo "Connected: ";
  }

  $change_username = $_POST["change_username"];
  $change_password = $_POST["change_password"];
  $userChange = $_SESSION["userid"];
  $pass_hash = password_hash($change_password,PASSWORD_BCRYPT,["cost"=>8]);

  $sqlStr = "UPDATE user SET password = '" .$pass_hash. "' WHERE id = '" .$userChange. "'";

  //echo $sqlStr;
  mysqli_query($con, $sqlStr);


}




  function updateImage(){

    $con = mysqli_connect("localhost", "root", "", "project_inv");

    if(mysqli_connect_errno()){
      die("Failed to connect to MySQL: " .mysqli_connect_error());
    }

    else{
      header("refresh: 3; url=profilePage.php");
      //echo "Connected: ";
    }

    $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $userChange = $_SESSION["userid"];

    $sqlStr = "UPDATE user set image = '".$file."' WHERE id = '" .$userChange. "'";

    //echo $sqlStr;
    if(mysqli_query($con, $sqlStr))
    {
      //echo "<script> alert('image is uploaded')</script>";
    }

  }
?>
