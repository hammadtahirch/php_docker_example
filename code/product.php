<?php
session_start();
include("actions.php");
include_once("Validation.php");
$user = new Action();
$validation = new Validation();
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
    $msg = $validation->check_empty_form($_POST, array('Product Name :','Discription :','Product Price :','Product Image :'));
    $check_product_name= $validation->product_nameValid($_POST['product_name']);
    $check_product_discription = $validation->product_discriptionValid($_POST['product_discription']);
    $check_product_price = $validation->product_priceValid($_POST['product_price']);
    $check_product_image = $validation->product_imageValid($_POST['product_image']);


    if($msg != null) {
        $msg;
    }
    elseif (!$check_product_name) {
        $product_name_error= 'Alphabet Only A-z.';
    }
    elseif (!$check_product_discription) {
        $product_discription_error= 'Alphabet Only A-z.';
    }
    elseif (!$check_product_price) {
        $product_price_error = 'Invalid intger Number  .';
    }
    elseif (!$check_product_image) {
        $product_image_error = 'JPG , PNG less then 5MB';
    }
   else{
        $response =  $action->insertProduct($_POST);
        if($response["code"] === 200){
            header('location: home.php');
        }
    }

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
    <!--Jquery CDN-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

    <!--CSS-->
    <link rel="stylesheet" href="styles.css">
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
    <span class="error" style="color: red ; text-align: center"><?php echo $msg?></span>
    <form action="" method="post" id="product-form">
        <input type="hidden" name="user_id" value="<?php echo $data['id']; ?>">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" placeholder="Enter Product Name" name="product_name">
            <span class="error" style="color: red ; text-align: center"><?php echo $product_name_error?></span>
        </div>
        <div class="form-group">
            <label for="product_discription">Discription:</label>
            <input type="text" class="form-control" id="product_discription" placeholder="Enter Discription" name="product_discription">
            <span class="error" style="color: red ; text-align: center"><?php echo $product_discription_error?></span>
        </div>
        <div class="form-group">
            <label for="product_price"> Product Price:</label>
            <input type="text" class="form-control" id="product_price" placeholder="Enter price" name="product_price">
            <span class="error" style="color: red ; text-align: center"><?php echo $product_price_error?></span>
        </div>

        <div class="form-group">
            <label for="product_image">Product Image:</label>

            <input type="text" class="form-control" id="product_image" placeholder="Url" name="product_image">
            <span class="error" style="color: red ; text-align: center"><?php echo $product_image_error?></span>
        </div>

        <button type="submit"  name="submit" class="btn btn-primary">Submit</button>

    </form>
    <br/><br/><br/><br/><br/><br/>
</div>

</body>
</html>
</div>

</body>
</html>
<script src="form-validation.js"></script>