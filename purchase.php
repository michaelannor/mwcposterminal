<?php

/**
 * author:
 * date:
 * description:
 */

include("adb.php");

class purchase extends adb{
  /**
   * [[The add_purchase is a function to record a purchase of a product to the database]]
   * @param [[Int]] $product_id [[Product id being purchased, represented by a barcode]]
   * @param [[Int]] $transaction_id  [[The id of the current transactions. Ties common purchases together]]
   * @param [[Int]] $qty  [[The quantity of a product being purchased]]
   * @param [[Decimal]] $price  [[The total price of all units of the products purchased]]
   * @param [[Decimal]] $unit_price [[The price of one unit of a product at the time of purchase]]
   */
    function add_purchase($product_id, $transaction_id, $qty, $price, $unit_price){
        $str_query="insert into pos_purchase set product_id='$product_id',purchase_quantity='$qty',
        purchase_price='$price',unit_price='$unit_price',transaction_id='$transaction_id'";
        return $this->query($str_query);
    }

  /**
   * [[The get_all_purchases_by_transaction is a function to fetch all thepurchaces in a specific transaction from the database]]
   * @param [[Int]] $transaction_id  [[The id of the current transactions. Ties common purchases together]]
   */
    function get_all_purchases_by_transaction($transaction_id){
        $str_query="select * from pos_purchase where transaction_id='$transaction_id'";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }

}
?>
