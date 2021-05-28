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
     <title>Judges Library | Manage Legislative Act</title>
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



<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-body">
        <h4 class="modal-title">Upload File</h4><br>
        <form role="form" method="post"  enctype="multipart/form-data">
            <input type="file" name="file" id="file">
          <input type="hidden" name="actid" id="actid">
              <input type="hidden" name="colName" id="colName"> <br>
                      <button type="button" class="btn btn-primary" onclick="saveuploadFile();">Upload</button> 
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
                         if (file_exists($file_act) && $result->file_principal_act!="")
                         {
                             echo htmlentities($result->file_principal_act);                       
                            echo '<p><a href="'.$file_act.'" target="_blank" title="view pdf">View</a>';
                            ?>&nbsp;| <i class="fa fa-cross" aria-hidden="true"></i><a href="#"  onclick="delete_pdf('<?=$result->file_principal_act?>','<?=$result->id?>','file_principal_act')"> Delete</a></p>
                            <?php
                         }else{
                            ?>
                             <button id="myBtn" class="btn btn-info" onclick="showfileupload(<?php  echo  $result->id ?>,'file_principal_act');">Upload</button>
                            <?php
                         }
                         ?></td>
                         <td class="center"><?php 
                         $file_asset=$target_act_path.$result->file_president_asset;
                         if (file_exists($file_asset) && $result->file_president_asset!="")
                         {
                            echo htmlentities($result->file_president_asset);
                            
                            echo '<p><a href="'.$file_asset.'" target="_blank" title="view pdf"> View</a>';
                            ?>&nbsp;| <a href="#" onclick="delete_pdf('<?=$result->file_president_asset?>','<?=$result->id?>','file_president_asset')">Delete</a></p>
                            <?php
                         }else{
                            ?>
                             <button id="myBtn" class="btn btn-info" onclick="showfileupload(<?php  echo  $result->id ?>,'file_president_asset');">Upload</button>
                            <?php
                         }


                         ?></td>
                        <td class="center" ><?php 
                         $file_enf=$target_act_path.$result->file_enforcment;
                         if (file_exists($file_enf) && $result->file_enforcment!="")
                         {
                            echo htmlentities($result->file_enforcment);
                            
                            echo '<p><a href="'.$file_enf.'" target="_blank" title="view pdf"> View</a>';
                            ?>&nbsp;| <a href="#"  onclick="delete_pdf('<?=$result->file_enforcment?>','<?=$result->id?>','file_enforcment')">Delete</a></p>
                            <?php
                         }else{?>
                              <!-- <button type="button" class="btn btn-info btn-lg" onclick="showfileupload(<?php  //echo  $result->id ?>,'file_enforcment');">Open Modal<?php  //echo  $result->id ?></button> -->
                              <button id="myBtn" class="btn btn-info" onclick="showfileupload(<?php  echo  $result->id ?>,'file_enforcment');">Upload</button>
                         <?php }

                         
                        ?></td>

                        <td class="center" ><?php echo htmlentities($result->created_on);?></td>                        
                        <td class="center">

                        <a href="edit-principalact-lrca?id=<?php echo htmlentities($result->id);?>"><button class="btn btn-primary"><i class="fa fa-edit "></i> Edit</button> 

                      

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
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>
    <!--User delete /status update--->

<script>
    
function showfileupload(id,colName){

  $("#actid").val(id);
  $("#colName").val(colName);
  $("#myModal").show();
}
function closemodel(){
 $("#myModal").hide();   
}
function saveuploadFile(){
        var fd = new FormData();
        var colName = $("#colName").val();
        var id = $("#actid").val();
        var fileval = $("#file").val();
        var ext = fileval.split('.').pop();
        if(fileval != '' && ext !="pdf"){
            $(".error").show();
            $("#errorMsg").text("Select Only Pdf File");
            setTimeout(
            function() 
            {
            $(".error2").hide();
            }, 2000);
           return false;
        } 
        var files = $('#file')[0].files;
        fd.append('id',id);        
        fd.append('colName',colName);        
        fd.append('mode', 'edit');        
        fd.append('file',files[0]);
        $.ajax({
                type: 'POST',
                url: 'legislative/legislative_ajax',                  
                data: fd,          
//                dataType: "json",
                async:false,
                contentType: false,
                processData: false,
                error: function() { console.log("error"); },
                success: function(response) { 

                  if(response.status == 'Success'){                                             
                       $("#myModal").hide(); 
                       $('#successMsg').text(response.msg);
                       $('.success').show();                                               
                        setTimeout(
                        function() 
                        {
                            
                        $('.success').hide();       
                        window.location.href="manage-legislative";   //do something special
                        }, 1000);
                        
                   }else{                        
                         $('#errorMsg').text(response.msg);
                         $('.error').show();
                         setTimeout(
                         function() 
                         {
                         $('.error').hide();                            
                         }, 4000);
                   }
                
                },
         });
}
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
function delete_pdf(fileName,id,colName){
    var fd = new FormData();
     fd.append('mode',"del");   
     fd.append('fileName',fileName);   
     fd.append('id',id);   
     fd.append('colName',colName);   
      $.ajax({
                type: 'POST',
                url: 'legislative/legislative_ajax',                  
                data: fd,                                               
                async:false,
                contentType: false,
                processData: false,
                error: function() { console.log("error"); },
                success: function(response) { 
                  if(response.status == 'Success'){                                             
                       $('#successMsg').text(response.msg);
                       $('.success').show();                                               
                       window.location.reload();
                   }else{                        
                         $('#errorMsg').text(response.msg);
                         $('.error').show();
                         setTimeout(
                         function() 
                         {
                         $('.error').hide();                            
                         }, 4000);
                   }
                
                },
         });
    
}
</script>

</body>
</html>
<?php } ?>