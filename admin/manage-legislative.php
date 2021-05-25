<?php
session_start();
error_reporting(1);

include_once 'includes/dbconnect.php';
include_once 'class/legislativeact.php';


$database = new Database();
$db       = $database->dbConnection();


$legislative     = new Legislativeact($db);




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
     <title>Judges' Library | Manage Legislative Act</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
<style>
/*body {font-family: Arial, Helvetica, sans-serif;}*/

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 27%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">Manage Legislative Act</h4>
    </div>
     <div class="row">
    <?php if($_SESSION['error']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-danger" >
 <strong>Error :</strong> 
 <?php echo htmlentities($_SESSION['error']);?>
<?php echo htmlentities($_SESSION['error']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['msg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['msg']);?>
<?php echo htmlentities($_SESSION['msg']="");?>
</div>
</div>
<?php } ?>
<?php if($_SESSION['updatemsg']!="")
{?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['updatemsg']);?>
<?php echo htmlentities($_SESSION['updatemsg']="");?>
</div>
</div>
<?php } ?>


   <?php if($_SESSION['delmsg']!="")
    {?>
<div class="col-md-6">
<div class="alert alert-success" >
 <strong>Success :</strong> 
 <?php echo htmlentities($_SESSION['delmsg']);?>
<?php echo htmlentities($_SESSION['delmsg']="");?>
</div>
</div>
<?php } ?>

</div>


        </div>




         <!-- Modal -->
<!--   <div class="model " id="myModal" style="display: none;">
    <div class="modal-dialog"> -->
    
      <!-- Modal content-->
    <!--   <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onclick="closemodel();">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <input type="file" name="">
          <input type="text" name="actid" id="actid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closemodel();">Close</button>
        </div>
      </div>
      
    </div>
  </div> -->
  <!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-body">
        <h4 class="modal-title">Upload File</h4><br>
        <form role="form" method="post" action=""  id="frmlrcaupload" enctype="multipart/form-data">
          <input type="file" name="">
          <input type="hidden" name="actid" id="actid">
           <input type="hidden" name="colname" id="colname"><br><button class="btn btn-primary">Upload</button> 
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closemodel();">Close</button>
        </div>
  </div>

</div>
  
  <!-- END -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                             
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Legislative Act
                        </div>
                        <div class="panel-body">
                   
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                             <th>#</th>
                                            <th>Principal Act</th>
                                            <th>Act Number</th>
                                            <th>Gazette Citation</th>

                                             <th>Act file</th>
                                            <th>President's Assent file</th>
                                            <th> Enforcement file</th>

                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$stmt=$legislative->viewActData();
$Count = $stmt->rowCount();
$cnt=1;
$target_act_path="../lrca/act/";

if($Count > 0)
{
while($result = $stmt->fetch(PDO::FETCH_OBJ))
{               ?>                                      
                   <tr class="odd gradeX">
                        <td class="center"><?php echo htmlentities($cnt);?></td>
                        <td class="center"><?php echo htmlentities($result->act_name);?></td>
                        <td class="center"><?php echo htmlentities($result->act_number);?></td>
                        <td class="center"><?php echo htmlentities($result->gazette_citation);?></td>

                         <td class="center"><?php 
                         $file_act=$target_act_path.$result->file_principal_act;
                         if (file_exists($file_act))
                         {
                             echo htmlentities($result->file_principal_act);                       
                            echo '<p><a href="'.$file_act.'" target="_blank" title="view pdf">View</a>';
                            ?>&nbsp;| <i class="fa fa-cross" aria-hidden="true"></i><a href="#" target="_blank" onclick="delete_pdf('<?=$result->file_principal_act?>','file_principal_act')"> Delete</a></p>
                            <?php
                         }else{
                            ?>
                             <button id="myBtn" class="btn btn-info" onclick="showfileupload(<?php  echo  $result->id ?>,'file_principal_act');">Upload</button>
                            <?php
                         }
                         ?></td>
                         <td class="center"><?php 
                         $file_asset=$target_act_path.$result->file_president_asset;
                         if (file_exists($file_asset))
                         {
                            echo htmlentities($result->file_president_asset);
                            
                            echo '<p><a href="'.$file_asset.'" target="_blank" title="view pdf"> View</a>';
                            ?>&nbsp;| <a href="#" target="_blank" onclick="delete_pdf('<?=$result->file_president_asset?>','file_president_asset')">Delete</a></p>
                            <?php
                         }else{
                            ?>
                             <button id="myBtn" class="btn btn-info" onclick="showfileupload(<?php  echo  $result->id ?>,'file_president_asset');">Upload</button>
                            <?php
                         }


                         ?></td>
                        <td class="center" ><?php 
                         $file_enf=$target_act_path.$result->file_enforcment;
                         if (file_exists($file_enf))
                         {
                            echo htmlentities($result->file_enforcment);
                            
                            echo '<p><a href="'.$file_enf.'" target="_blank" title="view pdf"> View</a>';
                            ?>&nbsp;| <a href="#" target="_blank" onclick="delete_pdf('<?=$result->file_enforcment?>','file_enforcment')">Delete</a></p>
                            <?php
                         }else{?>
                              <!-- <button type="button" class="btn btn-info btn-lg" onclick="showfileupload(<?php  //echo  $result->id ?>,'file_enforcment');">Open Modal<?php  //echo  $result->id ?></button> -->
                              <button id="myBtn" class="btn btn-info" onclick="showfileupload(<?php  echo  $result->id ?>,'file_enforcment');">Upload</button>
                         <?php }

                         
                        ?></td>

                        <td class="center" ><?php echo htmlentities($result->created_on);?></td>                        
                        <td class="center">

                        <a href="edit-legislative_act?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 

                      

                        </td>
                    </tr>
<?php $cnt=$cnt+1;
}//end of while

}

 ?>                      
                                           
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>
    <!--User delete /status update--->

<script>
    
function showfileupload(id,colName){

  $("#actid").val(id);
  $("#myModal").show();
}
function closemodel(){
 $("#myModal").hide();   
}
</script> 
   <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
<?php } ?>