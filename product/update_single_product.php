<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Product Form</title>
</head>
<body>

<?php
/**
 * Escapes HTML for output
 */
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

//Include the connection script
include '../db_connection.php';

if (isset($_POST['submit'])) {
    $conn = openconnection();

    $productCode = $_POST['productCode'];
    $productName = $_POST['productName'];
    $productLine = $_POST['productLine'];
    $productScale = $_POST['productScale'];
    $productVendor  = $_POST['productVendor'];
    $productDescription  = $_POST['productDescription'];
    $quantityInStock  = $_POST['quantityInStock'];
    $buyPrice  = $_POST['buyPrice'];
    $MSRP  = $_POST['MSRP'];

    $sql = "UPDATE products
            SET productCode = '$productCode',
            productName = '$productName',
            productLine = '$productLine',
            productScale = '$productScale',
            productVendor = '$productVendor',
            productDescription = '$productDescription',
            quantityInStock = $quantityInStock,
            buyPrice = $buyPrice,
            MSRP = $MSRP
            WHERE productCode = '$productCode'";

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }    
  
  closeconnection($conn);
}

if (isset($_GET['productCode'])) {
    $conn = openconnection();

    $productCode = $_GET['productCode'];
    // Some Query
    $sql 	= "SELECT productCode, productName, productLine, productScale, productVendor, 
        productDescription, quantityInStock, buyPrice, MSRP 
        FROM products WHERE productCode = '$productCode'";

    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $product) : ?>
  <?php echo escape($_POST['productCode']); ?> successfully updated.
<?php endif; ?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_product.php">Back to Update Product</a>
<br>
<br>
<h2>Edit a product</h2>

<form method="post">
    <?php foreach ($product as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <?php if ($key == "productDescription") { ?>
              <textarea rows="6" cols="60" name="<?php echo $key; ?>"><?php echo escape($value); ?></textarea>
      <?php } else {?>
              <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
      <?php } ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_product.php">Back to Update Product</a>

</body>
</html>