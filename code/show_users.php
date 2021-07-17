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
</head>
<body>
<div align="center"><h1>User Records</h1> </div>
<div align="center">
<table border="2" style="width: 50% ">
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
                <a href="edit.php?editId=<?php echo $row['id'] ?>"">Edit</a>&nbsp;\
                <a href="show_users.php?del_record=<?php echo $row['id'] ?>">Delete</a>
            </td>
        </tr>
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
</table>
</div>
</body>
</html>