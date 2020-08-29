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
})
