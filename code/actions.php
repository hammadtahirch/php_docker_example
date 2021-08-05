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

    // User Table Function

         // User insert Function
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

        // User Show Function
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

        // USer ShowById Function
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
                } else {
                    echo "Record not found";
                }
            }


            // User update function
               public function updateRecord($postData)
            {

                $response = [];
                $conn = $this->connect();
                if ($conn->connect_error) {
                    $response["message"] = $conn->connect_error;
                    $response["code"] = 500;
                    return $response;
                }
        //        print_r($postData);die();
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
                    if ($sql == true) {
                        header("Location:show_users.php");
                    } else {
                        echo "Registration updated failed try again!";
                    }
                }

            }

            // user delete function
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
                        $response["message"] = "Wao! Record Delete Successfully";
                        $response["code"] = 200;
                    } else {
                        $response["message"] = $conn->error;
                        $response["code"] = 500;
                    }
                    $this->closeConnection($conn);
                    return $result;

                }

                // User Login function

                public function login($email, $pass)
                {
                    $response = [];
                    $conn = $this->connect();
                    if ($conn->connect_error) {
                        $response["message"] = $conn->connect_error;
                        $response["code"] = 500;
                        return $response;
                    }
                    $sql = $conn->query("Select * from users where email='$email' and password='$pass'");
                    $data = mysqli_fetch_array($sql);
                    $result = mysqli_num_rows($sql);
                    if ($result == 1) {
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $data['id'];
                        $this->closeConnection($conn);
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

            // Product Table All Funtion

            // Product insert function
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
                        (`user_id`,`product_name`,`product_discription`,`product_price`,`product_image`)
                        VALUES(
                        '{$params["user_id"]}',
                        '{$params["product_name"]}',
                        '{$params["product_discription"]}',
                        '{$params["product_price"]}',
                        '{$params["product_image"]}')";

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

            // Product Show function

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

            // Product delete function
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

                // Product showById function

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


            // Product update function
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
 

    // shaping Table function

		public function insertRecond($name, $address, $city, $country)
		{

            $conn = $this->connect();
			$sql = "INSERT INTO shipping (name,address,city,country) VALUES('$name','$address','$city','$country')";
			$query =  $conn->query($sql);
            $this->closeConnection($conn);
			if ($query) {
				return true;
			}else{
				return false;
			}
		}

		// Fetch shaping records for show listing
		public function displayRecord()
		{
            $conn = $this->connect();
			$sql = "SELECT * FROM shipping";
			$query = $conn->query($sql);
            $this->closeConnection($conn);
			$data = array();
			if ($query->num_rows > 0) {
				while ($row = $query->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}else{
				return false;
			}
		}

		// Fetch single data for edit from customer table
		public function getRecordById($id)
		{
            $conn = $this->connect();
			$query = "SELECT * FROM shipping WHERE id = '$id'";
			$result = $conn->query($query);
            $this->closeConnection($conn);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row;
			}else{
				return false;
			}
		}


		public function totalRowCount(){
            $conn = $this->connect();
			$sql = "SELECT * FROM shipping";
			$query = $conn->query($sql);
			$rowCount = $query->num_rows;
            $this->closeConnection($conn);
			return $rowCount;
		}

        // Update Shaping 
		public function updateShaping($id,$name, $address, $city, $country)
		{
            $conn = $this->connect();
			$sql = "UPDATE shipping SET name = '$name', address = '$address', city = '$city', country = '$country' 
			WHERE id = '$id'";
			$query =  $conn->query($sql);
            $this->closeConnection($conn);
			if ($query) {
				return true;
			}else{
				return false;
			}
		}

        // Delete customer data from customer table
		public function deleteRecord($id)
		{
            $conn = $this->connect();
			$sql = "DELETE FROM shipping WHERE id = '$id'";
			$query = $conn->query($sql);
            $this->closeConnection($conn);
			if ($query) {
				return true;
			}else{
				return false;
			}
		}

	}
?>
