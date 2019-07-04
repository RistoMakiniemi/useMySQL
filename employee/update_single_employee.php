<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update employee Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

$self = "";

// Fetch officecodes 
$sql 	= "SELECT officeCode, city FROM offices";
$result = $conn->query($sql);
$offices = array();
while($row = $result->fetch_array()) {
	$offices[$row['officeCode']] = $row['officeCode'] . " - " . $row['city'];
}

// Fetch employeenumbers 
$sql 	= "SELECT employeeNumber, lastName, firstName FROM employees";
$result = $conn->query($sql);
$sel_employees = array();
while($row = $result->fetch_array()) {
	$sel_employees[$row['employeeNumber']] = $row['employeeNumber'] . " - " . $row['lastName'] . " - " . $row['firstName'];
}

/**
 * Escapes HTML for output
 */
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if (isset($_POST['submit'])) {

    $employeeNumber = $_POST['employeeNumber'];
    $lastName = $_POST['lastName'];
    $firstName = $_POST['firstName'];
    $extension = $_POST['extension'];
    $email     = $_POST['email'];
    $officeCode  = $_POST['officeCode'];
    //$reportsTo  = $_POST['reportsTo'];
    $reportsTo = $_POST['SelectReportsTo'];
    $jobTitle  = $_POST['jobTitle'];

    $sql = "UPDATE employees
            SET employeeNumber = '$employeeNumber',
            lastName = '$lastName',
            firstName = '$firstName',
            extension = '$extension',
            email = '$email',
            officeCode = '$officeCode',
            reportsTo = '$reportsTo',
            jobTitle = '$jobTitle'
            WHERE employeeNumber = '$employeeNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
        
    closeconnection($conn);
}

if (isset($_GET['employeeNumber'])) {
    $conn = openconnection();

    $employeeNumber = $_GET['employeeNumber'];
    // Some Query
    $sql 	= "SELECT employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle 
        FROM employees WHERE employeeNumber = '$employeeNumber'";

    $result = $conn->query($sql);
    $employee = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
     exit;
}

?>

<?php if (isset($_POST['submit']) && $employee) : ?>
  <?php echo escape($_POST['firstName']); echo " "; echo escape($_POST['lastName']); ?> successfully updated.
<?php endif; ?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_employee.php">Back to Update Employees</a>
<br>
<br>
<h2>Edit a employee</h2>

<form method="post">
    <?php foreach ($employee as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <?php if ($key == "officeCode") { ?>
            <select name="officeCode">
                <option selected hidden>Choose one</option>
                <?php
                // Loop through office array
                foreach($offices as $key1 => $value1) {
                ?>
                    <!-- Set officecode item "selected" -->
                    <option <?php echo ($value == $key1) ? 'selected="selected"' : ""; ?> value="<?php echo $key1;?>"><?php echo $value1; ?></option>
                <?php
                }
                ?> 
            </select>
        <?php } elseif ($key == "reportsTo") {?>
            <select  name="SelectReportsTo">
				<option selected hidden>Choose one</option>
				<?php
				// Loop through employee array
				foreach($sel_employees as $key2 => $value2) {
                    // Find employee self and remove form drop-down list
                    if ($self != $key2) {
				?>
                    <!-- Set reportsTo item "selected" -->
					<option <?php echo ($value == $key2) ? 'selected="selected"' : ""; ?> value="<?php echo $key2;?>"><?php echo $value2; ?></option>
				<?php
                    }
                }
				?>
			</select>
        <?php } else { ?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
            <?php if ($key == "employeeNumber") { 
                // Find employee self and remove form drop-down list
                $self = $value;
            } ?>
        <?php } ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_employee.php">Back to Update Employees</a>

</body>
</html>