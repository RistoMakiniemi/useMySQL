<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Delete Payment Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

if (isset($_GET['customerNumber'])) {
    $conn = openconnection();
    $customerNumber = $_GET["customerNumber"];

    // Some Query
    $sql 	= "DELETE FROM payments WHERE customerNumber = '$customerNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    closeconnection($conn);
}

$conn = openconnection();
// Some Query
$sql = "SELECT customerNumber, checkNumber, paymentDate, amount FROM payments"; 

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
<a href="../payments.php">Back to Payments</a>
<br>
<br>
<h2>Delete payment</h2>

<table>
    <thead>
        <tr>
        <th>customerNumber</th>
            <th>checkNumber</th>
            <th>paymentDate</th>
            <th>amount</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo escape($row["customerNumber"]); ?></td>
            <td><?php echo escape($row["checkNumber"]); ?></td>
            <td><?php echo escape($row["paymentDate"]); ?></td>
            <td><?php echo escape($row["amount"]); ?></td>
            <td><a href="delete_payment.php?customerNumber=<?php echo escape($row["customerNumber"]); ?> & 
                                        checkNumber=<?php echo escape($row["checkNumber"]); ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../payments.php">Back to Payments</a>

</body>
</html>