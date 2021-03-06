<?php
session_start();
include_once 'includes/functions.php';


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
    <title>Judges' Library | Principal Act</title>
    <!-- BOOTSTRAP CORE STYLE  -->
   
   <link href="assets/css/bootstrap.css" rel="stylesheet" id="bootstrap-css" /> 
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
 <style>
        .alert {
          padding: 20px;
          color: #a94442;
          background-color: #f2dede;
          border-color: #ebccd1;
          width: 21%;
          float: left;
          margin-top: -78%;
        }

        .closebtn {
          margin-left: 15px;
          color: white;
          font-weight: bold;
          float: right;
          font-size: 22px;
          line-height: 20px;
          cursor: pointer;
          transition: 0.3s;
        }

        .closebtn:hover {
          color: black;
        }
        .alert.success {  
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
 </style>
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
                <h4 class="header-line">Add Principal Act</h4>
                
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
Principal Act
</div>



<div class="panel-body">
        <form role="form" method="post" action="legislative/legislative_act_save"  id="frmlrca" enctype="multipart/form-data">
             <input class="form-control" type="hidden" name="created_by"  id="created_by"  autocomplete="off"  value="<?php echo $_SESSION['alogin'];?>" />
             <input type="hidden" name="action" value="SAVE_ACT">
       <div class="form-group">
                    <label class="control-label">Name of the Principal Act<span style="color:red;">*</span></label>
                    <input maxlength="100" name="principal_act" id="act_name" type="text" required="required" class="form-control" placeholder="Enter Principal Act Name" />
                </div>
                <div class="form-group">
                    <label class="control-label">Year of Act<span style="color:red;">*</span></label>
                     <?php //call the function 
                     $currentyear=date("Y");  
                     yearDropdown('1800', $currentyear);  
 
                    ?>
                </div>
                 <div class="form-group">
                    <label class="control-label">Show Type</label>
                    <input type="radio" name="view_type" id="view_type" value="PUBLIC" checked="">PUBLIC
                    <input type="radio" name="view_type" id="view_type" value="PRIVATE">PRIVATE
                </div>
                <div class="form-group">
                    <label class="control-label">Upload</label>
                     <input type="file" id="file_principal_act" name="file_principal_act">
                </div>

                 <div class="form-group">
                    <label class="control-label">Act Number<span style="color:red;">*</span></label>
                    <input maxlength="100" name="principal_act_no" id="act_number" type="text" required="required" class="form-control" placeholder="Enter Principal Act Number" />
                </div>
               <div class="form-group">
                    <label class="control-label">Gazette Citation</label>
                    <input maxlength="100" name="gazette_citation" id="gazette_citation" type="text" class="form-control" placeholder="Enter Gazette Citation" />
                </div>
                 <div class="form-group">
                    <label class="control-label">Date of President's Assent</label>
                    <input maxlength="100" name="date_of_president_asset" id="date_of_president_asset" type="text"  class="form-control" placeholder="Enter Date of President's Assent" />
                </div>
                <div class="form-group">
                    <label class="control-label">Upload</label>
                     <input type="file"  id="file_president_asset" name="file_president_asset">
                </div>

                 <div class="form-group">
                    <label class="control-label">Date of Enforcement</label>
                    <input maxlength="100" name="date_of_enforcment" id="date_of_enforcment" type="text"  class="form-control" placeholder="Enter Date of Enforcement" />
                </div>
                <div class="form-group">
                    <label class="control-label">Upload</label>
                     <input type="file" id="file_enforcment" name="file_enforcment">
                </div>
       <!--  <div class="form-group">
        <label>Designation</label>
        <select class="form-control" name="category" required="required">
             <option value=""> Select Designation</option>
             <option value=""></option>
        </select>
        </div> -->
       <input type="submit" name="Save" id="butsave" class="btn btn-info" value="Save">
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
        <div class="alert error" style="display:none" id="errorMsg">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
        </div>
             <div class="alert success" style="display:none" id="successMsg">
        <span class="closebtn" onclick="this.parentElement.style.display='none';" >&times;</span>      
     </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>

  <script src="legislative/js/legislative_act.js"></script>

      
    
</body>
</html>
<?php } ?>
