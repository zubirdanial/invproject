$(document).ready(function(){
  var DOMAIN = "http://localhost/inv_project/public_html";

  //Manage Category
  manageCategory();
  function manageCategory(){
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : {manageCategory:1},
      success : function (data){
          $("#get_category").html(data);
      }
    })
  }

  //$("body".delgate(".page-link","click",function(){
    //var pn = $(this).attr("pn");
    //manageCategory(pn);
  //})

  $("body").delegate(".del_cat","click",function(){
    var did = $(this).attr("did");
    if (confirm("ARE YOU SURE YOU WANT TO DELETE ?")) {
      $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : {deleteCategory:1,id:did},
          success : function (data){
            if(data == "DEPENDENT_CATEGORY"){
              alert("YOU CAN'T DELETE A PARENT CATEGORY");
            }else if (data == "CATEGORY_DELETED") {
              alert("CATEGORY DELETED SUCCESSFULLY");
              manageCategory(1);
            }else if (data == "DELETED") {
              alert("DELETED SUCCESSFULLY");
            }else {
              alert(data);
            }

          }
        })
    }else {

    }
  })

  //fetch category_name
  fetch_category();
  function fetch_category(){
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : {getCategory:1},
      success : function(data){
        var root = "<option value='0'>Root</option>";
        var choose = "<option value=''>Chose Category</option>";
        $("#parent_cat").html(root+data);
        $("#select_cat").html(choose+data);
      }

    })
  }

  //fetch Brand
  fetch_brand();
  function fetch_brand(){
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : {getBrand:1},
      success : function(data){
        var choose = "<option value=''>Choose Brand</option>"
        $("#select_brand").html(choose+data);
      }

    })
  }


  //update category
  $("body").delegate(".edit_cat","click",function(){
    var eid = $(this).attr("eid");
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      dataType : "json",
      data : {updateCategory:1,id:eid},
      success : function(data){
        console.log(data);
        $("#cid").val(data["cid"]);
        $("#update_category").val(data["category_name"]);
        $("#parent_cat").val(data["parent_cat"]);
      }
    })
  })

  $("#update_category_form").on("submit",function(){
    if($("#update_category").val()==""){
      $("#update_category").addClass("border-danger");
      $("#cat_error").html("<span class='text-danger'>Please enter category name</span>");
    }
    else {
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : $("#update_category_form").serialize(),
        success : function(data){
            window.location.href = "";
        }
      })
    }
  })


  //Manage BRAND
  manageBrand();
  function manageBrand(){
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : {manageBrand:1},
      success : function (data){
          $("#get_brand").html(data);
      }
    })
  }

  $("body").delegate(".del_brand","click",function(){
    var did = $(this).attr("did");
    if (confirm("ARE YOU SURE YOU WANT TO DELETE ?")) {
      $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : {deleteBrand:1,id:did},
          success : function (data){
            if(data == "DELETED"){
              alert("BRAND DELETED");
              manageBrand(1);
            }else {
              alert(data);
            }

          }
        })
    }
  })

//update brand
  $("body").delegate(".edit_brand","click",function(){
    var eid = $(this).attr("eid");
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      dataType : "json",
      data : {updateBrand:1,id:eid},
      success : function(data){
        console.log(data);
        $("#bid").val(data["bid"]);
        $("#update_brand").val(data["brand_name"]);
      }
    })
  })


  $("#update_brand_form").on("submit",function(){
    if($("#update_brand").val()==""){
      $("#update_brand").addClass("border-danger");
      $("#brand_error").html("<span class='text-danger'>Please enter brand name</span>");
    }
    else {
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : $("#update_brand_form").serialize(),
        success : function(data){
            window.location.href = "";
        }
      })
    }
  })

////////////////////////////////////PRODUCTS///////////////////////////

manageProduct();
function manageProduct(){
  $.ajax({
    url : DOMAIN+"/includes/process.php",
    method : "POST",
    data : {manageProduct:1},
    success : function (data){
        $("#get_product").html(data);
    }
  })
}

$("body").delegate(".del_product","click",function(){
  var did = $(this).attr("did");
  if (confirm("ARE YOU SURE YOU WANT TO DELETE ?")) {
    $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : {deleteProduct:1,id:did},
        success : function (data){
          if(data == "DELETED"){
            alert("PRODUCT DELETED");
            manageProduct(1);
          }else {
            alert(data);
          }

        }
      })
  }
})

//update product
  $("body").delegate(".edit_product","click",function(){
    var eid = $(this).attr("eid");
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      dataType : "json",
      data : {updateProduct:1,id:eid},
      success : function(data){
        console.log(data);
        $("#pid").val(data["pid"]);
        $("#update_product").val(data["product_name"]);
        $("#select_cat").val(data["cid"]);
        $("#select_brand").val(data["bid"]);
        $("#product_price").val(data["product_price"]);
        $("#product_qty").val(data["product_stock"]);

      }
    })
  })

  $("#update_product_form").on("submit",function(){
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : $("#update_product_form").serialize(),
      success : function (data){
          if(data == "UPDATED"){
            alert("PRODUCT UPDATED");
            window.location.href = "";
          }
          else {
            alert(data);
          }
      }
    })
  })

//////////////////////////Manage User///////////////
manageUser();
function manageUser(){
  $.ajax({
    url : DOMAIN+"/includes/process.php",
    method : "POST",
    data : {manageUser:1},
    success : function (data){
        $("#get_user").html(data);
    }
  })
}

$("body").delegate(".del_user","click",function(){
  var did = $(this).attr("did");
  if (confirm("ARE YOU SURE YOU WANT TO DELETE ?")) {
    $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : {deleteUser:1,id:did},
        success : function (data){
          if(data == "DELETED"){
            alert("USER DELETED");
            manageUser(1);
          }else {
            alert(data);
          }

        }
      })
  }
})

$("body").delegate(".edit_user","click",function(){
  var eid = $(this).attr("eid");
  $.ajax({
    url : DOMAIN+"/includes/process.php",
    method : "POST",
    dataType : "json",
    data : {updateUser:1,id:eid},
    success : function(data){
      console.log(data);
      $("#id").val(data["id"]);
      $("#update_user").val(data["username"]);
    }
  })
})

$("#update_user_form").on("submit",function(){
  if($("#update_user").val()==""){
    $("#update_user").addClass("border-danger");
    $("#user_error").html("<span class='text-danger'>Please enter username</span>");
  }
  else {
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : $("#update_user_form").serialize(),
      success : function(data){
          window.location.href = "";
      }
    })
  }
})


})
