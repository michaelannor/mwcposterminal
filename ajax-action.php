<?php

/**
 * author:
 * date:
 * description:
 */
require_once './Smsgh/Api.php';

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

function case_send_discount_code(){
  include ("customer.php");
  $customer = $_REQUEST['customer'];
  $obj = new customer();

  $code = generate_discount_code(6);
  $message = "Thank you for shopping with us. Use this code for a discount on your next visit:\n".$code;

//note to self, uncomment when ready to deploy
  //send_sms($customer,$message);

  if($obj-> add_customer($customer, $code)){
      echo '{"result":1,"message": "added successfully"}';
  }else{
      echo '{"result":0,"message": "customer and discount code not added."}';
  }
}

//helper method to send sms through smsgh
function send_sms($phone, $msg) {
  // Here we assume the user is using the combination of his clientId and clientSecret as credentials
    $auth = new BasicAuth("jokyhrvs", "volkzmqn");
    // instance of ApiHost
    $apiHost = new ApiHost($auth);
    $enableConsoleLog = FALSE;
    $messagingApi = new MessagingApi($apiHost, $enableConsoleLog);
    try {
        // Quick Send approach options. Choose the one that meets your requirement
        $messageResponse = $messagingApi->sendQuickMessage("Shop", $phone, $msg);
        if ($messageResponse instanceof MessageResponse) {
//            echo $messageResponse->getStatus();
            $messageResponse->getStatus();
        } elseif ($messageResponse instanceof HttpResponse) {
//            echo "\nServer Response Status : " . $messageResponse->getStatus();
            $messageResponse->getStatus();
        }
    } catch (Exception $ex) {
      //  echo $ex->getTraceAsString();
        $ex->getTraceAsString();
    }
}

//helper, should generate random discount code
  function generate_discount_code( $length = 6 ) {
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $code = substr( str_shuffle( $chars ), 0, $length );
      return $code;
  }

function case_add_transaction(){
  include ("transaction.php");
  $id = $_REQUEST['transid'];
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


function case_get_product_by_id(){
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
