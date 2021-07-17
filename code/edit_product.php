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
if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $customer = $user->showProductsById($editId);
}
if(isset($_POST['update'])) {
    $user->updateProducts($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
    <h1><h1>Welcome : <?php echo $data['id'];?></h1></h1>
    <p> <?php echo $data['first_name'],$data['last_name']?></p>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link " href="?logout=logout">Logout</a>
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
    </div>

</nav>
<div class="container" style="margin-top:30px">
</div>
<div class="container">
    <h2>Product Details</h2>
    <form action="" method="post">
        <input type="hidden" name="user_id" value="<?php echo $data['id']; ?>">
        <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" name="product_name" value="<?php echo $customer['product_name'];?>">
        </div>
        <div class="form-group">
            <label for="product_discription">Discription:</label>
            <input type="text" class="form-control" id="product_discription" placeholder="Enter Discription" name="product_discription" value="<?php echo $customer['product_discription'];?>">
        </div>
        <div class="form-group">
            <label for="product_price"> Product Price:</label>
            <input type="text" class="form-control" id="product_price" placeholder="Enter email" name="product_price" value="<?php echo $customer['product_price'];?>">
        </div>

        <div class="form-group">
            <label for="product_image">Product Image:</label>
            <input type="text" class="form-control" id="product_image" placeholder="Url" name="product_image" value="<?php echo $customer['product_image'];?>">
        </div>

        <button type="submit"  name="update" class="btn btn-primary">Submit</button>

    </form>
</div>

</body>
</html>
</div>

</body>
</html>