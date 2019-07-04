<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Productline Form</title>
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

    $productLine  = $_POST['productLine'];
    $textDescription   = $_POST['textDescription'];
    $htmlDescription   = $_POST['htmlDescription'];
    $image = $_POST['image'];

    $sql = "UPDATE productlines
            SET productLine = '$productLine',
            textDescription = '$textDescription',
            htmlDescription = '$htmlDescription',
            image = '$image' WHERE productLine = '$productLine'";

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }    
  
  closeconnection($conn);
}

if (isset($_GET['productLine'])) {
    $conn = openconnection();

    $productLine = $_GET['productLine'];
    // Some Query
    $sql 	= "SELECT productLine, textDescription, htmlDescription, image 
                FROM productlines WHERE productLine = '$productLine'";

    $result = $conn->query($sql);
    $sel_productline = $result->fetch_assoc();
    closeconnection($conn);
} else {
    echo "Something went wrong!";
    exit;
}

?>

<?php if (isset($_POST['submit']) && $sel_productline) : ?>
  <?php echo escape($_POST['productLine']); ?> successfully updated.
<?php endif; ?>


<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="update_productline.php">Back to Update Productline</a>
<br>
<br>
<h2>Edit a Productline</h2>

<form method="post">
    <?php foreach ($sel_productline as $key => $value) : ?>
        <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
        <?php if ($key == "productLine") { ?>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
        <?php } ?>
        <?php if ($key == "textDescription") { ?>
            <textarea maxlength = "4000" rows="10" cols="80" name="<?php echo $key; ?>" id="<?php echo $key; ?>"><?php echo escape($value); ?></textarea>
        <?php } ?>
        <?php if ($key == "htmlDescription") { ?>
            <textarea rows="10" cols="80" name="<?php echo $key; ?>" id="<?php echo $key; ?>"><?php echo escape($value); ?></textarea>
        <?php } ?>
        <?php if ($key == "image") { ?>
            <input type = "image" width="100" height="100" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>">
        <?php } ?>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<br>

<a href="update_productline.php">Back to Update Productline</a>

</body>
</html>