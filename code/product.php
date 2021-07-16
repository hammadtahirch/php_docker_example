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
if(isset($_POST["submit"])){
    unset($_POST["submit"]);
    $action = new Action();
    $response =  $action->insertProduct($_POST);
    if($response["code"] === 200){
        header('location: home.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>



<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="home.php">Show Product</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="?logout=logout">Logout</a>
            </li>
        </ul>
    </div>

</nav>
<div class="text-center" style="margin-bottom:0">
    <h4>Welcome :  <?php echo $data['first_name']," ",$data['last_name']?></h4>
</div>
<div class="container" style="margin-top:30px">
</div>
<div class="container">
    <form action="" method="post">
        <input type="hidden" name="user_id" value="<?php echo $data['id']; ?>">
    <div class="form-group row">
        <label class="col-sm-1 col-form-label"></label>
        <div class="col-sm-3">
        <h3>Please Insert Product Detail</h3>
        </div>
    </div>
    </br>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Product Name:</label>
        <div class="col-sm-3">
        <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" name="product_name">
        </div>
    </div>
    <br/>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Product Discription:</label>
        <div class="col-sm-3">
        <input type="text" class="form-control" id="product_discription" placeholder="Enter Discription" name="product_discription">
        </div>
    </div>
    <br/>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Product Price:</label>
        <div class="col-sm-3">
        <input type="text" class="form-control" id="product_price" placeholder="Enter Price" name="product_price">
        </div>
    </div>
    <br/>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Product Image:</label>
        <div class="col-sm-3">
        <input type="url" class="form-control" id="product_image" placeholder="Product Image Url" name="product_image">
        </div>
    </div>
    <br/>
        <button type="submit"  name="submit" class="btn btn-primary">Submit</button>

    </form>
</div>
</div>
</body>
</html>