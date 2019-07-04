<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Orderdetails Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();

if (isset($_POST['submit'])) {

    $orderNumber = $_POST['orderNumber'];
    $productCode = $_POST['productCode'];

    // Some Query
    $sql 	= "SELECT orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber 
        FROM orderdetails WHERE orderNumber LIKE '$orderNumber' AND productCode LIKE '$productCode'";

    $result = $conn->query($sql);
}

closeconnection($conn);
?>

        
<?php

/**
* Escapes HTML for output
*/
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

if (isset($_POST['submit'])) {
    if ($result && $result->num_rows > 0) { ?>
        <h2>Results</h2>

        <table>
            <thead>
                <tr>
                    <th>orderNumber</th>
                    <th>productCode</th>
                    <th>quantityOrdered</th>
                    <th>priceEach</th>
                    <th>orderLineNumber</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["orderNumber"]); ?></td>
				<td><?php echo escape($row["productCode"]); ?></td>
				<td><?php echo escape($row["quantityOrdered"]); ?></td>
				<td><?php echo escape($row["priceEach"]); ?></td>
				<td><?php echo escape($row["orderLineNumber"]); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['orderNumber']); ?> and <?php echo escape($_POST['productCode']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../orderdetails.php">Back to Orderdetails</a>
<br>
<br>
<h2>Find orderdetails based on ordernumber and productcode</h2>

<form method="post">
    <p>
    <label for="city">orderNumber</label>
    <input type="text" id="orderNumber" name="orderNumber">
    <label for="city">productCode</label>
    <input type="text" id="productCode" name="productCode">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>
<br>

<a href="../orderdetails.php">Back to Orderdetails</a>

</body>
</html>