<?php
include("actions.php");
include_once("validation.php");
$firsterror = "";
$lasterror = "";
$emailerror = "";
$passworderror = "";
$phoneerror = "";
$validation = new Validation();
if(isset($_POST["submit"])){
    unset($_POST["submit"]);
    $action = new Action();
    $msg = $validation->check_empty($_POST, array('first_name','last_name','email','password','phone_number'));
    $check_first = $validation->firstValid($_POST['first_name']);
    $check_last = $validation->lastValid($_POST['last_name']);
    $check_phone_num = $validation->phoneValid($_POST['phone_number']);
    $check_email = $validation->emailValid($_POST['email']);
    $check_password = $validation->passwordValid($_POST['password']);

    if($msg != null) {
       $msg;
    }
    elseif (!$check_first) {
        $firsterror= 'Alphabet Only A-z.';
    }
    elseif (!$check_last) {
        $lasterror= 'Alphabet Only A-z.';
    }
    elseif (!$check_phone_num) {
        $phoneerror = 'Invalid Phone Number  .';
    }
    elseif (!$check_email) {
        $emailerror = 'InValid Email';
    }
    elseif (!$check_password) {
        $passworderror = 'Invalid Password only interger Password.';
    }
    else {
        $result = $action->insertRecords($_POST);
        if($result["code"] === 200){
            header('location: login.php');
        }
    }
//   $response =  $action->insertRecords($_POST);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Registration</title>
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

<div class="container">
    <h2>User Registeration Form</h2>
    <span class="error" style="color: red ; text-align: center"><?php echo $msg?></span>
    <form action="" method="post" id="basic-form">
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name">
            <span class="error" style="color: red"><?php echo $firsterror?></span>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name">
            <span class="error" style="color: red"><?php echo $lasterror?></span>
        </div>
        <div class="form-group">
            <label for="email"> Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter Valid Email" name="email">
            <span class="error" style="color: red"><?php echo $emailerror?></span>
        </div>
        <div class="form-group">
            <label for="password"> Password:</label>
            <input type="password" class="form-control" id="password" placeholder="*********" name="password">
            <span class="error"style="color: red" ><?php echo $passworderror?></span>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" class="form-control" maxlength="11" id="phone_number" placeholder="03*********" name="phone_number">
            <span class="error" style="color: red"><?php echo $phoneerror?></span>
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember me

            </label>

        </div>
        <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
        <p>Login Form yet?<a href="login.php"> Login</a></p>
    </form>
</div>

</body>
</html>
<!-- <script src="form-validation.js"></script> -->

