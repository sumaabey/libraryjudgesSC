<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    
include_once '../includes/dbconnect.php';
include_once '../class/legislativeact.php';

$database 		= new Database();
$db       		= $database->dbConnection();

$legislative     = new Legislativeact($db);
$returnArr =array();
$time = time();
$legislative->id = $_POST['id'];
$mode=$_POST['mode'];
if($mode == 'del'){
        $legislative->colName = $_POST['colName'];
        $target_p_act = '../../lrca/act/'.$_POST['fileName'];
        unlink( $target_p_act);
        $removeData=$legislative->removeFiles();
	if($removeData){
		$returnArr['status'] = "Success";
		$returnArr['msg'] = "Data Successfully Add";
	}
	else{
		$returnArr['status'] = "Error";
		$returnArr['msg'] = "Something went wrong ...Please try again !!! Error";
	}
	echo  json_encode($returnArr); 
}
if($mode == 'edit'){
    $colName=$_POST['colName'];
    if($colName =='file_principal_act'){
        $file_principal_act=strtolower($_FILES['file']['name']);
        $file_act =explode(".",$file_principal_act); // get the extension of the file
        $fileprincipalact = "pact_".$time.".".$file_act[1] ;
        $target_p_act = '../../lrca/act/'.$fileprincipalact;
        $legislative->file_principal_act=$fileprincipalact;
        if ($_FILES['file']['type'] == 'application/pdf') 
        {
            $upload_act = move_uploaded_file($_FILES['file']['tmp_name'], $target_p_act);
            if($upload_act)
            {
                            $sucess_msg =$file_principal_act.' Act File uploaded successfully.';$errorVal=0;
                            $returnArr['status'] = "Success";
                            $returnArr['msg'] = $sucess_msg ;

            }
            else
            {
                        $errorVal=1;
                        $err_msg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'.$_FILES['file']['error'];
                        $returnArr['status'] = "Error";
                        $returnArr['msg'] = $err_msg;
            }//end of move upload
        }
    }
    if($colName =='file_president_asset'){
            $file_president_asset=strtolower($_FILES['file']['name']);
            $file_president_asset =explode(".",$file_president_asset); // get the extension of the file
            $filepresidentasset = "president_".$time.".".$file_president_asset[1] ;
            $target_president_asset = '../../lrca/act/'.$filepresidentasset;
            $legislative->file_president_asset=$filepresidentasset;
            if ($_FILES['file']['type'] == 'application/pdf'){
            $upload_president_asset = move_uploaded_file($_FILES['file']['tmp_name'], $target_president_asset );
            if($upload_president_asset)
            {
                            $sucess_msg =$file_president_asset.' Asset File uploaded successfully.';$errorVal=0;
                            $returnArr['status'] = "Success";
                            $returnArr['msg'] = $sucess_msg ;

            }else
            {
                            $errorVal=2;
                            $err_msg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'.$_FILES['file']['error'];		    
                            $returnArr['status'] = "Error";
                            $returnArr['msg'] = $err_msg;
            }//end of move upload
        }

    }
    if($colName =='file_enforcment'){
            $file_enforcment=strtolower($_FILES['file']['name']);
            $file_enforcment =explode(".",$file_enforcment); // get the extension of the file

            $fileenforcment = "encforce_".$time.".".$file_enforcment[1] ;
            $target_enforcment = '../../lrca/act/'.$fileenforcment;
            $legislative->file_enforcment=$fileenforcment;
            if ($_FILES['file']['type'] == 'application/pdf'){
            $upload_enforcment = move_uploaded_file($_FILES['file']['tmp_name'], $target_enforcment );
            if($upload_enforcment)
            {
                            $sucess_msg =$file_enforcment.' enforcement  File uploaded successfully.';$errorVal=0;
                            $returnArr['status'] = "Success";
                            $returnArr['msg'] = $sucess_msg ;

            }else
            {
                            $errorVal=3;
                            $err_msg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'.$_FILES['file']['error'];             
                            $returnArr['status'] = "Error";
                            $returnArr['msg'] = $err_msg;
            }//end of move upload
          }


    }
    if($errorVal==0){
            $createData=$legislative->updateFiles();
            if($createData){
                    $returnArr['status'] = "Success";
                    $returnArr['msg'] = "Data Successfully Add";
            }
            else{
                    $returnArr['status'] = "Error";
                    $returnArr['msg'] = "Something went wrong ...Please try again !!! Error";
            }
            echo  json_encode($returnArr); 


    }
}
?>