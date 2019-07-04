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

$conn = openconnection();

// Some Query
    $sql 	= "SELECT customerNumber, customerName, contactLastName, 
        contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, 
        country, salesRepEmployeeNumber, creditLimit FROM customers"; 

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
<a href="../customers.php">Back to Customer</a>
<br>
<br>
<h2>Update customer</h2>

<table>
    <thead>
        <tr>
            <th>customer number</th>
            <th>customerName</th>
            <th>contactLastName</th>
            <th>contactFirstName</th>
            <th>phone</th>
            <th>addressLine1</th>
            <th>addressLine2</th>
            <th>city</th>
            <th>state</th>
            <th>postalCode</th>
            <th>country</th>
            <th>salesRepEmployeeNumber</th>
            <th>creditLimit</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo escape($row["customerNumber"]); ?></td>
            <td><?php echo escape($row["customerName"]); ?></td>
            <td><?php echo escape($row["contactLastName"]); ?></td>
            <td><?php echo escape($row["contactFirstName"]); ?></td>
            <td><?php echo escape($row["phone"]); ?></td>
            <td><?php echo escape($row["addressLine1"]); ?></td>
            <td><?php echo escape($row["addressLine2"]); ?></td>
            <td><?php echo escape($row["city"]); ?> </td>
            <td><?php echo escape($row["state"]); ?> </td>
            <td><?php echo escape($row["postalCode"]); ?> </td>
            <td><?php echo escape($row["country"]); ?> </td>
            <td><?php echo escape($row["salesRepEmployeeNumber"]); ?> </td>
            <td><?php echo escape($row["creditLimit"]); ?> </td>
            <td><a href="update_single_customer.php?customerNumber=<?php echo escape($row["customerNumber"]); ?>">Edit</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../customers.php">Back to Customer</a>

</body>
</html>