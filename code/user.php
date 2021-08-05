<?php
session_start();
include("actions.php");
$user = new Action();
$id = $_SESSION['id'];
if (!$user->session()){
    header("location:login.php");
}
if (isset($_REQUEST['logout'])){
    $user->logout();
    header("location:login.php");
}
$data = $user->fullname($id);
$response = $user->showProduct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <!--Jquery CDN-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<!--CSS-->
    <link rel="stylesheet" href="styles.css">
</head>

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
            <li class="nav-item">
            <a class="navbar-brand" href="#">Welcome,<?php echo $data['first_name']," ",$data['last_name']?></a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="product.php">Add Product</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="home.php">Show Product</a>
            </li>
        </ul>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link " href="?logout=logout">Logout</a>
            </li>
        </ul>
    </div>

</nav>
</br>
<!-- Form ajax -->
</br> 
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <h4>User shipping Address Records</h4>  
    </div>
    <div class="col-lg-6">
      <button type="button" class="btn btn-primary m-1 float-right" data-toggle="modal" data-target="#addModal">
      <i class="fa fa-plus"></i> Add New Shipping Address</button>
      
    </div>
  </div><br>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="table-responsive" id="tableData">
        <h3 class="text-center text-success" style="margin-top: 150px;">Loading...</h3>
      </div>
    </div>
  </div>
</div>

<!-- Add Record  Modal -->
<div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Shipping Address</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form id="formData">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required="">
          </div>
          <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" placeholder="Address" required="">
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" placeholder="City" required="">
          </div>
          <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" placeholder="Country" required="">
          </div>
          <hr>
          <div class="form-group float-right">
            <button type="submit" class="btn btn-success" id="submit">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>  
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Record  Modal -->
<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Shipping Address</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form id="EditformData">
          <input type="hidden" name="id" id="edit-form-id">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name" required=""  >
          </div>   
          <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="Address" required="">
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="City" required="">
          </div>
          <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" id="country" placeholder="Country" required="">
          </div>
          <hr>
          <div class="form-group float-right">
            <button type="submit" class="btn btn-primary" id="update">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>  
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript" src="./JS/ajax.js">
</script>
</body>
</html>
<script src="./JS/form-validation.js"></script>