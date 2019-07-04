<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Orderdetail Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$conn = openconnection();

// Fetch orders 
$sql 	= "SELECT orderNumber FROM orders";
$result = $conn->query($sql);
$orders = array();
while($row = $result->fetch_array()) {
	$orders[$row['orderNumber']] = $row['orderNumber'];
}

// Fetch products 
$sql 	= "SELECT productCode, productName FROM products";
$result = $conn->query($sql);
$products = array();
while($row = $result->fetch_array()) {
	$products[$row['productCode']] = $row['productCode'] . " - " . $row['productName'];
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
	$productCode = $_POST['productCode'];
	$quantityOrdered = $_POST['quantityOrdered'];
	$priceEach     = $_POST['priceEach'];
	$orderLineNumber  = $_POST['orderLineNumber'];

    $sql = "UPDATE orderdetails
            SET orderNumber = '$orderNumber',
            productCode = '$productCode',
            quantityOrdered = '$quantityOrdered',
            priceEach = '$priceEach',
            orderLineNumber = '$orderLineNumber' WHERE orderNumber = '$orderNumber' AND productCode = '$productCode'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
        
    closeconnection($conn);
}

if (isset($_GET['orderNumber']) && isset($_GET['productCode'])) {
    $conn = openconnection();

    $orderNumber = $_GET['orderNumber'];
    $productCode = $_GET['productCode'];

    // Some Query
    $sql 	= "SELECT orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber
        FROM orderdetails WHERE orderNumber = '$orderNumber' AND productCode = '$productCode'";

    $result = $conn->query($sql);
    $orderdetail = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $orderdetail) : ?>
  <?php echo escape($_POST['orderNumber']); ?> and <?php echo escape($_POST['productCode']); ?> successfully updated.
<?php endif; ?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_orderdetail.php">Back to Update Orderdetails</a>
<br>
<br>
<h2>Edit a orderdetail</h2>

<form method="post">
    <?php foreach ($orderdetail as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <?php if ($key == "orderNumber") { ?>
            <select name="orderNumber">
                <option selected hidden>Choose one</option>
                <?php
                // Loop through orders array
                foreach($orders as $key1 => $value1) {
                ?>
                    <!-- Set orders number item "selected" -->
                    <option <?php echo ($value == $key1) ? 'selected="selected"' : ""; ?> value="<?php echo $key1;?>"><?php echo escape($value1); ?></option>
                <?php
                }
                ?> 
            </select>
        <?php } elseif ($key == "productCode") {?>
            <select name="productCode">
                <option selected hidden>Choose one</option>
                <?php
                // Loop through products array
                foreach($products as $key1 => $value1) {
                ?>
                    <!-- Set product number item "selected" -->
                    <option <?php echo ($value == $key1) ? 'selected="selected"' : ""; ?> value="<?php echo $key1;?>"><?php echo escape($value1); ?></option>
                <?php
                }
                ?> 
            </select>
        <?php } else { ?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php } ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_orderdetail.php">Back to Update Orderdetails</a>

</body>
</html>