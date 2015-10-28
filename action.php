<?php

/**
 * author:
 * date:
 * description:
 */

$cmd = $_REQUEST['cmd'];
switch ($cmd) {
  case 1:
    case_get_product_by_id();
    break;

  case 2:
    case_add_transaction();
    break;

    case 3:
      case_send_discount_code();
      break;

  default:
    # code...
    break;
}

case_send_discount_code(){
  include ("customer.php");
  $customer = $_REQUEST['cuustomer'];
  $obj = new customer();

  $code = generate_discount_code();

  if($obj-> add_customer($customer, $code)){
      echo '{"result":1,"message": "added successfully"}';
  }else{
      echo '{"result":0,"message": "customer and discount code not added."}';
  }
}

generate_discount_code(){

}

case_add_transaction(){
  include ("transaction.php");
  $id = $_REQUEST['trans_id'];
  $date = $_REQUEST['date'];
  $time = $_REQUEST['time'];
  $customer = $_REQUEST['customer'];
  $value = $_REQUEST['value'];
  $obj = new transaction();

  if($obj->add_transaction($id, $date, $time, $customer, $value)){
      echo '{"result":1,"message": "added successfully"}';
  }else{
      echo '{"result":0,"message": "transaction not added."}';
  }
}


case_get_product_by_id(){
include ("product.php");
  $pid = $_REQUEST['productid'];
  $obj = new product();

$row = $obj->get_product_by_id($pid);
  //return a JSON string to browser when request comes to get description

  if($row){
  //generate the JSON message to echo to the browser
    echo '{"result":1,"product":[';	//start of json object
    echo json_encode($row);			//convert the result array to json object
    echo "]}";							//end of json array and object
  }
  else{
    echo '{"result":0,"message": "product not got."}';
  }
}


?>
