<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Office Form</title>
</head>
<body>

<?php
/**
 * Escapes HTML for output
 *
 */
function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

//Include the connection script
include '../db_connection.php';

if (isset($_POST['submit'])) {
    $conn = openconnection();

    $officeCode  = $_POST['officeCode'];
    $city        = $_POST['city'];
    $phone       = $_POST['phone'];
    $addressLine1 = $_POST['addressLine1'];
    $addressLine2 = $_POST['addressLine2'];
    $state       = $_POST['state'];
    $country     = $_POST['country'];
    $postalCode  = $_POST['postalCode'];
    $territory   = $_POST['territory'];

    $sql = "UPDATE offices
            SET officeCode = '$officeCode',
            city = '$city',
            phone = '$phone',
            addressLine1 = '$addressLine1',
            addressLine1 = '$addressLine1',
            state = '$state',
            country = '$country',
            postalCode = '$postalCode',
            territory = '$territory'
            WHERE officeCode = '$officeCode'";

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }    
  
  closeconnection($conn);
}

if (isset($_GET['officeCode'])) {
    $conn = openconnection();

    $officeCode = $_GET['officeCode'];
    // Some Query
    $sql 	= "SELECT officeCode, city, phone, addressLine1, addressLine2, state, 
        country, postalCode, territory 
        FROM offices WHERE officeCode = '$officeCode'";

    $result = $conn->query($sql);
    $office = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $office) : ?>
  <?php echo escape($_POST['city']); ?> successfully updated.
<?php endif; ?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_office.php">Back to Update Office</a>
<br>
<br>
<h2>Edit a office</h2>

<form method="post">
    <?php foreach ($office as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_office.php">Back to Update Office</a>

</body>
</html>