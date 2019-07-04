<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Read Employee Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

$conn = openconnection();
#queryemployees($conn);
#closeconnection($conn);

if (isset($_POST['submit'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Some Query
    $sql 	= "SELECT employeeNumber, lastName, firstName, extension, email, officeCode, reportsTo, jobTitle 
                    FROM employees WHERE firstName LIKE '$firstName' AND lastName LIKE '$lastName'";
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
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Extension</th>
                    <th>Email Address</th>
                    <th>officeCode</th>
                    <th>reportsTo</th>
                    <th>jobTitle</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["employeeNumber"]); ?></td>
                <td><?php echo escape($row["firstName"]); ?></td>
                <td><?php echo escape($row["lastName"]); ?></td>
                <td><?php echo escape($row["extension"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["officeCode"]); ?></td>
                <td><?php echo escape($row["reportsTo"]); ?></td>
                <td><?php echo escape($row["jobTitle"]); ?> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <blockquote>No results found for <?php echo escape($_POST['firstName']); ?>
                                         <?php echo escape($_POST["lastName"]); ?>.</blockquote>
    <?php } 
} ?> 

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../employees.php">Back to Employees</a>
<br>
<br>
<h2>Find employee based on name</h2>

<form method="post">
    <p>
    <label for="firstname">Firstname</label>
    <input type="text" id="firstName" name="firstName">
    </p>
    <p>
    <label for="lastname">Lastname</label>
    <input type="text" id="lastName" name="lastName">
    </p>
    <input type="submit" name="submit" value="View Results">
</form>

<br>

<a href="../employees.php">Back to Employees</a>

</body>
</html>