<?php
include("actions.php");
$action = new Action();
$response = $action->showRecords();

if (isset($_GET['del_record'])) {
    $id = $_GET['del_record'];
    $action = new Action();
    $action->deleteRecords($id);

}
?>
<html>
<head>
    <title>Show Records</title>
    <style>
table, th, td {
  border: 1px solid black;
  width: 50%;
}

table.center {
  margin-left: auto; 
  margin-right: auto;
}
h1 {
  text-align: center;
}
</style>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    
<table class="center">
<h1>User Records</h1>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Action</th>
    </tr>
    <?php
    if($response->num_rows >0){
    while ($row = $response->fetch_assoc()) {?>

        <tr>
            <td ><?=$row["id"]?></td>
            <td><?=$row["first_name"]?></td>
            <td><?=$row["last_name"]?></td>
            <td><?=$row["email"]?></td>
            <td><?=$row["phone_number"]?></td>
            <td class="delete">
                <a href="edit_user.php?editId=<?php echo $row['id'] ?>">Edit</a>&nbsp;\
                <a href="show_users.php?del_record=<?php echo $row['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php
    }
    }
    else{
        ?>
        <tr>
            <td colspan="6"> Record Not Found</td>

        </tr>
            <?php
        }
    ?>
</table>
</body>
</html>