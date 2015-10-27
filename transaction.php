<?php
include("adb.php");

class transaction extends adb{
  /**
   * [[The add_transaction is a function to record a transaction in the database]]
   * @param [[Int]] $transaction_id  [[The id of the current transactions. Ties common purchases together]]
   * @param [[Date]] $date [[The date of the transaction]]
   * @param [[Time]] $time  [[The time of the transaction]]
   * @param [[Varchar]] $customer  [[The customer's phone number]]
   */
    function add_transaction($transaction_id, $date, $time, $customer){
        $str_query="insert into pos_transaction set transaction_id='$transaction_id',date='$date',
        time='$time',customer='$customer'";
        return $this->query($str_query);
    }

  /**
   * [[The get_all_transactions is a function to fetch all the transactions from the database]]
   */
    function get_all_transactions(){
        $str_query="select * from pos_transaction";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }

  /**
   * [[The get_transaction_by_id is a function to fetch a specific transaction from the database by id]]
   * @param [[Int]] $id [[Product id, represented by a barcode]]
   */
    function get_transaction_by_id($id){
        $str_query="select * from pos_transaction where transaction_id='$id'";
        if(!$this->query($str_query)){
            return false;
        }
        return $this->fetch();
    }


      /**
       * [[The get_transactions_above_value is a function to fetch transactions above a threshold from the database by id]]
       * @param [[Decimal]] $threshold [[a threhold value to distinguish high value transactions]]
       */
        function get_transactions_above_value($threshold){
            $str_query="select * from pos_transaction where value>='$threshold'";
            if(!$this->query($str_query)){
                return false;
            }
            return $this->fetch();
        }

      /**
       * [[The set_transaction_value is a function to set the value (total cost) of a transaction by id]]
       * @param [[Int]] $id [[Transaction id]]
       * @param [[Decimal]] $value [[The totlal value of the transaction]]
       */
        function set_transaction_value($id, $value){
            $str_query="update pos_transaction set value = $value where transaction_id='$id'";
            return $this->query($str_query)
        }



}
?>
