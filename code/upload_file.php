<?php
include('actions.php');

if (isset($_POST["submit"])) {

    $action = new Action();
    $response  = $action->fileUploadHistory(["name" => $_POST["file_name"]], $_FILES);
    if (!empty($response["code"]) && $response["code"] === 200) {
        print_r($response);
    } else {
        print_r($response);
    }
}
?>



<!DOCTYPE html>
<html>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="text" name="file_name" id="file_name" />
        <input type="file" name="file" id="file">
        <input type="submit" value="Upload Image" name="submit">
    </form>

</body>

</html>