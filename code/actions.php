<?php
include("helpers.php");
class Connection
{

    private $servername = "example_project_db";
    private $username = "root";
    private $password = "root";
    private $dbname = "example_project_local";

    protected function connect()
    {
        return new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );
    }

    protected function closeConnection($connection)
    {
        $connection->close();
    }
}


class Action extends Connection
{
    private function fileUpload($file)
    {
        $message = [];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["file"]["name"]);
        $imageFileType = strtolower(explode("/", $file["file"]["type"])[1]);

        $imageSize = $file["file"]["size"];
        if ($imageSize <= 2000000) {
            if ($imageFileType === "jpeg" || $imageFileType === "jpg" || $imageFileType === "png") {
                if (move_uploaded_file($file["file"]["tmp_name"], $target_file)) {
                    $message["message"] = "file successfully upload.";
                    $message["code"] = 200;
                    $message["file_path"] = $target_file;
                } else {
                    $message["message"] = "There is issue with to upload. try again.";
                    $message["code"] = 500;
                }
            }
        } else {
            $message["message"] = "Sorry, your file is too large.";
            $message["code"] = 500;
        }
        return $message;
    }

    public function fileUploadHistory(array $params, array $file)
    {
        $message = [];
        $response = $this->fileUpload($file);

        if (!empty($response) && $response["code"] === 200) {

            $sql = "INSERT INTO file_upload_log 
                (`name`,`file_path`)
                VALUES(
                '{$params["name"]}',
                '{$response["file_path"]}')";
            $message["message"] = $sql;
            $message["code"] = 200;
            return $message;
            //todo: add insert query to insert records;
        } else {
            return $response;
        }
    }
    public function insertRecords(array $params)
    {
        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }

        $sql = "INSERT INTO users 
                (`first_name`,`last_name`,`email`,`password`,`phone_number`)
                VALUES(
                '{$params["first_name"]}',
                '{$params["last_name"]}',
                '{$params["email"]}',
                '{$params["password"]}',
                '{$params["phone_number"]}')";

        if ($conn->query($sql) === True) {
            $response["message"] = "Wao! Record Inserted Successfully";
            $response["code"] = 200;
        } else {
            $response["message"] = $conn->error;
            $response["code"] = 500;
        }
        $this->closeConnection($conn);
        return $response;
    }

    public function showRecords()
    {
        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $this->closeConnection($conn);
            return $result;
        }

        return [];
    }
}
