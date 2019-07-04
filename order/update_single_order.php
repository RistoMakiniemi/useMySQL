<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Order Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch customer numbers 
$sql 	= "SELECT customerNumber, customerName FROM customers";
$result = $conn->query($sql);
$customers = array();
while($row = $result->fetch_array()) {
	$customers[$row['customerNumber']] = $row['customerNumber'] . " - " . $row['customerName'];
}

closeconnection($conn);
/**
 * Escapes HTML for output
 */
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if (isset($_POST['submit'])) {

    $conn = openconnection();

    $orderNumber = $_POST['orderNumber'];
    $orderDate = $_POST['orderDate'];
    $requiredDate = $_POST['requiredDate'];
    $shippedDate = $_POST['shippedDate'];
    $status = $_POST['status'];
    $comments = $_POST['comments'];
    $customerNumber = $_POST['customerNumber'];

    $sql = "UPDATE orders
            SET orderDate = '$orderDate',
            requiredDate = '$requiredDate',
            shippedDate = '$shippedDate',
            status = '$status',
            comments = '$comments',
            customerNumber = '$customerNumber' WHERE orderNumber = '$orderNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
        
    closeconnection($conn);
}

if (isset($_GET['orderNumber'])) {
    $conn = openconnection();

    $orderNumber = $_GET['orderNumber'];
    // Some Query
    $sql 	= "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, 
        comments, customerNumber
        FROM orders WHERE orderNumber = '$orderNumber'";

    $result = $conn->query($sql);
    $order = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $order) : ?>
  <?php echo escape($_POST['orderNumber']); ?> successfully updated.
<?php endif; ?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_order.php">Back to Update Orders</a>
<br>
<br>
<h2>Edit a order</h2>

<form method="post">
    <?php foreach ($order as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <?php if ($key == "customerNumber") { ?>
            <select name="customerNumber">
                <option selected hidden>Choose one</option>
                <?php
                // Loop through customer array
                foreach($customers as $key1 => $value1) {
                ?>
                    <!-- Set customer number item "selected" -->
                    <option <?php echo ($value == $key1) ? 'selected="selected"' : ""; ?> value="<?php echo $key1;?>"><?php echo escape($value1); ?></option>
                <?php
                }
                ?> 
            </select>
        <?php } elseif ($key == "orderDate" || $key == "requiredDate" || $key == "shippedDate") {?>
            <input type="date" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php } elseif ($key == "comments") {?>
            <textarea rows="10" cols="80" name="<?php echo $key; ?>" id="<?php echo $key; ?>"><?php echo escape($value); ?></textarea>
        <?php } elseif ($key == "status") {?>
            <select  name="status">
			<option selected="selected">Choose one</option>
			<option <?php echo ($value == "Shipped") ? 'selected="selected"' : ""; ?>>Shipped</option>
			<option <?php echo ($value == "Resolved") ? 'selected="selected"' : ""; ?>>Resolved</option>
			<option <?php echo ($value == "Cancelled") ? 'selected="selected"' : ""; ?>>Cancelled</option>
			<option <?php echo ($value == "On Hold") ? 'selected="selected"' : ""; ?>>On Hold</option>
			<option <?php echo ($value == "Disputed") ? 'selected="selected"' : ""; ?>>Disputed</option>
			<option <?php echo ($value == "In Process") ? 'selected="selected"' : ""; ?>>In Process</option>
		    </select>
        <?php } else { ?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php } ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_order.php">Back to Update Orders</a>

</body>
</html>