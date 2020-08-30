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
        $("#parent_cat").html(root+data);
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

})
