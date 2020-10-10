<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");
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

//untuk dapatkan brand
if (isset($_POST["getBrand"])) {
  $obj = new DBOperation();
  $rows = $obj->getAllRecord("brands");

  foreach ($rows as $row) {
    echo "<option value='".$row["bid"]."'>".$row["brand_name"]."</option>";
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

//ADD Product
if (isset($_POST['added_date']) AND isset($_POST["product_name"])) {
  $obj = new DBOperation();
  $result = $obj->addProduct($_POST["select_cat"],
                            $_POST["select_brand"],
                            $_POST["product_name"],
                            $_POST["product_price"],
                            $_POST["product_qty"],
                            $_POST["added_date"]);
  echo $result;
  exit();
}


//manage category
if (isset($_POST["manageCategory"])){
  $m = new Manage();
  $result = $m-> manageRecordWithPagination("categories");
  $rows = $result["rows"];
  //$pagination = $result["pagination"];
  if (count($rows) > 0 ) {
    //sepatutnya kat bawah ni ada pagination tapi tak jadi
    $n = 0;
    foreach ($rows as $row){
      ?>
      <tr>
          <td><?php echo ++$n; ?></td>
          <td><?php echo $row["category"]; ?></td>
          <td><?php echo $row["parent"]; ?></td>
          <td>
            <a href="#" class="btn btn-success btn-sm">Active</a>
          </td>
          <td>
            <a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>
            <a href="#" eid="<?php echo $row['cid']; ?>"class="btn btn-info btn-sm edit_cat" data-toggle="modal" data-target="#form_category">Update</a>
          </td>
      </tr>
      <?php
    }
    ?>
      <!--<tr>
        <td colspan="5"> <?php //echo $pagination; ?></td>
      </tr>-->
    <?php
    exit();
  }
}

//delete category
if (isset($_POST["deleteCategory"])) {
  $m = new Manage();
  $result = $m ->deleteRecord("categories","cid",$_POST["id"]);
  echo $result;
}

//update category
if (isset($_POST["updateCategory"])) {
  $m = new Manage();
  $result = $m->getSingleRecord("categories","cid",$_POST["id"]);
  echo json_encode($result);
  exit();
}

//update record after gettign data
if (isset($_POST["update_category"])) {
  $m = new Manage();
  $id = $_POST["cid"];
  $name = $_POST["update_category"];
  $parent = $_POST["parent_cat"];
  $result = $m->update_record("categories",["cid"=>$id],["parent_cat"=>$parent,"category_name"=>$name,"status"=>1]);
  echo $result;

  exit();
}


// ----------------------------------- BRAND ------------
//manage brand
if (isset($_POST["manageBrand"])){
  $m = new Manage();
  $result = $m-> manageRecordWithPagination("brands");
  $rows = $result["rows"];
  //$pagination = $result["pagination"];
  if (count($rows) > 0 ) {
    //sepatutnya kat bawah ni ada pagination tapi tak jadi
    $n = 0;
    foreach ($rows as $row){
      ?>
      <tr>
          <td><?php echo ++$n; ?></td>
          <td><?php echo $row["brand_name"]; ?></td>
          <td>
            <a href="#" class="btn btn-success btn-sm">Active</a>
          </td>
          <td>
            <a href="#" did="<?php echo $row['bid']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>
            <a href="#" eid="<?php echo $row['bid']; ?>"class="btn btn-info btn-sm edit_brand" data-toggle="modal" data-target="#form_brand">Update</a>
          </td>
      </tr>
      <?php
    }
    ?>
      <!--<tr>
        <td colspan="5"> <?php //echo $pagination; ?></td>
      </tr>-->
    <?php
    exit();
  }
}

//delete brand
if (isset($_POST["deleteBrand"])) {
  $m = new Manage();
  $result = $m ->deleteRecord("brands","bid",$_POST["id"]);
  echo $result;
}

//update brand
if (isset($_POST["updateBrand"])) {
  $m = new Manage();
  $result = $m->getSingleRecord("brands","bid",$_POST["id"]);
  echo json_encode($result);
  exit();
}

//update brand after gettign data
if (isset($_POST["update_brand"])) {
  $m = new Manage();
  $id = $_POST["bid"];
  $name = $_POST["update_brand"];
  $result = $m->update_record("brands",["bid"=>$id],["brand_name"=>$name,"status"=>1]);
  echo $result;

  exit();
}

//-----------------------Product--------------//
//manage product
if (isset($_POST["manageProduct"])){
  $m = new Manage();
  $result = $m-> manageRecordWithPagination("products");
  $rows = $result["rows"];
  //$pagination = $result["pagination"];
  if (count($rows) > 0 ) {
    //sepatutnya kat bawah ni ada pagination tapi tak jadi
    $n = 0;
    foreach ($rows as $row){
      ?>
      <tr>
          <td><?php echo ++$n; ?></td>
          <td><?php echo $row["product_name"]; ?></td>
          <td><?php echo $row["category_name"]; ?></td>
          <td><?php echo $row["brand_name"]; ?></td>
          <td><?php echo $row["product_price"]; ?></td>
          <td><?php echo $row["product_stock"]; ?></td>
          <td><?php echo $row["added_date"]; ?></td>

          <td>
            <a href="#" class="btn btn-success btn-sm">Active</a>
          </td>
          <td>
            <a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
            <a href="#" eid="<?php echo $row['pid']; ?>"class="btn btn-info btn-sm edit_product" data-toggle="modal" data-target="#form_products">Update</a>
          </td>
      </tr>
      <?php
    }
    ?>
      <!--<tr>
        <td colspan="5"> <?php //echo $pagination; ?></td>
      </tr>-->
    <?php
    exit();
  }
}


//delete product
if (isset($_POST["deleteProduct"])) {
  $m = new Manage();
  $result = $m ->deleteRecord("products","pid",$_POST["id"]);
  echo $result;
}

//update product
if (isset($_POST["updateProduct"])) {
  $m = new Manage();
  $result = $m->getSingleRecord("products","pid",$_POST["id"]);
  echo json_encode($result);
  exit();
}

//update product after gettign data
if (isset($_POST["update_product"])) {
  $m = new Manage();
  $id = $_POST["pid"];
  $name = $_POST["update_product"];
  $cat = $_POST["select_cat"];
  $brand = $_POST["select_brand"];
  $price = $_POST["product_price"];
  $qty = $_POST["product_qty"];
  $date = $_POST["added_date"];
  $result = $m->update_record("products",["pid"=>$id],["cid"=>$cat,"bid"=>$brand,"product_name"=>$name,"product_price"=>$price,"product_stock"=>$qty,"added_date"=>$date]);
  echo $result;

  exit();
}

///////////////////order processing

if(isSet($_POST["getNewOrderItem"])){
  $obj = new DBOperation();
  $rows = $obj->getStoreRecord("products");
  ?>
      <tr>
            <td><b class="number">1</b></td>
            <td>
                <select name="pid[]" class="form-control form-control-sm pid" required>
                  <option value="">Choose Product</option>
                  <?php
                    foreach ($rows as $row) {
                      ?> <option value="<?php echo $row['pid']; ?>"> <?php echo $row["product_name"];?></option> <?php
                    }
                    ?>
                </select>
            </td>
            <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>
            <td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
            <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></span>
            <span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name" ></td>
            <td>RM <span class="amt">0</span> </td>
        </tr>

  <?php
  exit();
}



//Get price and quantity of one Item

if (isSet($_POST["getPriceAndQty"])){
  $m = new Manage();
  $result = $m -> getSingleRecord("products","pid",$_POST["id"]);
  echo json_encode($result);
  exit();
}


if(isset($_POST["order_date"]) AND isset($_POST["cust_name"])){

    $orderdate = $_POST["order_date"];
    $cust_name = $_POST["cust_name"];

    //now getting array from order_form

    $ar_tqty = $_POST["tqty"];
    $ar_qty = $_POST["qty"];
    $ar_price = $_POST["price"];
    $ar_pro_name = $_POST["pro_name"];

    $sub_total = $_POST["sub_total"];
    $gst = $_POST["gst"];
    $discount = $_POST["discount"];
    $net_total = $_POST["net_total"];
    $paid = $_POST["paid"];
    $due = $_POST["due"];
    $payment_type = $_POST["payment_type"];

    $m = new Manage();
    echo $result = $m->storeCustomerOrderInvoice($orderdate,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
}



///////////////////////manage user///////////////

if (isset($_POST["manageUser"])){
  $m = new Manage();
  $result = $m-> manageRecordWithPagination("user");
  $rows = $result["rows"];
  //$pagination = $result["pagination"];
  if (count($rows) > 0 ) {
    //sepatutnya kat bawah ni ada pagination tapi tak jadi
    $n = 0;
    foreach ($rows as $row){
      ?>
      <tr>
          <td><?php echo ++$n; ?></td>
          <td><?php echo $row["username"]; ?></td>
          <td><?php echo $row["email"]; ?></td>
          <td><?php echo $row["usertype"]; ?></td>
          <td><?php echo $row["register_date"]; ?></td>
          <td><?php echo $row["last_login"]; ?></td>

          <td>
            <a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_user">Delete</a>
            <a href="#" eid="<?php echo $row['id']; ?>"class="btn btn-info btn-sm edit_user" data-toggle="modal" data-target="#form_user">Update</a>
          </td>
      </tr>
      <?php
    }
    ?>
      <!--<tr>
        <td colspan="5"> <?php //echo $pagination; ?></td>
      </tr>-->
    <?php
    exit();
  }
}

//delete USER
if (isset($_POST["deleteUser"])) {
  $m = new Manage();
  $result = $m ->deleteRecord("user","id",$_POST["id"]);
  echo $result;
}

//update USER
if (isset($_POST["updateUser"])) {
  $m = new Manage();
  $result = $m->getSingleRecord("user","id",$_POST["id"]);
  echo json_encode($result);
  exit();
}

//update USER after gettign data
if (isset($_POST["update_user"])) {
  $m = new Manage();
  $id = $_POST["id"];
  $name = $_POST["update_user"];
  $result = $m->update_userInfo("user",$id,$name);
  echo $result;

  exit();
}


?>
