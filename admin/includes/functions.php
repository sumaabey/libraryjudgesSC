<?php






function yearDropdown($startYear, $endYear, $id="act_year"){ 
    //start the select tag 
    echo "<select  class='form-control' id=".$id." name=".$id."><option value=''>Select Year of Act</option>"; 
          
        //echo each year as an option     
        for ($i=$startYear;$i<=$endYear;$i++){ 
        echo "<option value=".$i.">".$i."</option>n";     
        } 
      
    //close the select tag 
    echo "</select>"; 
} 

    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
function delete($table,$conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "DELETE FROM ".$table.$whereSql;
        $delete = $this->db->exec($sql);
        return $delete?$delete:false;
    }













?>