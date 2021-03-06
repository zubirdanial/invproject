<?php
include_once("./database/constants.php");

 ?>
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
      <div class="row">
        <div class="col-md-4">
          <div class="card mx-auto" >
            <img class="card-img-top mx-auto" style="width:60%;" src="./images/images.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">SATAY SEDAP STORAGE SYSTEM</h5>
              <p class="card-text"><i class="fa fa-map-marker"></i>&nbsp;Satay Sedap Ukay Perdana</p>
              <p class="card-text"><i class="fa fa-id-badge"></i>&nbsp;Staff</p>

              <!--<p class="card-text">Last Login : xxxxxx</p> -->
              <a href="profilePage.php" class="btn btn-warning"><i class="fa fa-user-circle"> &nbsp; </i>View Profile</a>
            </div>
          </div>
            </div>
            <div class="col-md-8">
              <div class="jumbotron" style="width:100%;height:100%;">
                <h1>Welcome Staff,</h1>
                <div class="row">

                  <div class="col-sm-6">
                    <iframe src="http://free.timeanddate.com/clock/i7ea9y2u/n122/szw160/szh160/hoc000/hbw2/hfceee/cf100/hncccc/fdi76/mqc000/mql10/mqw4/mqd98/mhc000/mhl10/mhw4/mhd98/mmc000/mml10/mmw1/mmd98"
                    frameborder="0" width="160" height="160"></iframe>
                  </div>

                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">New Orders</h5>
                        <p class="card-text">Record customers order and create new orders</p>
                        <a href="new_order.php" class="btn btn-primary"><i class="fa fa-plus-circle">&nbsp;</i>New Orders</a>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
          </div>
        </div>
      </div>
    </div>
<p></p>
<p></p>
    <div class="container">
      <div class="row">

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Categories</h5>
              <p class="card-text">Manage or add item's category</p>
              <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary"><i class="fa fa-plus-circle">&nbsp;</i>Add</a>
              <a href="manage_categories.php" class="btn btn-success"><i class="fa fa-edit">&nbsp;</i>Manage</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Brands</h5>
              <p class="card-text">Manage or add brands</p>
              <a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-primary"><i class="fa fa-plus-circle">&nbsp;</i>Add</a>
              <a href="manage_brand.php" class="btn btn-success"><i class="fa fa-edit">&nbsp;</i>Manage</a>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Products</h5>
              <p class="card-text">Manage or add product</p>
              <a href="#" data-toggle="modal" data-target="#form_products" class="btn btn-primary"><i class="fa fa-plus-circle">&nbsp;</i>Add</a>
              <a href="manage_product.php" class="btn btn-success"><i class="fa fa-edit">&nbsp;</i>Manage</a>
            </div>
          </div>
        </div>

      </div>
    </div>


    <?php
      //Category Form
        include_once("./templates/category.php");
     ?>


     <?php
       //Brand Form
         include_once("./templates/brand.php");
      ?>


      <?php
        //Product Form
          include_once("./templates/products.php");
       ?>


  </body>
</html>
