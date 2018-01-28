<?php
  session_start();
  require "dbconnection.php";
  $brgy_name="";
  $result=$conn->query("SELECT * FROM barangays WHERE id=".$_GET['brgy_id']);
  if($result->num_rows==0)
  {
    header("location: login.php");
  }
  else
  {
    $row=$result->fetch_assoc();
    $brgy_name=$row['barangay_name'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>QUEZON CITY BARANGAY STATISTICS</title>

<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
 
 </head>
 <body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">QUEZON CITY BARANGAY STATISTICS</a>
    </div>
  </div>
</nav>
  
<div class="container-fluid">        
 <div class="row"> <div class="col-md-3">
      <div class="list-group">
        
        <?php
          $sql="SELECT * FROM barangays";
          $result=$conn->query($sql);
          while($row=$result->fetch_assoc())
          {
            $barangay=$row['barangay_name'];
            $barangay_id=$row['id'];
            if($_GET['brgy_id']==$barangay_id)
            {
              echo "<a href='statistics.php?brgy_id=$barangay_id' class='list-group-item active'>$barangay</a>";
            }
            else
            {
              echo "<a href='statistics.php?brgy_id=$barangay_id' class='list-group-item'>$barangay</a>";
            }
          }
        ?>
    </div>
  </table>
 </div>
 <div class="col-md-9">
  <h3>STATISTICS &mdash;    <?php echo $brgy_name;?></h3>
   <table class="table table-hover" border="1">
    <thead>
      <tr>
        <th>SUBJECT</th>
        <th>HEAD COUNT</th>
        <th>ISSUE COUNT</th>
        <th>PERCENTAGE</th>
      </tr>
    </thead>
    
    <tbody>
      <?php
        $sql="SELECT * FROM barangay_issue INNER JOIN issues ON barangay_issue.issue=issues.id WHERE barangay=".$_GET['brgy_id'];
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc())
        { $head_count=$row['head_count'];
          $issue_count=$row['issue_count'];
          $id=$row['id'];
          $barangay=$row['barangay'];
          $issue=$row['issue'];
          echo "<tr>";
            echo "<td>";
            echo $row['issue_name'];
            echo "</td>";
            echo "<td>";
            echo $row['head_count'];
            echo "</td>";
            echo "<td>";
            echo $row['issue_count'];
            echo "</td>";
            echo "<td>";
            echo ($head_count==0) ? "<span style='color:red;'>INVALID</span>" : round(($issue_count/$head_count)*100, 2);
            echo "</td>";
          echo "</tr>";
        }
      ?>      
    </tbody>
  
  </table>
 </div> 





 </div>


</div>

</body>
</html>