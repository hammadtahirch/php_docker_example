<?php
    include("actions.php");

	$dbObj = new Action();

	// Insert Record	
	if (isset($_POST['action']) && $_POST['action'] == "insert") {

		$name = $_POST['name'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$dbObj->insertRecond($name, $address, $city, $country);
	}

	// View record
	if (isset($_POST['action']) && $_POST['action'] == "view") {
		$output = "";

		$customers = $dbObj->displayRecord();

		if ($dbObj->totalRowCount() > 0) {
			$output .="<table class='table table-striped table-hover'>
			        <thead>
			          <tr>
			            <th>Id</th>
			            <th>Name</th>
			            <th>Address</th>
			            <th>City</th>
			            <th>Country</th>
			            <th>Action</th>
			          </tr>
			        </thead>
			        <tbody>";
			foreach ($customers as $customer) {
			$output.="<tr>
			            <td>".$customer['id']."</td>
			            <td>".$customer['name']."</td>
			            <td>".$customer['address']."</td>
			            <td>".$customer['city']."</td>
			            <td>".$customer['country']."</td>
			            <td>
			              <a href='#editModal' style='color:green' data-toggle='modal' 
			              class='editBtn' id='".$customer['id']."'><i class='fa fa-pencil'></i></a>&nbsp;
			              <a href='' style='color:red' class='deleteBtn' id='".$customer['id']."'>
			              <i class='fa fa-trash' ></i></a>
			            </td>
			        </tr>";
				}
			$output .= "</tbody>
      		</table>";
      		echo $output;	
		}else{
			echo '<h3 class="text-center mt-5">No records found</h3>';
		}
	}

	// getRecordById function
	if (isset($_POST['editId'])) {
		$editId = $_POST['editId'];
		$row = $dbObj->getRecordById($editId);
		echo json_encode($row);
	}

  // Update Record
	if (isset($_POST['action']) && $_POST['action'] == "update") {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$country = $_POST['country'];
		$dbObj->updateShaping($id, $name, $address, $city, $country);
	}


	// Delete Record	
	if (isset($_POST['deleteBtn'])) {
		$deleteBtn = $_POST['deleteBtn'];
		$dbObj->deleteRecord($deleteBtn);
	}


?>