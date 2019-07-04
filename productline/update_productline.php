<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Update Office Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();

// Some Query
$sql 	= "SELECT productLine, textDescription, htmlDescription, image FROM productlines"; 

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
<h2>Update productline</h2>

<table>
    <thead>
        <tr>
            <th width=10%>productLine</th>
            <th width=50%>textDescription</th>
            <th width=20%>htmlDescription</th>
            <th width=20%>image</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) { ?>
        <tr>
            <td width=10%><?php echo escape($row["productLine"]); ?> </td>
            <td width=50%><?php echo escape($row["textDescription"]); ?> </td>
            <td width=20%><?php echo escape($row["htmlDescription"]); ?> </td>
            <td width=20%><?php echo escape($row["image"]); ?> </td>
            <td><a href="update_single_productline.php?productLine=<?php echo escape($row["productLine"]); ?>">Edit</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../productlines.php">Back to Productlines</a>

</body>
</html>