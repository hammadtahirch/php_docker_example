<?php
include("actions.php");
if(isset($_POST["submit"])){
    unset($_POST["submit"]);
    $action = new Action();
   $response =  $action->insertRecords($_POST);
   if($response["code"] === 200){
       //header("Location: ".baseUrl('index.php'));
       echo "<script type=\"text/javascript\">
       window.location.href = '".baseUrl('show_users.php')."';
        </script>";
   }
}
?>


<html>
<head>
    <title>Insert Records</title>
</head>
<body>
<form action="" method="post">
    <label>First Name</label>
    <input type="text" name="first_name" id="first_name">
    <br/>
    <label>Last Name</label>
    <input type="text" name="last_name" id="last_name">
    <br/>
    <label>Email Address</label>
    <input type="text" name="email" id="email">
    <br/>
    <label>Password</label>
    <input type="password" name="password" id="password">
    <br/>
    <label>Phone Number</label>
    <input type="text" name="phone_number" id="phone_number">
    <br/>
    <button type="submit" name="submit">Add Records</button>
</form>
</body>
</html>