<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Delete Office Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

if (isset($_GET['officeCode'])) {
    $conn = openconnection();
    $officeCode = $_GET["officeCode"];

    // Some Query
    $sql 	= "DELETE FROM offices WHERE officeCode = '$officeCode'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    closeconnection($conn);
}

$conn = openconnection();
// Some Query
$sql = "SELECT officeCode, city, phone, addressLine1, addressLine2, state, 
    country, postalCode, territory FROM offices"; 

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
<a href="../offices.php">Back to Office</a>
<br>
<br>
<h2>Delete office</h2>

<table>
    <thead>
        <tr>
            <th>office code</th>
            <th>city</th>
            <th>phone</th>
            <th>addressLine1</th>
            <th>addressLine2</th>
            <th>state</th>
            <th>country</th>
            <th>postalCode</th>
            <th>territory</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) { ?>
        <tr>
            <td><?php echo escape($row["officeCode"]); ?></td>
            <td><?php echo escape($row["city"]); ?></td>
            <td><?php echo escape($row["phone"]); ?></td>
            <td><?php echo escape($row["addressLine1"]); ?></td>
            <td><?php echo escape($row["addressLine2"]); ?></td>
            <td><?php echo escape($row["state"]); ?></td>
            <td><?php echo escape($row["country"]); ?></td>
            <td><?php echo escape($row["postalCode"]); ?> </td>
            <td><?php echo escape($row["territory"]); ?> </td>
            <td><a href="delete_office.php?officeCode=<?php echo escape($row["officeCode"]); ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../offices.php">Back to Office</a>

</body>
</html>