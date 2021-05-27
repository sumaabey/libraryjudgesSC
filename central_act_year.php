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
a {font-family:Arial;font-size:16px;cursor: auto}
a:link {color:black;}
a:visited {color: #000000}
a:hover {text-decoration: none; color: #3333ff; font-weight:bold;}
a:active {color: #000000;text-decoration: none}
  </style>
  <title>List of Central Acts</title>
  <style type="text/css">body {background-image: url('../image/bg2.jpg');}</style>
  <style type="text/css"> a {text-decoration:none;}</style>
  <style type="text/css">#wrap {border:1px solid #708090 box-shadow: 0px 16px 10px 0px rgba(0,0,0,0.6); height:1500px; width:1020px; margin:auto;}</style>
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
height:23090px; 
width:960px; 
margin:5px; 
float:left;
}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.button4 {background-color: #e7e7e7; color: black;} /* Gray */ 

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
<h2 style="font-family: Calibri;">Central Legislation<br>
</h2>
</center>
</div>
<br>
<div id="main3">
<div style="text-align: center;" id="left1"><br>
<div style="text-align: center;"><big><big style="font-family: arial;">Year wise List
of Central Acts </big></big><br>
</div>
<br>
<br>
<table
 style="margin-left: auto; margin-right: auto; width: 80%; text-align: left;"
 border="0" cellpadding="2" cellspacing="2">
  <tbody>
   <tr style="font-family: arial;">
      <td colspan="26" rowspan="1" style="vertical-align: top;">Browse
:&nbsp;&nbsp;&nbsp; By Year &nbsp;&nbsp;&nbsp;<a href='central_act.php' target="_blank">By Title</a><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
      <td style="vertical-align: top; font-family: arial;"><br>
      </td>
    </tr>
   
  </tbody>
</table>
<!-- <div style="text-align: center;"><br>
<br>
<big><span style="font-family: arial; font-weight: bold;"><a name="A"></a>A</span></big><br>
<br>
</div> -->
<br>
<div style="text-align: center;">

<?php

$sql = "SELECT act_year FROM tbl_principal_act WHERE status=1 AND view_type='PUBLIC' GROUP BY act_year order by act_year DESC";
$statement = $connection->prepare($sql);
$statement->execute();
$totalrows=$statement->rowCount();
$result = $statement->fetchAll();

?>


<div class="act_by_year" >
<?php
foreach($result as $row) 
{ 
  $act_year=$row['act_year'];

?>
  <button class="button button4"><a href="yearwise_cental_act?yearval=<?php echo base64_encode($act_year);?>"><?php echo $row['act_year'];?></button>
<?php
}

if (!$result) { // here! as simple as that
    echo 'No data found';
}
?>

</div><!--end of act by year-->







<div><!---menu end--></div>
<!---wrap end-->
</div>
</div>
</div>
<script type="text/javascript">

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}


function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
</div>
</div>
</body>
</html>
