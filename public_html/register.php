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
    <script type="text/javascript" src="./js/main.js"></script>
  </head>
  <body>
    <!-- Navabr -->
<?php include_once("./templates/header.php"); ?>
  <br><br>
    <div class="container">
      <div class="card mx-auto" style="width: 30rem;">
  	        <div class="card-header">Register</div>
  		      <div class="card-body">
  		        <form id="register_form" onsubmit="return false" autocomplete="off">

  		          <div class="form-group">
  		            <label for="username">Full Name</label>
  		            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
  		            <small id="u_error" class="form-text text-muted"></small>
  		          </div>

  		          <div class="form-group">
  		            <label for="email">Email address</label>
  		            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
  		            <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
  		          </div>

  		          <div class="form-group">
  		            <label for="password1">Password</label>
  		            <input type="password" name="password1" class="form-control"  id="password1" placeholder="Password">
  		            <small id="p1_error" class="form-text text-muted"></small>
  		          </div>

  		          <div class="form-group">
  		            <label for="password2">Re-enter Password</label>
  		            <input type="password" name="password2" class="form-control"  id="password2" placeholder="Password">
  		            <small id="p2_error" class="form-text text-muted"></small>
  		          </div>

  		          <div class="form-group">
  		            <label for="usertype">Usertype</label>
  		            <select name="usertype" class="form-control" id="usertype">
  		              <option value="">Choose User Type</option>
  		              <option value="Admin">Admin</option>
  		              <option value="Other">Other</option>
  		            </select>
  		            <small id="t_error" class="form-text text-muted"></small>
  		          </div>
  		          <button type="submit" name="user_register" class="btn btn-primary"><span class="fa fa-user"></span>&nbsp;Register</button>
  		          <span><a href="index.php">Login</a></span>

  		        </form>
  		      </div>
  	      <div class="card-footer text-muted"></div>
  	    </div>
    </div>



  </body>
</html>
