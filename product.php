<?php

/**
 * author:
 * date:
 * description:
 */

include("adb.php");

class product extends adb{
  /**
   * [[The add_product is a function to add a product to the database]]
   * @param [[Int]] $id [[Product id, represented by a barcode]]
   * @param [[Varchar]] $name  [[Name of Product]]
   * @param [[Decimal]] $price  [[Price of Product]]
   * @param [[Int]] $quantity  [[Quantity or units in stock]]
   */
    function add_product($id, $name, $price, $quantity){
        $str_query="insert into pos_product set product_id='$id',product_name='$name',
        product_price='$price',product_quantity='$quantity'";
        return $this->query($str_query);
    }

  /**
   * [[The get_all_products is a function to fetch all the products from the database]]
   */
    function get_all_products(){
        $str_query="select * from pos_product";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }

  /**
   * [[The get_product_by_id is a function to fetch a specific product from the database by id]]
   * @param [[Int]] $id [[Product id, represented by a barcode]]
   */
    function get_product_by_id($id){
        $str_query="select * from pos_product where product_id='$id'";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }

    /**
     * [[The update_product_details is a function to update the details of a product in stock]]
     * @param [[Int]] $id [[Transaction id]]
     * @param [[Decimal]] $value [[The totlal value of the transaction]]
     */
      function update_product_details($product_id, $product_price, $product_quantity){
          $str_query="update pos_product set product_price='$product_price',
          product_quantity='$product_quantity' where product_id='$product_id'";
          return $this->query($str_query);
      }

      /**
       * [[The decrement_quantity is a function to decrease the quantity in stock after a transaction]]
       * @param [[Int]] $id [[Transaction id]]
       * @param [[Int]] $product_quantity [[The quantity to reduce by]]
       */
        function decrement_quantity($product_id, $product_quantity){
            $str_query="update pos_product set product_quantity=product_quantity-'$product_quantity'
            where product_id='$product_id'";
            return $this->query($str_query);
        }



}
?>
