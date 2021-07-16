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


     public function deleteRecords($id)
     {
         $response = [];
         $conn = $this->connect();
         if ($conn->connect_error) {
             $response["message"] = $conn->connect_error;
             $response["code"] = 500;
             return $response;
         }
         $sql = "DELETE FROM users WHERE id=" . $id;
         $result = $conn->query($sql);
         if ($result === True) {
            header('location: show_users.php');

        } else {
            
        }
         return $result;

     }

     public function showRecordsById($id)
    {

        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }

        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn->query($query);
        $this->closeConnection($conn);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }else{
            echo "Record not found";
        }
    }



    public function updateRecord($postData)
    {

        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }

        $first_name = $conn->real_escape_string($_POST['first_name']);
        $last_name = $conn->real_escape_string($_POST['last_name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);
        $phone_number = $conn->real_escape_string($_POST['phone_number']);
        $id = $conn->real_escape_string($_POST['id']);
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name',email = '$email', password = '$password', phone_number = '$phone_number' WHERE id = '$id'";
            $sql = $conn->query($query);
            $this->closeConnection($conn);
            if ($sql==true) {
                header("Location:show_users.php");
            }else{
                echo "Registration updated failed try again!";
            }
        }

    }
    public function login($email, $pass)  
        {
            $response = [];
            $conn = $this->connect();
            if ($conn->connect_error) {
                $response["message"] = $conn->connect_error;
                $response["code"] = 500;
                return $response;
            }
         
            $sql = "select * from users where email='$email' and password='$pass'";
            $result = $conn->query($sql);
            $data = mysqli_fetch_array($result);  
            $check = mysqli_num_rows($result);  
            if ($check == 1) {  
                $_SESSION['login'] = true;  
                $_SESSION['id'] = $data['id'];  
                return true;  
                } else {  
                    return false;  
            }  
    }  


    public function fullname($id)
    {
        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }
        $query = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn->query($query);
        $this->closeConnection($conn);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "Record not found";
        }

    }

    public function session()
    {
        if (isset($_SESSION['login'])) {
            return $_SESSION['login'];
        }
    }

    public function logout()
    {
        $_SESSION['login'] = false;
        session_destroy();
    }

    public function insertProduct(array $params)
    {
        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }

        $sql = "INSERT INTO products 
                (user_id,`product_name`,`product_discription`,`product_price`,`product_image`)
                VALUES(
                '{$params["user_id"]}',
                '{$params["product_name"]}',
                '{$params["product_discription"]}',
                '{$params["product_price"]}',
                '{$params["product_image"]}')";

        if ($conn->query($sql) === True) {
            $response["message"] = "Wao! Product Inserted Successfully";
            $response["code"] = 200;
        } else {
            $response["message"] = $conn->error;
            $response["code"] = 500;
        }
        $this->closeConnection($conn);
        return $response;

    }

    public function showProduct()
    {
        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $this->closeConnection($conn);
            return $result;
        }
        return [];
    }
    public function deleteProducts($id)
     {
         $response = [];
         $conn = $this->connect();
         if ($conn->connect_error) {
             $response["message"] = $conn->connect_error;
             $response["code"] = 500;
             return $response;
         }
         $sql = "DELETE FROM products WHERE id=" . $id;
         $result = $conn->query($sql);
         if ($result === True) {
            header('location: home.php');

        } else {
            
        }
         return $result;

     }

     public function showProductsById($id)
    {

        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }

        $query = "SELECT * FROM products WHERE id = '$id'";
        $result = $conn->query($query);
        $this->closeConnection($conn);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }else{
            echo "Record not found";
        }
    }



    public function updateProducts($postData)
    {

        $response = [];
        $conn = $this->connect();
        if ($conn->connect_error) {
            $response["message"] = $conn->connect_error;
            $response["code"] = 500;
            return $response;
        }
        $id = $conn->real_escape_string($_POST['id']);
        $user_id = $conn->real_escape_string($_POST['user_id']);
        $product_name = $conn->real_escape_string($_POST['product_name']);
        $product_discription = $conn->real_escape_string($_POST['product_discription']);
        $product_price = $conn->real_escape_string($_POST['product_price']);
        $product_image = $conn->real_escape_string($_POST['product_image']);
       
        if (!empty($id) && !empty($postData)) {
            $query = "UPDATE products SET product_name = '$product_name',product_discription = '$product_discription',product_price = '$product_price', product_image = '$product_image' WHERE id = '$id'";
            $sql = $conn->query($query);
            $this->closeConnection($conn);
            if ($sql==true) {
                header("location:home.php");
            }else{
                echo "Data updated failed try again!";
            }
        }

    }

}
