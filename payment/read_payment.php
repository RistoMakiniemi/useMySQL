<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Payment Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();

if (isset($_POST['submit'])) {

    $customerNumber = $_POST['customerNumber'];
    $checkNumber = $_POST['checkNumber'];

    // Some Query
    $sql 	= "SELECT customerNumber, checkNumber, paymentDate, amount 
        FROM payments WHERE customerNumber LIKE '$customerNumber' AND checkNumber LIKE '$checkNumber'";

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
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['customerNumber']); ?> and 
                                <?php echo escape($_POST['checkNumber']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../payments.php">Back to Payments</a>
<br>
<br>
<h2>Find payments based on customer number</h2>

<form method="post">
    <p>
    <label for="city">customerNumber</label>
    <input type="text" id="customerNumber" name="customerNumber">
    <label for="city">checkNumber</label>
    <input type="text" id="checkNumber" name="checkNumber">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>
<br>

<a href="../payments.php">Back to Payments</a>

</body>
</html>