<?php
  require "dbconnection.php";
  $sql="SELECT * FROM barangays LIMIT 1";
  $first_id=$conn->query($sql)->fetch_assoc()['id'];
?>
<!DOCTYPE html>
<html>
<head><title></title>
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<style>
.mySlides {display:none;}
  body{
   background-image: url("c.jpg");
   background-repeat: no-repeat;
   background-attachment: fixed;
   background-size: cover;  
 }

 .button {
    background-color: blue;
    border: none;
    color: none;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
</style>
</head>
<body>

<div class="container">
  <div class="page-header">
    
    <h1 style="color: WHITE;" >QUEZON CITY MONITORING SYSTEM</h1>      
  </div>
  <p style="color: WHITE;">This is some text.FJDSGHJDSHKFJHDSKFHJDSHDSHFSHFHJDSHJDSHFKJSHSHJFHDSKF</p>  
  <p style="color: WHITE;">This is some text.DSFDSFDSFDSFDSFDSFDSFDSFDSFDSFDSFDSFDSFDSFDSFDSF</p>      
    
  <p style="color:WHITE;">This is another text.SDFDSFSDFSDFDSFSDFDSFDSFSDFDSFDSFSD/p>      
</div>

<div>
  
 <a href="login.php"  class="btn btn-primary" style="margin-left:700px; margin-top:100px; width: 300px; height: 50px; font-size: 20px">LOG-IN</a>
 <a href="statistics.php?brgy_id=<?php echo $first_id?>" class="btn btn-primary" style="margin-left:700px; margin-top:10px; width: 300px; height: 50px;font-size: 20px">STATISTIC</a>


</div>


 
</body>
</html>
