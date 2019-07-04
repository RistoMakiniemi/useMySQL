<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Order Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();

if (isset($_POST['submit'])) {

    $orderNumber = $_POST['orderNumber'];

    // Some Query
    $sql 	= "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, 
        comments, customerNumber 
        FROM orders WHERE orderNumber LIKE '$orderNumber'";

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
                    <th>orderDate</th>
                    <th>requiredDate</th>
                    <th>shippedDate</th>
                    <th>status</th>
                    <th>comments</th>
                    <th>customerNumber</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["orderNumber"]); ?></td>
                <td><?php echo escape($row["orderDate"]); ?></td>
                <td><?php echo escape($row["requiredDate"]); ?></td>
                <td><?php echo escape($row["shippedDate"]); ?></td>
                <td><?php echo escape($row["status"]); ?></td>
                <td><?php echo escape($row["comments"]); ?></td>
                <td><?php echo escape($row["customerNumber"]); ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['orderNumber']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../orders.php">Back to Orders</a>
<br>
<br>
<h2>Find orders based on order number</h2>

<form method="post">
    <p>
    <label for="city">orderNumber</label>
    <input type="text" id="orderNumber" name="orderNumber">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>
<br>

<a href="../orders.php">Back to Orders</a>

</body>
</html>