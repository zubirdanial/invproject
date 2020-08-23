$(document).ready(function(){
  var DOMAIN = "http://localhost/inv_project/public_html";
  $("#register_form").on("submit",function(){

    var status = false;
    var name = $("#username");
    var email = $("#email");
    var pass1 = $("#password1");
    var pass2 = $("#password2");
    var type = $("#usertype");

    var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

    if(name.val() == "" || name.val().length < 6){
      name.addClass("border-danger");
      $("#u_error").html("<span class='text-danger'>Please Enter Name and Ensure Characters is More Than 6</span>");
      status = false;
    }
    else{
      name.removeClass("border-danger");
      $("#u_error").html("");
      status = true;
    }

    if(!e_patt.test(email.val())){
      email.addClass("border-danger");
      $("#e_error").html("<span class='text-danger'>Please enter valid email</span>");
      status = false;
    }
    else{
      email.removeClass("border-danger");
      $("#e_error").html("");
      status = true;
    }

    if(pass1.val() == "" || pass1.val().length < 8){
      pass1.addClass("border-danger");
      $("#p1_error").html("<span class='text-danger'>Please enter password and more than 8 characters</span>");
      status = false;
    }
    else{
      pass1.removeClass("border-danger");
      $("#p1_error").html("");
      status = true;
    }

    if(pass2.val() == "" || pass2.val().length < 8){
      pass2.addClass("border-danger");
      $("#p2_error").html("<span class='text-danger'>Please enter password and more than 8 characters</span>");
      status = false;
    }
    else{
      pass2.removeClass("border-danger");
      $("#p2_error").html("");
      status = true;
    }

    if(type.val() == ""){
      type.addClass("border-danger");
      $("#t_error").html("<span class='text-danger'>Please enter usertype</span>");
      status = false;
    }
    else{
      type.removeClass("border-danger");
      $("#t_error").html("");
      status = true;
    }

    if(pass1.val() == pass2.val() && status == true){
        $(".overlay").show();
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : $("#register_form").serialize(),
          success : function(data){
            if(data == "EMAIL_ALREADY_EXIST"){
              $(".overlay").hide();
              alert("Email is already used");
            }else if (data == "SOME_ERROR") {
              $(".overlay").hide();
              alert("Something went wrong");
            }else {
              $(".overlay").hide();
              window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered and may now login");
            }
          }
        })
    }else{
      pass2.addClass("border-danger");
      $("#p2_error").html("<span class='text-danger'>Password does not match</span>");
      status = true;
    }

  })

  //UNTUK Login
  $("#form_login").on("submit",function(){
    var email = $("#log_email");
    var pass = $("#log_password");
    var usertype = $("#log_usertype");
    var status = false;

    if (email.val() == "") {
      email.addClass("border-danger");
      $("#e_error").html("<span class='text-danger'>Please enter email address</span>");
      status = false;
    }else {
      email.removeClass("border-danger");
      $("#e_error").html("");
      status = true;
    }

    if (pass.val() == "") {
      pass.addClass("border-danger");
      $("#p_error").html("<span class='text-danger'>Please enter password</span>");
      status = false;
    }else {
      pass.removeClass("border-danger");
      $("#p_error").html("");
      status = true;
    }

    if (usertype.val() == "") {
      usertype.addClass("border-danger");
      $("#t_error").html("<span class='text-danger'>Please enter usertype</span>");
      status = false;
    }else {
      usertype.removeClass("border-danger");
      $("#t_error").html("");
      status = true;
    }

if(usertype.val()=="Staff"){
    if(status){
    $(".overlay").show();
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : $("#form_login").serialize(),
        success : function(data){
          if(data == "NOT_REGISTERED"){
            $(".overlay").hide();
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>User is not registered</span>");

          }else if (data == "PASSWORD_NOT_MATCHED") {
            $(".overlay").hide();
            pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please enter correct password</span>");
            status = false;
          }else if (data == "USERTYPE_NOT_MATCHED") {
            $(".overlay").hide();
            usertype.addClass("border-danger");
            $("#t_error").html("<span class='text-danger'>Please enter correct usertype</span>");
            status = false;
          }
          else {
            $(".overlay").hide();
            console.log(data);
          window.location.href = DOMAIN+"/dashboard_staff.php";
          }
        }
      })
    }}

    else if (usertype.val()=="Admin") {
      if(status){
      $(".overlay").show();
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : $("#form_login").serialize(),
          success : function(data){
            if(data == "NOT_REGISTERED"){
              $(".overlay").hide();
              email.addClass("border-danger");
              $("#e_error").html("<span class='text-danger'>User is not registered</span>");

            }else if (data == "PASSWORD_NOT_MATCHED") {
              $(".overlay").hide();
              pass.addClass("border-danger");
              $("#p_error").html("<span class='text-danger'>Please enter correct password</span>");
              status = false;
            }else if (data == "USERTYPE_NOT_MATCHED") {
              $(".overlay").hide();
              usertype.addClass("border-danger");
              $("#t_error").html("<span class='text-danger'>Please enter correct usertype</span>");
              status = false;
            }else {
              $(".overlay").hide();
              console.log(data);
            window.location.href = DOMAIN+"/dashboard_admin.php";
            }
          }
        })
      }
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
      var choose = "<option value=''>Choose Category</option>"
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

  //Add category_form

  $("#category_form").on("submit", function(){
    if($("#category_name").val()==""){
      $("#category_name").addClass("border-danger");
      $("#cat_error").html("<span class='text-danger'>Please enter category name</span>");
    }
    else {
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : $("#category_form").serialize(),
        success : function(data){
            if (data == "CATEGORY_ADDED"){
              $("#category_name").removeClass("border-danger");
              $("#cat_error").html("<span class='text-success'>New Category Added</span>");
              $("#category_name").val("");
            }
            else{
              alert(data);
            }
        }
      })
    }
  })


  //Add Brand
  $("#brand_form").on("submit",function(){
    if($("#brand_name").val() == ""){
      $("#brand_name").addClass("border-danger");
      $("#brand_error").html("<span class='text-danger'> Please enter brand name </span>");
    }
    else {
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : $("#brand_form").serialize(),
        success : function (data){

          if(data == "BRAND_ADDED"){
          $("#brand_name").removeClass("border-danger");
          $("#brand_error").html("<span class='text-success'> New Brand Added </span>");
          $("#brand_name").val("");
        }
        else {
          alert(data);
        }
        }
      })
    }
  })

  //ADD Product
  $("#product_form").on("submit",function(){
    $.ajax({
      url : DOMAIN+"/includes/process.php",
      method : "POST",
      data : $("#product_form").serialize(),
      success : function (data){

        if(data == "PRODUCT_ADDED"){
        alert(data);
      }
      else {
        console.log(data);
        alert(data);
      }
      }
    })
  })
})
