$(document).ready(function(){
  var DOMAIN = "http://localhost/inv_project/public_html";

  addNewRow();

  $("#add").click(function(){
    addNewRow();
  })



    function addNewRow(){
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : {getNewOrderItem:1},
        success : function(data){
          $("#invoice_item").append(data);
          var n = 0;

          $(".number").each(function(){
            $(this).html(++n);
          })
        }
      })
    }

    $("#remove").click(function(){
      $("#invoice_item").children("tr:last").remove();
      calculate(0,0);
    })

    $("#invoice_item").delegate(".pid","change",function(){
      var pid = $(this).val();
      var tr = $(this).parent().parent();
      $(".overlay").show();
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        dataType : "json",
        data : {getPriceAndQty : 1,id:pid},
        success : function (data){
          tr.find(".tqty").val(data["product_stock"]);
          tr.find(".pro_name").val(data["product_name"]);
          tr.find(".qty").val(1);
          tr.find(".price").val(data["product_price"]);
          tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val());
          calculate(0,0);
        }

      })
    })

    $("#invoice_item").delegate(".qty","keyup",function(){
      var qty = $(this);
      var tr = $(this).parent().parent();

      if (isNaN(qty.val())){
        alert("Please a valid quantity");
        qty.val(1);
      }else {

          if (qty.val() - 0 > tr.find(".tqty").val() - 0) {
              alert("Order is more than stock available!");
              qty.val(1);
          }else {
            tr.find(".amt").html(qty.val() * tr.find(".price").val());
            calculate(0,0);
          }
      }
    })

    function calculate(dis,paid){
      var sub_total = 0;
      var st = 0;
      var net_total = 0;
      var discount = dis;
      var paid_amt = paid;
      var due = 0;
      $(".amt").each(function(){
           sub_total = sub_total + ($(this).html() * 1);
      })

      gst = 0.06 * sub_total;
      net_total = gst + sub_total;
      net_total = net_total - discount;
      due = net_total - paid_amt;

      $("#gst").val(gst);
      $("#sub_total").val(sub_total);
      $("#discount").val(discount);
      $("#net_total").val(net_total);
      //$("#paid")
      $("#due").val(due);

    }

    $("#discount").keyup(function(){
      var discount = $(this).val();
      calculate(discount,0);
    })

    $("#paid").keyup(function(){
      var paid = $(this).val();
      var discount = $("#discount").val();
      calculate(discount,paid);
    })

    /* Order Accepting */

    $("#order_form").click(function(){
      $.ajax({
        url : DOMAIN+"/includes/process.php",
        method : "POST",
        data : $("#get_order_data").serialize(),
        success : function(data){
          alert(data);
        }
      })
    })
});
