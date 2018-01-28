<?php
  session_start();
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
      <li class="active"><a href="login.php"  data-target="#settingsModal">LOG-OUT</a></li>
    </ul>
  
    <ul class="nav navbar-nav" style="float: right;">
      <li class="active"><a href="#" data-toggle="modal" data-target="#settingsModal">CHANGE PASSWORD</a></li>
    </ul>

  
  

  </div>
</nav>
<div class="container">
  <h2><b>STATISTICS</b></h2>
  <p><i>The shown values pertains to the number of defiencies for subject matter within the selected area.</i></p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>SUBJECT MATTER</th>
        <th>RESULT</th>
        <th>%</th>
        <th>STATUS</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>ILLITIRACY</td>
        <td>14/243</td>
        <td>5.76%</td>
        <td>PASS</td>
        <td><button type="button" class="btn btn-warning">UPDATE</button></td>
      </tr>
      <tr>
        <td>COMPUTER ILLITIRACY</td>
        <td>08/243</td>
        <td>3.29%</td>
        <td>PASS</td>
        <td><button type="button" class="btn btn-warning">UPDATE</button></td>
      </tr>
      <tr>
        <td>HEALTH ISSUE</td>
        <td>36/243</td>
        <td>14.81%</td>
        <td>PASS</td>
        <td><button type="button" class="btn btn-warning">UPDATE</button></td>
      </tr>
      <tr>
        <td><button type="button" class="btn btn-success">ADD</button></td>
        <td></td>
        <td></td>
      </tr>
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




</body>
</html>
