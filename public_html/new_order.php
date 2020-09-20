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
    <script type="text/javascript" src="./js/order.js"></script>
  </head>
  <body>
    <!-- Navabr -->
<?php include_once("./templates/header.php"); ?>
  <br><br>

  <div class="container">
    <div class="row">

      <div class="col-md-10 mx-auto">
          <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
            <div class="card-header">
              <h4>New Orders</h4>
            </div>
            <div class="card-body">
                  <form id="get_order_data" onsubmit="return false" >
                    <div class="form-group row" >
                      <label class="col-sm-3 col-form-label" align="right" >Order Date</label>
                      <div class="col-sm-6">
                        <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-d-m"); ?>">
                      </div>
                    </div>

                    <div class="form-group row" >
                      <label class="col-sm-3" align="right" >Customer Name*</label>
                      <div class="col-sm-6">
                        <input type="text" id="cust_name" name="cust_name" class="form-control form-control-sm" placeholder="Enter customer name" required/>
                      </div>
                    </div>

                    <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                      <div class="card-body">
                        <h3>Order List</h3>
                        <table align="center" style="width:800px;">
      		                            <thead>
      		                              <tr>
      		                                <th>#</th>
      		                                <th style="text-align:center;">Item Name</th>
      		                                <th style="text-align:center;">Total Quantity</th>
      		                                <th style="text-align:center;">Quantity</th>
      		                                <th style="text-align:center;">Price</th>
      		                                <th>Total</th>
      		                              </tr>
      		                            </thead>
      		                            <tbody id="invoice_item">

                                      	<!--	<tr>
                                      		    <td><b id="number">1</b></td>
                                      		    <td>
                                      		        <select name="pid[]" class="form-control form-control-sm" required>
                                      		            <option>Washing Machine</option>
                                      		        </select>
                                      		    </td>
                                      		    <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td>
                                      		    <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
                                      		    <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
                                      		    <td>Rs.1540</td>
                                      		</tr> -->

      		                            </tbody>
      		                        </table> <!--Table ends -->
                                <center style="padding:10px;">
                                <button id="add" style="width: 150px;" class="btn btn-success">Add</button>
                                <button id="remove" style="width: 150px;" class="btn btn-danger">Remove</button>
                              </center>
                      </div> <!--card body ends -->
                    </div> <!--Order list card ends -->

                    <p></p>

                    <div class="form-group row">
                      <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                      <div class="col-sm-6">
                        <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="gst" class="col-sm-3 col-form-label" align="right">Tax (6%)</label>
                      <div class="col-sm-6">
                        <input type="text" readonly name="gst" class="form-control form-control-sm" id="gst" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                      <div class="col-sm-6">
                        <input type="text" name="discount" class="form-control form-control-sm" id="discount" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                      <div class="col-sm-6">
                        <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                      <div class="col-sm-6">
                        <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                      <div class="col-sm-6">
                        <input type="text" readonly name="due" class="form-control form-control-sm" id="due" required/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="payment_type" class="col-sm-3 col-form-label" align="right">Payment Method</label>
                      <div class="col-sm-6">
                        <select name="payment_type" class="form-control form-control-sm" id="payment_type" required/>
                          <option>Cash</option>
                          <option>Card</option>
                          <option>Draft</option>
                          <option>Cheque</option>
                        </select>
                      </div>
                    </div>

                    <center>
                      <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order">
                      <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                    </center>

                  </form>
            </div>
          </div>

      </div>
    </div>
  </div>


  </body>
</html>
