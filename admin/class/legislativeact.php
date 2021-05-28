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
        public $act_year;
        public $gazette_citation;
        public $date_of_president_asset;
        public $file_president_asset;
        public $date_of_enforcment;
        public $file_enforcment;
        public $view_type;
        public $act_title;
        public $status;
        public $created_on;
        public $created_by;
        public $updated_on;
        public $updated_by;  

        public $colArray;      
        public $colName;      

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

            $this->act_title = substr($this->act_name, 0, 1);

            $query =  "INSERT INTO  ".$this->db_table."  SET act_name='".$this->act_name."',act_year='".$this->act_year."',file_principal_act='$this->file_principal_act',act_number='".$this->act_number."',gazette_citation='".$this->gazette_citation."',date_of_president_asset='".$this->date_of_president_asset."',file_president_asset='$this->file_president_asset',date_of_enforcment='".$this->date_of_enforcment."',file_enforcment='$this->file_enforcment',status='1',created_on='$created_on' ,created_by='$created_by',view_type='".$this->view_type."',act_title='".$this->act_title."' ";
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


       
      public function getActValue($colArray)
      {
            $sqlQuery = "SELECT ".$colArray." FROM ".$this->db_table." WHERE status='1' AND ".$colArray."!='' ORDER BY  id DESC";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
      }
      
      public function updateFiles() {
            if($this->file_principal_act){
                   $sqlQuery ="UPDATE ".$this->db_table." SET file_principal_act='$this->file_principal_act' WHERE id='$this->id'";
            }if($this->file_president_asset){
                   $sqlQuery ="UPDATE ".$this->db_table." SET file_president_asset='$this->file_president_asset' WHERE id='$this->id'";
            }if($this->file_enforcment){             
                   $sqlQuery ="UPDATE ".$this->db_table." SET file_enforcment='$this->file_enforcment' WHERE id='$this->id'"; 
            }
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
      }
      public function removeFiles() {
            $sqlQuery ="UPDATE ".$this->db_table." SET $this->colName='' WHERE id='$this->id'";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
      }
        
        
    }
?>