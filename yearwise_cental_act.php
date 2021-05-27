<?php
include_once 'admin/includes/dbconnect.php';

//error_reporting(1);

$dbclass = new Database();
$connection = $dbclass->dbConnection();




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equiv="Content-Type"
 content="text/html; charset=iso-8859-1">
  <style type="text/css">
a {font-family:Arial;font-size:15px;cursor: auto}
a:link {color:black;}
a:visited {color: #000000}
a:hover {text-decoration: none; color: #3333ff; font-weight:bold;}
a:active {color: #000000;text-decoration: none}
  </style>
  <title>Central Act</title>
  <style type="text/css">body {background-image: url('../image/bg2.jpg');}</style>
  <style type="text/css"> a {text-decoration:none;}</style>
  <style type="text/css">#wrap {border:1px solid #708090 box-shadow: 0px 16px 10px 0px rgba(0,0,0,0.6); height:700px; width:1020px; margin:auto;}</style>
  <style type="text/css">
.vertical-menu{width:230px; font-family:Arial, Helvetica, sans-serif; font-size:15px;}
.vertical-menu a {background-color:#fff; font-size:13px; color:black; display:block; padding:12px; text-decoration:none;}
.vertical-menu a:hover {background-color:#F0F8FF;}
.vertical-menu a.active {background-color:#9ec9cf; color:white;}
  </style>
  <style type="text/css">
#left1{
border:1px solid #9ec9cf; 
border-radius:05px; 
font-family:Arial, Helvetica, sans-serif; 
text-align: justify;
padding:20px;	
height:600px; 
width:960px; 
margin:5px; 
float:left;
}
  </style>
</head>
<body>
<div id="wrap">
<div id="header">
      <div>
      <center><a href="index"><img alt="" src="image/logo2.png" height="110" width="300"></a></center>
      </div>
      <div>
      <center><img alt="" src="image/scliblog.png"
       style="width: 500px; height: 105px;"></center>
      </div>
</div>
<div id="main2">
<div>
<hr color="#9ec9cf" size="3" width="100%"></div>
<div>
<center>
<h2 style="font-family: Calibri;"> List of Central Acts for the year <?php echo base64_decode($_GET['yearval']);?><br>
</h2>
</center>
</div>
<br>
<!----------------------------------LEFT ROW ---------------------------------------------->
<div id="main3">
<div style="text-align: center;" id="left1"><b><br>
<br>
</b>
<table
 style="margin-left: auto; margin-right: auto; width: 70%; text-align: left;"
 border="0" cellpadding="2" cellspacing="2">
  <tbody>



<?php

$act_url="";
$target_act_path="lrca/act/";

$yearval=base64_decode($_GET['yearval']);
$curryear=date("Y");
if($yearval!="")
{
  $condyear=" AND act_year='$yearval' ";
}else{
   $condyear=" AND act_year='$curryear' ";
}

$sql = "SELECT act_name,file_principal_act  FROM tbl_principal_act WHERE status=1 AND view_type='PUBLIC' $condyear order by act_name DESC";
$statement = $connection->prepare($sql);
$statement->execute();
$totalrows=$statement->rowCount();
$result = $statement->fetchAll();


foreach($result as $row) 
{ 

        $file_principal_act=$row['file_principal_act'];
        $file_act=$target_act_path.$file_principal_act;
        if(file_exists($file_act) && $file_principal_act!="")
        {

          $act_url=$file_act;
        }else{
          $act_url="";
        }

?>     <tr>      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; text-align: right;"><li><br>
      </li>
      </td>
      <td      style="vertical-align: top; font-family: arial; text-align: left;"><small><a  style="text-decoration: none;"
      href="<?php echo $act_url;?>" target="_blank">
    <?php echo htmlentities($row['act_name']);?></a><br>
      </small></td>
      </tr>

    
<?php

}//end of foreach looop

if (!$result) { // here! as simple as that
    ?>
        <tr>      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; text-align: right;"><li><br>
      </li>
      </td>
      <td
 style="vertical-align: top; font-family: arial; text-align: left;"><small>No data Found<br>
      </small></td>
    </tr>
    <?php
}

   ?>
   
   
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><small><br>
      </small></td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><small><br>
      </small></td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><small><br>
      </small></td>
    </tr>
    <tr align="center">
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
  </tbody>
</table>
<b><br>
<br>
<br>
<br>
</b></div>
</div>
</div>
</div>
</body>
</html>
