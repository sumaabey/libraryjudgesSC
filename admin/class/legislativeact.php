<?php
    class Legislativeact{

        // Connection
        private $conn;

        // Table
        private $db_table = "tbl_principal_act";

        // Columns
        public $id;
        public $act_name;
        public $file_principal_act;
        public $act_number;
        public $gazette_citation;
        public $date_of_president_asset;
        public $file_president_asset;
        public $date_of_enforcment;
        public $file_enforcment;
        public $status;
        public $created_on;
        public $created_by;
        public $updated_on;
        public $updated_by;        

        // Db connection
        public function __construct($db){
            $this->conn = $db;

        }

        public function saveData()
        {
            
            
           $created_on=date("Y-m-d H:i:s");

           // sanitize
            $this->act_name=htmlspecialchars(strip_tags($this->act_name));
            $this->act_number=htmlspecialchars(strip_tags($this->act_number));
            $this->gazette_citation=htmlspecialchars(strip_tags($this->gazette_citation));
            $this->date_of_enforcment=htmlspecialchars(strip_tags($this->date_of_enforcment));

           $query =  "INSERT INTO  ".$this->db_table."  SET act_name='".$this->act_name."',file_principal_act='$this->file_principal_act',act_number='".$this->act_number."',gazette_citation='".$this->gazette_citation."',date_of_president_asset='".$this->date_of_president_asset."',file_president_asset='$this->file_president_asset',date_of_enforcment='".$this->date_of_enforcment."',file_enforcment='$this->file_enforcment',status='1',created_on='$created_on' ";
            $stmt = $this->conn->prepare($query);

            $stmt->execute();
            return $stmt;
      }


      public function viewActData()
      {

            $sqlQuery = "SELECT * FROM ".$this->db_table." WHERE status='1' ORDER BY  id DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;

      }


       

        
        
    }
?>