<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Delete Product Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

if (isset($_GET['productCode'])) {
    $conn = openconnection();
    $productCode = $_GET["productCode"];

    // Some Query
    $sql 	= "DELETE FROM products WHERE productCode = '$productCode'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    closeconnection($conn);
}

$conn = openconnection();
// Some Query
$sql = "SELECT productCode, productName, productLine, productScale, productVendor, 
productDescription, quantityInStock, buyPrice, MSRP FROM products"; 

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
<a href="../products.php">Back to Products</a>
<br>
<br>
<h2>Delete product</h2>

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
            <td><a href="delete_product.php?productCode=<?php echo escape($row["productCode"]); ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../products.php">Back to Products</a>

</body>
</html>