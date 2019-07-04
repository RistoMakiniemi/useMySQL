<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Customer Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();

if (isset($_POST['submit'])) {

    $customerName = $_POST['customerName'];
   
    // Some Query
    $sql 	= "SELECT customerNumber, customerName, contactLastName, 
        contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, 
        country, salesRepEmployeeNumber, creditLimit 
                    FROM customers WHERE customerName LIKE '$customerName'";
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
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['customerName']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../customers.php">Back to Customer</a>
<br>
<br>
<h2>Find customer based on name</h2>

<form method="post">
    <p>
    <label for="customerName">Customer Name</label>
    <input type="text" id="customerName" name="customerName">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>
<br>

<a href="../customers.php">Back to Customer</a>

</body>
</html>