<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Delete Productline Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

if (isset($_GET['productLine'])) {
    $conn = openconnection();
    $productLine = $_GET["productLine"];

    // Some Query
    $sql 	= "DELETE FROM productlines WHERE productLine = '$productLine'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    closeconnection($conn);
}

$conn = openconnection();
// Some Query
$sql = "SELECT productLine, textDescription, htmlDescription, image FROM productlines"; 

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
<a href="../productlines.php">Back to Productlines</a>
<br>
<br>
<h2>Delete productline</h2>

<table>
    <thead>
        <tr>
            <th width=10%>Product Line</th>
            <th width=50%>Text Description</th>
            <th width=20%>Html Description</th>
            <th width=20%>Image</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) { ?>
        <tr>
            <td width=10%><?php echo escape($row["productLine"]); ?></td>
            <td width=50%><?php echo escape($row["textDescription"]); ?></td>
            <td width=20%><?php echo escape($row["htmlDescription"]); ?></td>
            <td width=20%><?php echo escape($row["image"]); ?></td>
            <td><a href="delete_productline.php?productLine=<?php echo escape($row["productLine"]); ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../productlines.php">Back to Productlines</a>

</body>
</html>