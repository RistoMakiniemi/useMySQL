<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Productline Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();
#queryemployees($conn);
#closeconnection($conn);


if (isset($_POST['submit'])) {

    $productLine = $_POST['productLine'];

    // Some Query
    $sql 	= "SELECT productLine, textDescription, htmlDescription, image 
        FROM productlines WHERE productLine LIKE '$productLine'";

    $result = $conn->query($sql);
}

closeconnection($conn);
?>

        
<?php

/**
* Escapes HTML for output
*
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
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['productLine']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../productlines.php">Back to Productlines</a>
<br>
<br>
<h2>Find Productline based on id named productLine</h2>

<form method="post">
    <p>
    <label for="productLine">Productline</label>
    <input type="text" id="productLine" name="productLine">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>
<br>

<a href="../productlines.php">Back to Productlines</a>

</body>
</html>