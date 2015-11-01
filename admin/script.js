$(document).ready();

$(function(){
    $("#btnid").click(function(){


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

function fnName(){

  var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=1&productid="+code;
  var obj=sendRequest(theUrl);		//send request to the above url
  if(obj.result==1){					//check result
    var product_name = obj.product[0]['product_name'];
    var product_price = obj.product[0]['product_price'];
    $("#prod_name_display").html(product_name);
    $("#prod_id_display").html(code);
    $("#prod_price_display").html(product_price);

    $("#simulateClick").trigger("click");
  }else{
      //show error message
      alert("error: product not in database");//err
  }
}

function addProduct(){
  var product_id = $("#add_prod_id_display").html();
  var product_name = $("#add_prod_name_display").html();
  var product_price = $("#add_prod_price_display").html();
  var product_quantity = $("#add_prod_quantity_display").val();
  // var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=5&prodid="+product_id+"&name="+product_name+"&price="+product_price+"&qty="+product_quantity;
  var theUrl="../ajax-action.php?cmd=5&prodid="+product_id+"&name="+product_name+"&price="+product_price+"&qty="+product_quantity;
  var obj=sendRequest(theUrl);  //send request to the above url
  if(obj.result==1){

  }else {
    //show error message
    alert("error: product not added");//err
  }
}
