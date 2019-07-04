<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Office Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();

if (isset($_POST['submit'])) {

    $city = $_POST['city'];

    // Some Query
    $sql 	= "SELECT officeCode, city, phone, addressLine1, addressLine2, state, 
        country, postalCode, territory 
        FROM offices WHERE city LIKE '$city'";

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
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['city']); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../offices.php">Back to Office</a>
<br>
<br>
<h2>Find office based on city name</h2>

<form method="post">
    <p>
    <label for="city">City</label>
    <input type="text" id="city" name="city">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>
<br>

<a href="../offices.php">Back to Office</a>

</body>
</html>