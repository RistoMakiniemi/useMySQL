<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Delete Order Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

if (isset($_GET['orderNumber'])) {
    $conn = openconnection();
    
    $orderNumber = $_GET["orderNumber"];

    // Some Query
    $sql 	= "DELETE FROM orders WHERE orderNumber = '$orderNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    closeconnection($conn);
}

$conn = openconnection();
// Some Query
$sql = "SELECT orderNumber, orderDate, requiredDate, shippedDate, status, 
        comments, customerNumber FROM orders"; 

$result = $conn->query($sql);
closeconnection($conn);
?>

        
<?php

/**
* Escapes HTML for output
*/
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../orders.php">Back to Orders</a>
<br>
<br>
<h2>Delete order</h2>

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
            <td><a href="delete_order.php?orderNumber=<?php echo escape($row["orderNumber"]); ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../orders.php">Back to Orders</a>

</body>
</html>