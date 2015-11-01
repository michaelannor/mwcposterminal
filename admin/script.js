$(document).ready(viewAllProducts());

$(function(){
    $("#add_to_stock_btn").click(function(){
      // add product to database
      addProduct();
      $("#add_prod_id_display").val("");
      $("#add_prod_name_display").val("");
      $("#add_prod_price_display").val("");
      $("#add_prod_quantity_display").val("");
    });


    $("#btnid").click(function(){

    });

    $("#btnid").click(function(){


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

function viewAllProducts(){

  var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=6";
  var obj=sendRequest(theUrl);		//send request to the above url
  if(obj.result==1){					//check result

    var product_list;
    // if(obj.result==1){					//check result
        product_list = "";
        for (var i = 0; i < obj.product.length; i++) {
          // obj.product_name[i]
          product_list += "<li class='ui-li-static ui-body-inherit ui-li-has-thumb'><img src='pos_icon.png'><h2>";
          product_list += obj.product[i].product_name;
          product_list += " ["+obj.product[i].product_id+"]</h2><p>Price: ";
          product_list += obj.product[i].product_price;
          product_list += "</p>";
          product_list += "<p>Quantity: ";
          product_list += obj.product[i].product_quantity;
          product_list += "</p>";
          product_list += "</li>";

        }


        $("#product_list_ul").append(product_list);

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
