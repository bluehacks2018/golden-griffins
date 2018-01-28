<?php
  session_start();
  require "dbconnection.php";
  if(!isset($_SESSION['currentId']))
  {
    header("location:login.php");
  }
  if(isset($_POST['head_count']))
  {
      $head_count=$_POST['head_count'];
      $issue_count=$_POST['issue_count'];
      $barangay=$_POST['barangay'];
      $issue=$_POST['issue'];
      $sql="UPDATE barangay_issue SET head_count=$head_count, issue_count=$issue_count WHERE issue=$issue AND barangay=$barangay";
      $conn->query($sql);
  }
  if(isset($_POST['new_password']))
  {
    $password=$_POST['new_password'];
    $sql="UPDATE users SET password='$password' WHERE id=".$_SESSION['currentId'];
    $conn->query($sql);
    echo $sql;
  }
?>
<!DOCTYPE html>
<head>
<title>Barangay Statistics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<script src="jquery-1.11.3.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
 
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">BARANGAY | <?php echo $_SESSION['currentBarangay']; ?></a>
    </div>
      <ul class="nav navbar-nav" style="float: right;">
      <li class="active"><a href="logout.php"  data-target="#settingsModal">LOG-OUT</a></li>
    </ul>
  
    <ul class="nav navbar-nav" style="float: right;">
      <li class="active"><a href="#" data-toggle="modal" data-target="#settingsModal">CHANGE PASSWORD</a></li>
    </ul>
  </div>
</nav>
<div class="container">
  <h2><b>STATISTICS</b></h2>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>SUBJECT MATTER</th>
        <th>HEAD COUNT</th>
        <th>ISSUE COUNT</th>
        <th>PERCENTAGE</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT * FROM barangay_issue INNER JOIN issues ON barangay_issue.issue=issues.id WHERE barangay=".$_SESSION['currentId'];
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc())
        {
          $head_count=$row['head_count'];
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
            echo "<td>";
            echo "<a class='btn btn-primary' onclick=\"updateIssues('$head_count', '$issue_count', '$id', '$barangay', '$issue')\" data-toggle='modal' data-target='#updateModal'>UPDATE</a>";
            echo "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</div>

<div id="settingsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> EDIT PASSWORD</h4>
      </div>
      <div class="modal-body"><center>
        <form class="form-inline" method="POST" onsubmit="return checkPword(this)">
          <table>
            <tr>
              <td>NEW PASSWORD: </td>
              <td>
                <input type="password" class="form-control" name="new_password">
              </td>
            <tr>
              <td>CONFIRM PASSWORD: </td>
              <td>
                <input type="password" class="form-control" name="confirm_password">
              </td>
            </tr>
          </table><hr>
           <div style="margin-left: 60%;">
              <button class="btn btn-primary">SAVE CHANGES</button>
              <button class="btn btn-default" data-dismiss="modal">CLOSE</button>
          </div>
        </form></center>
      </div>
    </div>
  </div>
</div>

<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span>UPDATE ISSUE DETAILS</h4>
      </div>
      <div class="modal-body"><center>
        <form class="form-inline" method="POST">
          <table>
            <tr>
              <td>HEAD COUNT: </td>
              <td>
                <input type="number" class="form-control" name="head_count" id="head_count" min=0>
                <input type="hidden" name="barangay_issue_id" id="barangay_issue_id">
                <input type="hidden" name="barangay" id="barangay">
                <input type="hidden" name="issue" id="issue">
              </td>
            </tr>
            <tr>
              <td>ISSUE COUNT: </td>
              <td>
                <input type="number" class="form-control" name="issue_count" id="issue_count" min=0>
              </td>
            </tr>
          </table><hr>
           <div style="margin-left: 60%;">
              <button class="btn btn-primary">SAVE CHANGES</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
          </div>
        </form></center>
      </div>
    </div>
  </div>
</div>
<script>
  function updateIssues(head_count, issue_count, id, barangay, issue)
  {
    $("#issue_count").val(issue_count);
    $("#head_count").val(head_count);
    $("#barangay_issue_id").val(id);
    $("#barangay").val(barangay);
    $("#issue").val(issue);
  }function checkPword(frm)
    {
      if(frm.new_password.value==frm.confirm_password.value)
      {
          return true;
      }
      else
      {
        alert("PASSWORD MISMATCH");
        return false;
      }
    }
</script>
</body>
</html>
