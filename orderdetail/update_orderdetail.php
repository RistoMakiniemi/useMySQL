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

$conn = openconnection();

// Some Query
$sql 	= "SELECT orderNumber, productCode, quantityOrdered, 
    priceEach, orderLineNumber FROM orderdetails"; 

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
<a href="../orderdetails.php">Back to Orderdetails</a>
<br>
<br>
<h2>Update orderdetail</h2>

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
            <td><a href="update_single_orderdetail.php?orderNumber=<?php echo escape($row["orderNumber"]); ?> & 
                                                productCode=<?php echo escape($row["productCode"]); ?>">Edit</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../orderdetails.php">Back to Orderdetails</a>

</body>
</html>