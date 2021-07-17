<?php
include("actions.php");
$action = new Action();
if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $customer = $action->showRecordsById($editId);
}

if(isset($_POST['update'])) {
    $action->updateRecord($_POST);
}
?>


<html>
<head>
    <title>Insert Records</title>
</head>
<body>
<form action="" method="post">
    <label>First Name</label>
    <input type="text" name="first_name" id="first_name" value="<?php echo $customer['first_name'];?>">
    <br/>
    <label>Last Name</label>
    <input type="text" name="last_name" id="last_name" value="<?php echo $customer['last_name']; ?>">
    <br/>
    <label>Email Address</label>
    <input type="text" name="email" id="email" value="<?php echo $customer['email']; ?>">
    <br/>
    <label>Password</label>
    <input type="text" name="password" id="password" value="<?php echo $customer['password']; ?>">
    <br/>
    <label>Phone Number</label>
    <input type="text" name="phone_number" id="phone_number" value="<?php echo $customer['phone_number']; ?>">
    <br/>
    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
    <button type="submit" name="update">update Records</button>

</form>
</body>
</html>