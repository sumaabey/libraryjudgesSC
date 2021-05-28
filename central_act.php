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
<div style="text-align: center;"><big><big style="font-family: arial;">List
of Central Acts</big></big><br>
</div>
<br>
<br>
<table
 style="margin-left: auto; margin-right: auto; width: 80%; text-align: left;"
 border="0" cellpadding="2" cellspacing="2">
  <tbody>
    <tr style="font-family: arial;">
      <td colspan="26" rowspan="1" style="vertical-align: top;">Browse
:&nbsp;&nbsp;&nbsp; By Title &nbsp;&nbsp;&nbsp;<a href='central_act_year.php' target="_blank">By Year</a><br>
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
    <tr>

<?php
$azRange = range('A', 'Z');
foreach ($azRange as $letter)
{
  //print("$letter\n");
  ?>
  <td
 style="vertical-align: top; font-family: arial; text-align: center; color: rgb(0, 0, 0); background-color: rgb(204, 204, 204);"><a
 style="text-decoration: none;" href="#<?=$letter?>"><?=$letter?></a><br>
      </td>

  <?php 
}

?>

    
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
<table
 style="margin-left: auto; margin-right: auto; width: 80%; text-align: left;"
 border="0" cellpadding="2" cellspacing="2">
  <tbody>

<?php
foreach ($azRange as $letter)
{
  ?>

      <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; text-align: center;"><big><span
 style="font-family: arial; font-weight: bold;"><a name="<?php echo $letter;?>"></a><?php echo $letter;?></span></big><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>

    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>

<!--- GET CONTENT According to the title----->

  <?php
      $act_url="";
      $target_act_path="lrca/act/";
      $sql = "SELECT act_name,file_principal_act FROM tbl_principal_act WHERE status=1 AND view_type='PUBLIC' AND 
      act_title='$letter' ORDER BY id DESC ";
      $statement = $connection->prepare($sql);
      $statement->execute();
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


  ?>

  <tr>
          <td style="vertical-align: top;"><br>
          </td>
          <td style="vertical-align: top;"><small><a href="<?php echo $act_url;?>" target="_blank"
          style="text-decoration: none;"><?php echo htmlentities($row['act_name']);?></a> </small></td>
          <td style="vertical-align: top;"><br>
          </td>
          </tr>

<?php }//end of foreach loop

  ?>



   


    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>



<?php 

}//end of range foreach loop


?>




    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
    <tr>
      <td style="vertical-align: top;"><br>
      </td>
      <td style="vertical-align: top; text-align: center;"><br>
      </td>
      <td style="vertical-align: top;"><br>
      </td>
    </tr>
  </tbody>
</table>
<div><!---menu end--></div>
<!---wrap end-->
</div>
</div>
</div>
<script type="text/javascript">
window.onscroll = function() {scrollFunction()};

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
