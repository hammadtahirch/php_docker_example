<?php
include ("helpers.php");
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
        if($result->num_rows >0){
            $this->closeConnection($conn);
            return $result;
        }

        return [];

    }

}

?>
