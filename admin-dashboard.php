<?php
  require "dbconnection.php";
  session_start();
  if(isset($_POST['add_brgy']))
  {
    $sql="INSERT INTO barangays(barangay_name) VALUES(?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s", $brgy);
    $brgy=strtoupper($_POST['add_brgy']);
    $stmt->execute();
  }
  if(isset($_POST['barangay_update']))
  {
    $id=$_POST['barangay_id'];
    $sql="UPDATE barangays SET barangay_name=? WHERE id=".$id;
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s", $brgy);
    $brgy=strtoupper($_POST['barangay_update']);
    $stmt->execute();
  }
  if(isset($_POST['issue_update']))
  {
    $id=$_POST['issue_id'];
    $sql="UPDATE issues SET issue_name=? WHERE id=".$id;
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s", $issue);
    $issue=strtoupper($_POST['issue_update']);
    $stmt->execute();
  }
  if(isset($_GET['delete_barangay']))
  {
    $sql="DELETE FROM barangays WHERE id=".$_GET['delete_barangay'];
    $conn->query($sql);
  }
  if(isset($_GET['delete_issue']))
  {
    $sql="DELETE FROM issues WHERE id=".$_GET['delete_issue'];
    $conn->query($sql);
  }
  if(isset($_POST['add_issue']))
  {
    $sql="INSERT INTO issues(issue_name) VALUES(?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s", $issue);
    $issue=strtoupper($_POST['add_issue']);
    $stmt->execute();
  }
  if(isset($_POST['new_password']))
  {
    $sql="UPDATE users SET password=? WHERE type='admin'";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s", $password);
    $password=$_POST['new_password'];
    echo $password;
    $stmt->execute();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>QUEZON CITY - STATS</title>
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
<script src="jquery-1.11.3.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
 
 </head>
 <body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">HEAD GOVERMENT</a>
    </div>
    <ul class="nav navbar-nav" style="float: right;">
      <li class="active"><a href="#" data-toggle="modal" data-target="#settingsModal">CHANGE PASSWORD</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
<div class="row">
  <form class="form-inline" method="POST">
     <center>
    <label>BARANGAY: </label>
    <input type="text" class="form-control" name="add_brgy" placeholder="ADD BARANGAY" required>
    <button class="btn btn-primary">ADD</button><br><br>
  </center>
  </form>
</div>        
 <div class="row">
 <div class="col-md-8">

   <table class="table table-hover" border="1">
    <thead>
      <tr>
        <th>BARANGAY</th>
        <th>ACTIONS</th>
       
      </tr>
    </thead>
    
    <tbody>
      <?php
        $sql="SELECT * FROM barangays";
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc())
        {
          $name=$row['barangay_name'];
          $id=$row['id'];
          echo "<tr>";
            echo "<td>";
              echo $name;
            echo "</td>";
            echo "<td>";
              echo "<a class='btn btn-primary' onclick=\"edit('$id', '$name')\" data-toggle='modal' data-target='#editModal'>EDIT</a> ";
              echo "<a class='btn btn-primary' href='#editModal'>VIEW STATISTICS</a> ";
              echo "<a class='btn btn-primary' href='admin-dashboard.php?delete_barangay=$id'>DELETE</a> ";
            echo "</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  
  </table>
 </div> 
 <div class="col-md-4">
  <table class="table table-bordered" border="1">
    <thead>
      <tr>
        <th>ISSUES</th>
        <th>ACTIONS</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql="SELECT * FROM issues";
        $result=$conn->query($sql);
        while($row=$result->fetch_assoc())
        {
          $issue_name=$row['issue_name'];
          $issue_id=$row['id'];
          echo "<tr>";
            echo "<td>";
              echo $issue_name;
            echo "</td>";
            echo "<td>";
              echo "<a class='btn btn-primary' onclick=\"editIssue('$issue_id', '$issue_name')\" data-toggle='modal' data-target='#editIssueModal'>EDIT</a> ";
              echo "<a class='btn btn-primary' href='admin-dashboard.php?delete_issue=$issue_id'>DELETE</a> ";
            echo "</td>";
          echo "</tr>";
        }
      ?>
      <form method="POST">
        <tr>
        <center>
        <td colspan="2"><input type="text" class="form-control" name="add_issue" style="width: 100%" placeholder="ADD ISSUE" required></td>
        </center>       
      </tr>

      <tr>
        <center>
        <td colspan="2"><button class="btn btn-primary" style="width:100%">ADD</button></td>
          </center>
      </tr>
      </form>
    </tbody>
  </table>
 </div>




 </div>


</div>
<!--MODAL-->
<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> EDIT BARANGAY</h4>
      </div>
      <div class="modal-body"><center>
        <form class="form-inline" method="POST">
          <table>
            <tr>
              <td>BARANGAY NAME: </td>
              <td>
                <input type="text" class="form-control" name="barangay_update" id="barangay_name">
                <input type="hidden" name="barangay_id" id="barangay_id">
              </td>
            </tr>
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
<div id="editIssueModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> EDIT ISSUE</h4>
      </div>
      <div class="modal-body"><center>
        <form class="form-inline" method="POST">
          <table>
            <tr>
              <td>ISSUE NAME: </td>
              <td>
                <input type="text" class="form-control" name="issue_update" id="issue_name">
                <input type="hidden" name="issue_id" id="issue_id">
              </td>
            </tr>
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

<div id="settingsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span class="glyphicon glyphicon-pencil"></span> EDIT ISSUE</h4>
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
  <script>
    function checkPword(frm)
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
    function edit(id, name)
    {
      $("#barangay_name").val(name);
      $("#barangay_id").val(id);
    }
    function editIssue(id, name)
    {
      $("#issue_name").val(name);
      $("#issue_id").val(id);
    }
  </script>
</body>
</html>