<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Inventory Management System </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./includes/style.css">
    <script type="text/javascript" rel="stylesheet" src="./js/main.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Inventory System</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      </nav>

    <div class="overlay"><div class="loader"></div></div>
    <!-- Navabr -->
<?php //include_once("./templates/header.php"); ?>
  <br/><br/>
    <div class="container">
      <?php
          if (isset($_GET["msg"]) AND !empty($_GET["msg"])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <?php echo $_GET["msg"]; ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <?php
          }
       ?>
        <div class="card mx-auto" style="width: 18rem;">
          <img src="./images/forget.png" style="width:60%;" class="card-img-top mx-auto" alt="Login Icon">
          <div class="card-body">
          <form action="forgetPassword.php" method="post" >

            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" name="log_username" id="log_username">
              <small id="e_error" class="form-text text-muted">Please enter the username correctly</small>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" name="log_email" id="log_email">
              <small id="e_error" class="form-text text-muted">Please enter the email correctly</small>
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">New Password</label>
              <input type="password" class="form-control" name="log_password" id="log_password">
              <small id="p_error" class="form-text text-muted"></small>
            </div>

            <button type="submit" name="updatePassword" class="btn btn-primary"><i class="fa fa-lock">&nbsp;</i>Reset Password</button>
            <span><a href="index.php">Login</a></span>

          </form>


    </div>

  </body>
</html>

<?php
include_once("./database/constants.php");

function getInfo(){
  $con = mysqli_connect("localhost", "root", "", "project_inv");
  if(mysqli_connect_errno()){
    die("Failed to connect to MySQL: " .mysqli_connect_error());
  }


  $sqlStr = " select username,email,usertype,register_date,last_login,image from user where email = '".$_POST["log_email"]."' ";
  //echo $sqlStr;

  $qry = mysqli_query($con, $sqlStr);
  mysqli_close($con);
  return $qry;
}

if(isSet($_POST["updatePassword"])){
  		updatePassword();
  	}


function updatePassword(){
  $con = mysqli_connect("localhost", "root", "", "project_inv");

  if(mysqli_connect_errno()){
    die("Failed to connect to MySQL: " .mysqli_connect_error());
  }

  else{
    header("refresh: 3; url=index.php");
    //echo "Connected: ";
  }

  $username = $_POST["log_username"];
  $email = $_POST["log_email"];
  $change_password = $_POST["log_password"];

  $getInfo = getInfo();
  $row = mysqli_fetch_assoc($getInfo);

if ($username != $row["username"] || $email != $row["email"])
{
  echo '<script>alert("Invalid username or email")</script>';
}

else{
  $pass_hash = password_hash($change_password,PASSWORD_BCRYPT,["cost"=>8]);

  $sqlStr = "UPDATE user SET password = '" .$pass_hash. "' WHERE username = '" .$username. "' AND email = '".$email."'";

  //echo $sqlStr;
  mysqli_query($con, $sqlStr);
}

}

?>
