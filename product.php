<?php
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




}
?>
