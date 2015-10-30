$.support.cors=true;

  var trans_id = "";
  var trans_val = 0;
  var threshold = 500;

  $(document).ready(null_trans());

  function null_trans(){
    trans_id = "";
    trans_val = 0;
  }

  function init_transaction(){
    trans_id = generate_transaction_id();
    //note to self: reset to 0;
    trans_val = 0;
  }

  function generate_transaction_id(){
    trans_id = "";
    var the_date = new Date();
    trans_id = the_date.getTime();
    trans_id += makeid();
    return trans_id;
  }

  function makeid(){
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    for( var i=0; i < 2; i++ )
      text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
  }

  $(function(){
      $("#scanbtn").click(function(){
        if(trans_id==""){
          init_transaction();
        }
          cordova.plugins.barcodeScanner.scan(
              function (result) {
        //         alert("We got a barcode\n" +
        // "Result: " + result.text + "\n" +
        // "Format: " + result.format + "\n" +
        // "Cancelled: " + result.cancelled);
                  getProduct(result.text);
                  // not to self, for web testing
                  // getProduct("83012016");
              },
              function (error) {
                  alert("Scanning failed: " + error);
              }
          );
      });


      $("#addtocartbtn").click(function(){
        //create purchase record: $product_id, $transaction_id, $qty, $price, $unit_price
          add_purchase();
          $("#prod_quantity_display").val("");
      });

      $("#submitbtn").click(function(){
        //create transaction record: $transaction_id, $date, $time, $customer
        if (trans_id!=""){
        add_transaction();
        if (trans_val>=threshold){
          send_discount_code();
        }
          null_trans();
          //empty phone number, ul, and total
          $("#customer_phone").val("");
          $("#total_val_view").html("Total: GHc "+trans_val);
          $("#purchase_list_ul").html("");
      }
      else {
        alert("Scan Product First");
      }

      });
  });

  function send_discount_code() {
    var customer_val = $("#customer_phone").val();
    // alert(customer_val);
    var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=3&customer="+customer_val;

    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result==1){					//check result

    }else{
        //show error message
        alert("error adding discount code");//err
    }


  }

  function add_transaction() {
    var the_date = new Date();
    var date_val = the_date.getFullYear() + "-" + (the_date.getMonth()+1) + "-" + the_date.getDate();
    var time_val = the_date.getHours() + ":" + the_date.getMinutes() + ":" + the_date.getSeconds();
    var customer_val = $("#customer_phone").val();
    var total_val = trans_val;

    var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=2&transid="+trans_id+"&date="+date_val+"&time="+time_val+"&customer="
    +customer_val+"&value="+total_val;

    var obj=sendRequest(theUrl);		//send request to the above url
    if(obj.result==1){					//check result

    }else{
        //show error message
        alert("error adding transaction");//err
    }

  }


  function add_purchase() {
    //create purchase record: $product_id, $transaction_id, $qty, $price, $unit_price
    var product_id = $("#prod_id_display").html();
    var product_name = $("#prod_name_display").html();
    var product_price = $("#prod_price_display").html();
    var product_quantity = $("#prod_quantity_display").val();
    var sum = (product_quantity * product_price);
    if (product_quantity > 0){
    trans_val += sum;
    $("#total_val_view").html("Total: GHc "+trans_val);
    var theUrl="http://cs.ashesi.edu.gh/class2016/michael-annor/mwc-midsem/ajax-action.php?cmd=4&transid="+trans_id+"&prodid="+product_id+"&qty="+product_quantity+"&unitprice="
    +product_price+"&sumprice="+sum;
    var obj=sendRequest(theUrl);		//send request to the above url
    var purchase_list;
    if(obj.result==1){					//check result
        purchase_list = "";
        purchase_list += "<li class='ui-li-static ui-body-inherit ui-li-has-thumb'><img src='pos_icon.png'><h2>";
        purchase_list += product_name;
        purchase_list += " ["+product_id+"]</h2><p>Price: ";
        purchase_list += product_price;
        purchase_list += "</p>";
        purchase_list += "<p>Quantity: ";
        purchase_list += product_quantity;
        purchase_list += "</p>";
        purchase_list += "<p>Subtotal: GHc ";
        purchase_list += sum;
        purchase_list += "</p></li>";

        $("#purchase_list_ul").append(purchase_list);
      }
    else{
        //show error message
        alert("error adding purchase");//err
    }
  }
  else{
      //show error message, qty less than 1
      // alert("error adding purchase");//err
  }


  }


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

  function getProduct(code){
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
