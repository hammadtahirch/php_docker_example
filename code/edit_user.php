<?php
include("actions.php");
$action = new Action();
if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $data = $action->showRecordsById($editId);
}

if(isset($_POST['update'])) {
    $action->updateRecord($_POST);
}
?>


<html>
<head>
    <title>Update Records</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<form action="" method="post">
<div class="container">
<div class="form-group row">
    <label class="col-sm-1 col-form-label"></label>
    <div class="col-sm-3">
    <h3>Update Records</h3>
    </div>
</br>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">First Name<:</label>
    <div class="col-sm-3">
    <input type="text" name="first_name" id="first_name" value="<?php echo $data['first_name'];?>">
    </div>
  </div>
    <br/>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Last Name:</label>
    <div class="col-sm-3">
    <input type="text" name="last_name" id="last_name" value="<?php echo $data['last_name']; ?>">
    </div>
  </div>
    <br/>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Email Address:</label>
    <div class="col-sm-3">
    <input type="text" name="email" id="email" value="<?php echo $data['email']; ?>">
    </div>
  </div>
    <br/>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Password:</label>
    <div class="col-sm-3">
    <input type="text" name="password" id="password" value="<?php echo $data['password']; ?>">
    </div>
  </div>
    <br/>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">Phone Number:</label>
    <div class="col-sm-3">
    <input type="text" name="phone_number" id="phone_number" value="<?php echo $data['phone_number']; ?>">
    </div>
  </div>

    <br/>
    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
    <button type="submit" class="btn btn-primary" name="update">Update Records</button>
    </div>
</form>
</body>
</html>