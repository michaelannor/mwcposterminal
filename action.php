<?php

/**
 * author:
 * date:
 * description:
 */

$cmd = $_REQUEST['cmd'];
switch ($cmd) {
  case 1:
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



    # code...
    break;

  case 2:
    # code...
    break;

  default:
    # code...
    break;
}
?>
