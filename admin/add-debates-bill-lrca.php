<?php
session_start();
error_reporting(1);

include_once 'includes/dbconnect.php';
include_once 'class/lrcbilldetabe.php';


$database = new Database();
$db       = $database->dbConnection();


$lrcbilldetabe     = new LrcBillDebate($db);


if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{ 



?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Judges' Library | Principal Act Debates & Bill </title>
    <!-- BOOTSTRAP CORE STYLE  -->
   
   <link href="assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css" /> 
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wra">
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Add Debates & Bill</h4>
                
                            </div>

</div>




<?php if(isset($_SESSION['error']) && $_SESSION['error']!="")
{?>
<div class="col-md-6">
<div class="alert alert-danger" >
<strong>Error :</strong> 
<?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>

<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"">
<div class="panel panel-info">
<div class="panel-heading">
Debates & Bill 
</div>



<div class="panel-body">
        <form role="form" method="post" action=""  id="frmlrcaDebate" enctype="multipart/form-data">
             <input class="form-control" type="hidden" name="created_by" autocomplete="off"  value="<?=$_SESSION['alogin']?>" />
             <input type="hidden" name="action" value="SAVE_ACT_DEBATES_BILL">


             <div class="form-group">
                    <label class="control-label">Year of Act<span style="color:red;">*</span></label>

                    <select class="form-control" id="act_year"  aria-label=".form-select-sm example" name="act_year" >
                        <option value="">Select Year</option>

                    </select>
                   
                </div>

                <div class="form-group">
                    <label class="control-label">Principal Act<span style="color:red;">*</span></label>

                    <select class="form-control" id="act_id"  aria-label=".form-select-sm example" name="act_id" >
                        <option value="">Select Act</option>

                    </select>
                </div>
             <div class="form-group">
                    <label class="control-label">Bill Title<span style="color:red;">*</span></label>
                    <input maxlength="100" name="bill_title" id="bill_title" type="text" required="required" class="form-control" placeholder="Enter Bill Title" />
                </div>
                <div class="form-group">
                    <label class="control-label">Bill Number<span style="color:red;">*</span></label>
                    <input maxlength="100" name="bill_number" id="bill_number" type="text" required="required" class="form-control" placeholder="Enter Bill Number" />
                </div>
                <div class="form-group">
                    <label class="control-label">Upload Bill</label>
                     <input type="file" id="file_debatebill" name="file_debatebill">
                </div>
                 <div class="form-group">
                    <label class="control-label">Gazette Citation</label>
                    <input maxlength="100" name="debates_gazette_citation" id="debates_gazette_citation" type="text" class="form-control" placeholder="Enter Gazette Citation" />
                </div>

                 
               <div class="form-group">
                    <label class="control-label">Introduced in Lok Sabha</label>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="loksabha" id="loksabha" onchange="showdebates(1);">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                   
                    </select>
                </div>
                <div class="form-group" id="upload_ls" style="display:none;">
                    <label class="control-label">Upload LS debates</label>
                     <input type="file"  id="file_loksabha" name="file_loksabha">
                </div>

                 <div class="form-group">
                    <label class="control-label">Introduced in Rajya Sabha</label>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="rajsabha" id="rajsabha" onchange="showdebates(2);">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                   
                    </select>
                </div>
                <div class="form-group" id="upload_rs" style="display:none;">
                    <label class="control-label">Upload RS debates</label>
                     <input type="file"  id="file_rajsabha" name="file_rajsabha">
                </div>
                 <div class="form-group">
                    <label class="control-label">Introduced in Both Sabha</label>
                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="both_sabha" id="both_sabha"  onchange="showdebates(3);">
                    <option value="">Select</option>
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                   
                    </select>
                </div>
                
               

                <div class="form-group" id="upload_both" style="display:none;">
                    <label class="control-label">Upload Both debates</label>
                     <input type="file" id="file_both_sabha" name="file_both_sabha">
                </div>
       <!--  <div class="form-group">
        <label>Designation</label>
        <select class="form-control" name="category" required="required">
             <option value=""> Select Designation</option>
             <option value=""></option>
        </select>
        </div> -->
         <button type="button" name="Save" id="butsave" class="btn btn-info">Save </button>
<span id="success" style="display:none;width: 400px;border: 1px solid #D8D8D8;padding: 10px;border-radius: 5px;
font-family: Arial;font-size: 11px;text-transform: uppercase;background-color: rgb(236, 255, 216);color: green;text-align: center;margin-top: 30px;"></span>
  <div id="erroutput"></div>
        </form>
</div>
</div>
</div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>

   <script>
    function  showdebates(id)
    {
        var id;
        

        if(id==1)
        {
             var loksabha_debate=$("#loksabha").val();
             if(loksabha_debate==1) 
                {
                    $("#upload_ls").show();
                }else{
                     $("#upload_ls").hide();
                } 
        }
        if(id==2)
        {
              var rajsabha_debate=$("#rajsabha").val();

             if(rajsabha_debate==1) 
                {
                    $("#upload_rs").show();
                }else{
                     $("#upload_rs").hide();
                }
        }

         if(id==3)
        {
             

              var both_debate=$("#both_sabha").val();

             if(both_debate==1) 
                {
                    $("#upload_both").show();
                }else{
                     $("#upload_both").hide();
                } 
        }
    }
   </script>

      
    
</body>
</html>
<?php } ?>
