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
      $("#t_error").html("<span class='text-danger'>Please enter password and more than 8 characters</span>");
      status = false;
    }
    else{
      type.removeClass("border-danger");
      $("#t_error").html("");
      status = true;
    }

    if(pass1.val() == pass2.val() && status == true){
        $.ajax({
          url : DOMAIN+"/includes/process.php",
          method : "POST",
          data : $("#register_form").serialize(),
          success : function(data){
            if(data == "EMAIL_ALREADY_EXIST"){
              alert("Email is already used");
            }else if (data == "SOME_ERROR") {
              alert("Something went wrong");
            }else {
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

    if(status){
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : $("#form_login").serialize(),
        success : function(data){
          if(data == "NOT_REGISTERED"){
            email.addClass("border-danger");
            $("#e_error").html("<span class='text-danger'>User is not registered</span>");

          }else if (data == "PASSWORD_NOT_MATCHED") {
            pass.addClass("border-danger");
            $("#p_error").html("<span class='text-danger'>Please enter correct password</span>");
            status = false;
          }else {
            console.log(data);
          window.location.href = DOMAIN+"/dashboard.php";
          }
        }
      })
    }
  })
})
