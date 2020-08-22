<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");

//UNTUK REGISTER PUNYA PROCESS
if (isset($_POST["username"]) AND isset($_POST["email"])) {
  $user = new User();
  $result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
  echo $result;
  exit();
}


//UNTUK LOGIN PUNYA process

if (isset($_POST["log_email"]) AND isset($_POST["log_password"]) AND isset($_POST["log_usertype"])) {
  $user = new User();
  $result = $user->userLogin($_POST["log_email"],$_POST["log_password"],$_POST["log_usertype"]);
  echo $result;
  exit();
}


//untuk dapatkan category_name
if (isset($_POST["getCategory"])) {
  $obj = new DBOperation();
  $rows = $obj->getAllRecord("categories");

  foreach ($rows as $row) {
    echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
  }
  exit();
}

//ADD Category
if (isset($_POST["category_name"]) AND isset($_POST["parent_cat"])) {
  $obj = new DBOperation();
  $result = $obj->addCategory($_POST["parent_cat"],$_POST["category_name"]);
  echo $result;
  exit();
}


//ADD Brand
if (isset($_POST['brand_name'])) {
  $obj = new DBOperation();
  $result = $obj->addBrand($_POST["brand_name"]);
  echo $result;
  exit();
}
?>
