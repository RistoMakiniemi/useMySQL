<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Payment Form</title>
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

/**
 * Escapes HTML for output
 */
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if (isset($_POST['submit'])) {

    $customerNumber = $_POST['customerNumber'];
    $checkNumber = $_POST['checkNumber'];
    $paymentDate = $_POST['paymentDate'];
    $amount = $_POST['amount'];

    $sql = "UPDATE payments
            SET customerNumber = '$customerNumber',
            checkNumber = '$checkNumber',
            paymentDate = '$paymentDate',
            amount = '$amount'
            WHERE customerNumber = '$customerNumber' AND checkNumber = '$checkNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
        
    closeconnection($conn);
}

if (isset($_GET['customerNumber']) && isset($_GET['checkNumber'])) {
    $conn = openconnection();

    $customerNumber = $_GET['customerNumber'];
    $checkNumber = $_GET['checkNumber'];

    // Some Query
    $sql 	= "SELECT customerNumber, checkNumber, paymentDate, amount 
        FROM payments WHERE customerNumber = '$customerNumber' AND checkNumber = '$checkNumber'";

    $result = $conn->query($sql);
    $payment = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $payment) : ?>
  <?php echo escape($_POST['customerNumber']); ?> and <?php echo escape($_POST['checkNumber']); ?> successfully updated.
<?php endif; ?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_payment.php">Back to Update Payments</a>
<br>
<br>
<h2>Edit a payment</h2>

<form method="post">
    <?php foreach ($payment as $key => $value) : ?>
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
        <?php } elseif ($key == "paymentDate") {?>
            <input type="date" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php } else { ?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php } ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_payment.php">Back to Update Payments</a>

</body>
</html>