// $(document).ready(viewAllProducts());
// $(window).load(viewAllProducts());

$(window).load(function() {
  viewAllProducts();
});

$(function(){
    $("#add_to_stock_btn").click(function(){
      // add product to database
      addProduct();
      $("#add_prod_id_display").val("");
      $("#add_prod_name_display").val("");
      $("#add_prod_price_display").val("");
      $("#add_prod_quantity_display").val("");
    });


    $("#update_porduct_btn").click(function(){
      updateProduct();
    });

    $("#update_prod_by_id_btn").click(function(){
      updateProductByID();
    });
});

function sendRequest(u){
    // Send request to server
    //u a url as a string
    //async is type of request
    // alert(u);
    var obj=$.ajax({url:u,async:false});
    //Convert the JSON string to object
    var result=$.parseJSON(obj.responseText);
    return result;	//return object
}

function updateProductByID() {
  var product_id = $("#update_prod_id_display").val();
  $("#update_details_id_display").html(product_id);
  getProduct(product_id);
  $("#update_prod_id_display").val("");
  // $("#update_details_id_display").prop('readonly', true);
  // $("#update_details_name_display").prop('readonly', true);
}

function getProductFromList(product_id){
  // alert(product_id);
  $("#update_details_id_display").html(product_id);
  getProduct(product_id);
}

function getProduct(code){
  var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=1&productid="+code;
  var obj=sendRequest(theUrl);		//send request to the above url
  if(obj.result==1){					//check result
    var product_name = obj.product[0]['product_name'];
    var product_price = obj.product[0]['product_price'];
    var product_quantity = obj.product[0]['product_quantity'];
    $("#update_details_name_display").html(product_name);
    $("#update_details_quantity_display").val(product_quantity);
    $("#update_details_price_display").val(product_price);
    $("#move_to_update_details_btn").trigger("click");
  }else{
      //show error message
      alert("error: product not in database");//err
  }
}

function updateProduct() {
  var product_id = $("#update_details_id_display").html();
  // var product_name = $("#add_prod_name_display").val();
  var product_price = $("#update_details_price_display").val();
  var product_quantity = $("#update_details_quantity_display").val();
  var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=7&prodid="+product_id+"&price="+product_price+"&qty="+product_quantity;
  var obj=sendRequest(theUrl);  //send request to the above url
  if(obj.result==1){
    $("#prod_name_display").val("");
    $("#update_details_quantity_display").val("");
    $("#update_details_price_display").val("");
    $("#update_details_id_display").val("");
    viewAllProducts();
  }else {
    //show error message
    alert("error: product not modified");//err
  }
}

function viewAllProducts(){

  var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=6";
  var obj=sendRequest(theUrl);		//send request to the above url
  if(obj.result==1){					//check result

    var product_list;
    // if(obj.result==1){					//check result
        product_list = "";
        for (var i = 0; i < obj.product.length; i++) {
          var id = obj.product[i].product_id;
          // obj.product_name[i]
          product_list += "<tr><td>";
          product_list += obj.product[i].product_name;
          product_list += "</td><td> "+obj.product[i].product_id+"</td><td>";
          product_list += obj.product[i].product_price;
          product_list += "</td>";
          product_list += "<td>";
          product_list += obj.product[i].product_quantity;
          product_list += "<tdp>";
          product_list += "<td><a href='#updatedetailspage' onclick='getProductFromList("+id+")' class='ui-shadow ui-btn-right ui-corner-all ui-btn-inline ui-icon-edit ui-btn-icon-notext ui-btn-b ui-mini'></a></td>";
          product_list += "</tr>";
        }

        $("#product_list_ul").html(product_list);

    // $("#simulateClick").trigger("click");
  }else{
      //show error message
      alert("error: couldn't fetch products");//err
  }
}

function addProduct(){
  var product_id = $("#add_prod_id_display").val();
  var product_name = $("#add_prod_name_display").val();
  var product_price = $("#add_prod_price_display").val();
  var product_quantity = $("#add_prod_quantity_display").val();
  var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=5&prodid="+product_id+"&name="+product_name+"&price="+product_price+"&qty="+product_quantity;
  // var theUrl="../ajax-action.php?cmd=5&prodid="+product_id+"&name="+product_name+"&price="+product_price+"&qty="+product_quantity;
  // alert(theUrl);
  var obj=sendRequest(theUrl);  //send request to the above url
  if(obj.result==1){

  }else {
    //show error message
    alert("error: product not added");//err
  }
}
