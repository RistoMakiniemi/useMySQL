<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Customer Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch employeenumbers 
$sql 	= "SELECT employeeNumber, lastName, firstName FROM employees";
$result = $conn->query($sql);
$employees = array();
while($row = $result->fetch_array()) {
	$employees[$row['employeeNumber']] = $row['employeeNumber'] . " - " . $row['lastName'] . " - " . $row['firstName'];
}

/**
 * Escapes HTML for output
 */
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if (isset($_POST['submit'])) {

    $customerNumber         = $_POST['customerNumber'];
    $customerName           = $_POST['customerName'];
    $contactLastName        = $_POST['contactLastName'];
    $contactFirstName       = $_POST['contactFirstName'];
    $phone                  = $_POST['phone'];
    $addressLine1           = $_POST['addressLine1'];
    $addressLine2           = $_POST['addressLine2'];
    $city                   = $_POST['city'];
    $state                  = $_POST['state'];
    $postalCode             = $_POST['postalCode'];
    $country                = $_POST['country'];
    $salesRepEmployeeNumber = $_POST['salesRepEmployeeNumber'];
    $creditLimit            = $_POST['creditLimit'];
    
    $sql = "UPDATE customers
            SET customerNumber = '$customerNumber',
            customerName = '$customerName',
            contactLastName = '$contactLastName',
            contactLastName = '$contactFirstName',
            phone = '$phone',
            addressLine1 = '$addressLine1',
            addressLine1 = '$addressLine1',
            city = '$city',
            state = '$state',
            postalCode = '$postalCode',
            country = '$country',
            salesRepEmployeeNumber = '$salesRepEmployeeNumber',
            creditLimit = '$creditLimit'
            WHERE customerNumber = '$customerNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    
    closeconnection($conn);
}

if (isset($_GET['customerNumber'])) {
    $conn = openconnection();

    //echo $_GET['officeCode']; 
    $customerNumber = $_GET['customerNumber'];
    // Some Query
    $sql 	= "SELECT customerNumber, customerName, contactLastName, 
        contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, 
        country, salesRepEmployeeNumber, creditLimit 
        FROM customers WHERE customerNumber = '$customerNumber'";

    $result = $conn->query($sql);
    $customer = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php if (isset($_POST['submit']) && $customer) : ?>
  <?php echo escape($_POST['customerName']); ?> successfully updated.
<?php endif; ?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_customer.php">Back to Update Customer</a>
<br>
<br>
<h2>Edit a customer</h2>

<form method="post">
    <?php foreach ($customer as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <?php if ($key == "salesRepEmployeeNumber") { ?>
            <select name="salesRepEmployeeNumber">
                <option selected hidden>Choose one</option>
                <?php
                // Loop through office array
                foreach($employees as $key1 => $value1) {
                ?>
                    <!-- Set salesRepEmployeeNumber item "selected" -->
                    <option <?php echo ($value == $key1) ? 'selected="selected"' : ""; ?> value="<?php echo $key1;?>"><?php echo $value1; ?></option>
                <?php
                }
                ?> 
            </select>
        <?php } else {?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php } ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_customer.php">Back to Update Customer</a>

</body>
</html>