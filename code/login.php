<?php
session_start();
include("actions.php");
include_once("validation.php");
$validation = new Validation();
$user = new Action();
if ($user->session())
{
    header("location:home.php");
}
$user = new Action();
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $login = $user->login($_REQUEST['email'],$_REQUEST['password']);
    if($login){
        header("location:home.php");
    }
    else
    {
        $msg2 = $validation->check_empty($_POST, array('email','password',));
        $check_email = $validation->leValid($_POST['email']);
        $check_password = $validation->lpValid($_POST['password']);

        if($msg2 != null) {
              $msg2;
        }
        elseif($check_email !=null) {
            $msg= 'Email is Required';
        }
        elseif ($check_password !=null) {
            $msg1= 'Password is Required';
        }
        else {
        echo "<script>alert('Please Enter You Vailed Email & Password')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>LogIn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-10px">
    <h2>Login Form</h2>
    <span class="error" style="color: red"><?php echo $msg2?></span>
    <form action=""  method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            <span class="error" style="color: red"><?php echo $msg?></span>
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            <span class="error" style="color: red"><?php echo $msg1?></span>
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember me

            </label>

        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <p>Login Form yet?<a href="Insert_records.php"> Register Here</a></p>
    </form>
</div>

</body>
</html>