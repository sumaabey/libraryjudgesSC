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

                         <td class="center"><?php echo htmlentities($result->file_principal_act);

                         if($result->file_principal_act!="")
                         {
                            $file_act=$target_act_path.$result->file_principal_act;
                            echo '<p><a href="'.$file_act.'" target="_blank" title="view pdf"><i class="fa fa-eye "></i> </a>';
                            ?>&nbsp;<i class="fa fa-cross" aria-hidden="true"></i><a href="#" target="_blank" onclick="delete_pdf('<?=$result->act_name?>','file_principal_act')">Delete</a></p>
                            <?php
                         }else{
                            echo '<p>delete</p>';
                         }
                         ?></td>
                         <td class="center"><?php echo htmlentities($result->file_president_asset);?></td>
                        <td class="center" ><?php echo htmlentities($result->file_enforcment);?></td>

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


   

</body>
</html>
<?php } ?>