<?php

 class LrcBillDebate{

        // Connection
        private $conn;

        // Table
        private $db_table = "tbl_debates_bill";

        // Columns
        public $id;
        public $act_id;
        public $bill_title;
        public $bill_number;
        public $debates_gazette_citation;
        public $file_debatebill;
        public $loksabha;
        public $file_loksabha;
        public $rajsabha;
        public $file_rajsabha;
        public $both_sabha;
        public $file_both_sabha;

        public $status;
        public $created_on;
        public $created_by;
        public $updated_on;
        public $updated_by;        

        // Db connection
        public function __construct($db){
            $this->conn = $db;

        }


        


}//end of class
?>