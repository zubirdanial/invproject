<?php
include_once("../database/constants.php");
include_once("user.php");

//UNTUK REGISTER PUNYA PROCESS
if (isset($_POST["username"]) AND isset($_POST["email"])) {
  $user = new User();
  $result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
  echo $result;
}


//UNTUK LOGIN PUNYA process

if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
  $user = new User();
  $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
  echo $result;
}
?>
