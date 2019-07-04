<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Delete Employee Form</title>
</head>
<body>

<?php

//Include the connection script
include '../db_connection.php';

if (isset($_GET['employeeNumber'])) {
    $conn = openconnection();
    $employeeNumber = $_GET["employeeNumber"];

    // Some Query
    $sql 	= "DELETE FROM employees WHERE employeeNumber = '$employeeNumber'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    closeconnection($conn);
}

$conn = openconnection();
// Some Query
$sql = "SELECT employeeNumber, lastName,firstName, extension, email, officeCode, 
    reportsTo, jobTitle FROM employees"; 

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
<a href="../employees.php">Back to Employees</a>
<br>
<br>
<h2>Delete employee</h2>

<table>
    <thead>
        <tr>
            <th>employeeNumber</th>
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
            <td><a href="delete_employee.php?employeeNumber=<?php echo escape($row["employeeNumber"]); ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
    
<br>

<a href="../employees.php">Back to Employees</a>

</body>
</html>