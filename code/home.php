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
if (isset($_GET['del_record'])) {
    $id = $_GET['del_record'];
    $action = new Action();
    $action->deleteProducts($id);

}
$data = $user->fullname($id);
$response = $user->showProduct();
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
        </ul><ul class="navbar-nav">
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
    <h2>Product </h2>
    <p>Deatils</p>
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Product Name</th>
            <th>Discription</th>
             <th>Price</th>
            <th>Product Image</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if($response->num_rows >0){
            while ($row = $response->fetch_assoc()) {?>

                <?php if($data['id'] === $row["user_id"] ){?>
        <tr>
            <td><?=$row["id"]?></td>
            <td><?=$row["user_id"]?></td>
            <td><?=$row["product_name"]?>.com</td>
            <td><?=$row["product_discription"]?></td>
            <td><?=$row["product_price"]?></td>
            <td >
                <img   src=" <?=$row["product_image"]?>" alt="<?=$row["product_image"]?>" width="50" height="60">
               </td>
            <td class="delete">
                <a href="edit_product.php?editId=<?php echo $row['id'] ?>"">Edit</a>&nbsp;\
                <a href="home.php?del_record=<?php echo $row['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php
        }

                ?>
                <?php
            }
        }else{
        ?>
        <tr>
            <td colspan="6"> Record Not Found</td>
        </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>
</div>

</body>
</html>