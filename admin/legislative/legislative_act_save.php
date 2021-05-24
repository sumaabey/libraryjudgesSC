<?php
error_reporting(1);
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

$time = time();
$legislative->act_name=$_POST['principal_act'];
$legislative->act_number=$_POST['principal_act_no'];
$legislative->gazette_citation=$_POST['gazette_citation'];
$legislative->date_of_president_asset=$_POST['date_of_president_asset'];
$legislative->date_of_enforcment=$_POST['date_of_enforcment'];



$file_principal_act=strtolower($_FILES['fileprincipal_act']['name']);
$file_act =explode(".",$file_principal_act); // get the extension of the file

$fileprincipalact = $time.".".$file_act[1] ;
$target_p_act = '../../lrca/act/'.$fileprincipalact;

if ($_FILES['fileprincipal_act']['type'] == 'application/pdf') 
{

	$upload_act = move_uploaded_file($_FILES['fileprincipalact']['tmp_name'], $target_p_act);
	//echo "<br>pdf file".$target_p_act;

	if($upload_act)
	{
			$sucess_msg =$file_principal_act.' Act File uploaded successfully.';$errorVal=0;
			$returnArr['status'] = "Success";
			$returnArr['msg'] = $sucess_msg ;
			
	}
	else
	{
			$errorVal=1;
		    $err_msg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'.$_FILES['file_principal_act']['error'];
		    //echo json_encode(array("statusCode"=>201,"message"=>$err_msg));
		     $returnArr['status'] = "Error";
			 $returnArr['msg'] = $err_msg;
	}//end of move upload
}


$file_president_asset=strtolower($_FILES['file_president_asset']['name']);
$file_president_asset =explode(".",$file_president_asset); // get the extension of the file

$filepresidentasset = $time.".".$file_president_asset[1] ;
$target_president_asset = '../../lrca/act/'.$filepresidentasset;

if ($_FILES['file_president_asset']['type'] == 'application/pdf') 
{

	$upload_president_asset = move_uploaded_file($_FILES['file_president_asset']['tmp_name'], $target_president_asset );
	//echo "<br>pdf file".$target_p_act;
	if($upload_president_asset)
	{
			$sucess_msg =$file_president_asset.' Asset File uploaded successfully.';$errorVal=0;
			$returnArr['status'] = "Success";
			$returnArr['msg'] = $sucess_msg ;
			
	}
	else
	{
			$errorVal=1;
		    $err_msg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'.$_FILES['file_president_asset']['error'];
		    //echo json_encode(array("statusCode"=>201,"message"=>$err_msg));
		     $returnArr['status'] = "Error";
			 $returnArr['msg'] = $err_msg;
	}//end of move upload
}


$file_enforcment=strtolower($_FILES['file_enforcment']['name']);
$file_enforcment =explode(".",$file_enforcment); // get the extension of the file

$fileenforcment = $time.".".$file_enforcment[1] ;
$target_enforcment = '../../lrca/act/'.$fileenforcment;

if ($_FILES['file_enforcment']['type'] == 'application/pdf') 
{

	$upload_enforcment = move_uploaded_file($_FILES['file_enforcment']['tmp_name'], $target_enforcment );
	//echo "<br>pdf file".$target_p_act;

	if($upload_enforcment)
	{
			$sucess_msg =$file_enforcment.' President Asset File uploaded successfully.';$errorVal=0;
			$returnArr['status'] = "Success";
			$returnArr['msg'] = $sucess_msg ;
			
	}
	else
	{
			$errorVal=1;
		    $err_msg = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.'.$_FILES['file_enforcment']['error'];
		    //echo json_encode(array("statusCode"=>201,"message"=>$err_msg));
		     $returnArr['status'] = "Error";
			 $returnArr['msg'] = $err_msg;
	}//end of move upload
}

$legislative->file_enforcment=$fileenforcment;
$legislative->file_president_asset=$filepresidentasset;
$legislative->file_principal_act=$fileprincipalact;


if($errorVal==0)
{
	$createData=$legislative->saveData();
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




?>