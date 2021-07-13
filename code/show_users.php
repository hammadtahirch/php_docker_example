<?php
include("actions.php");
$action = new Action();
$response = $action->showRecords(); ?>
<html>
<head>
    <title>Show Records</title>
</head>
<body>
<table>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
    </tr>
    <?php
    while ($row = $response->fetch_assoc()) {?>

        <tr>
            <td><?=$row["id"]?></td>
            <td><?=$row["first_name"]?></td>
            <td><?=$row["last_name"]?></td>
            <td><?=$row["email"]?></td>
            <td><?=$row["phone_number"]?></td>
        </tr>
    <?php
    }
    ?>
</table>
</body>
</html>