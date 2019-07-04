<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Product Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();

if (isset($_POST['submit'])) {

    $productName = $_POST['productName'];

    // Some Query
    $sql 	= "SELECT productCode, productName, productLine, productScale, productVendor, 
        productDescription, quantityInStock, buyPrice, MSRP 
        FROM products WHERE productName LIKE '$productName'";

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
                    <th>ProductCode</th>
                    <th>productName</th>
                    <th>productLine</th>
                    <th>productScale</th>
                    <th>productVendor</th>
                    <th>productDescription</th>
                    <th>quantityInStock</th>
                    <th>buyPrice</th>
                    <th>MSRP</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["productCode"]); ?></td>
                <td><?php echo escape($row["productName"]); ?></td>
                <td><?php echo escape($row["productLine"]); ?></td>
                <td><?php echo escape($row["productScale"]); ?></td>
                <td><?php echo escape($row["productVendor"]); ?></td>
                <td><?php echo escape($row["productDescription"]); ?></td>
                <td><?php echo escape($row["quantityInStock"]); ?></td>
                <td><?php echo escape($row["buyPrice"]); ?> </td>
                <td><?php echo escape($row["MSRP"]); ?> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['productName']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../products.php">Back to Products</a>
<br>
<br>
<h2>Find product based on product name</h2>

<form method="post">
    <p>
    <label for="city">Productname</label>
    <input type="text" id="productName" name="productName">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>
<br>

<a href="../products.php">Back to Products</a>

</body>
</html>