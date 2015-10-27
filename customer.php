<?php

/**
 * author:
 * date:
 * description:
 */

include("adb.php");

class customer extends adb{
  /**
   * [[The add_customer is a function to a customer who has spent above a threshold price to the database with
   * a discount code]]
   * @param [[Varchar]] $customer  [[The phone number of the customer]]
   * @param [[Varchar]] $code [[The generated one-time use discount code]]
   */
    function add_customer($customer, $code){
        $str_query="insert into pos_customer set customer='$customer',disount_code='$code'";
        return $this->query($str_query);
    }

  /**
   * [[The validate_discount_code is a function to validate a phone number, discount code pair. A valid check returns
   * a from the record, a value to determine whether or not the code has already been redeemed]]
   * @param [[Varchar]] $customer [[The phone number of the customer]]
   * @param [[Varchar]] $code [[The discount code]]
   */
    function validate_discount_code($customer, $code){
        $str_query="select discount_redeemed from pos_customer where customer='$customer' and disount_code='$code'";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }

  /**
   * [[The set_discount_code_invalid gives the discount_redeemed field a value of 1 to show the code has been used.]]
   * @param [[Varchar]] $customer [[The phone number of the customer]]
   * @param [[Varchar]] $code [[The discount code]]
   */
    function set_discount_code_invalid($customer, $code){
        $str_query="update pos_customer set discount_redeemed = 1 where customer='$customer' and disount_code='$code'";
        return $this->query($str_query)
    }



}
?>
