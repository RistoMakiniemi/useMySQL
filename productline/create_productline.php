<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css">
<title>Add Productline Form</title>
</head>
<body>

<?php
// define variables and set to empty values

$productLineErr = "";
$productLine = $textDescription = $htmlDescription = $image = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["productLine"])) {
		$productLineErr = "ProductLine is required";
	} else {
		$productLine = test_input($_POST["productLine"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$productLine)) {
			$productLineErr = "Only letters and white space allowed";
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

//Include the connection script
include '../db_connection.php';

if (isset($_POST['submit'])) {

	/* Attempt MySQL server connection. Assuming you are running MySQL
	server with default setting (user 'root' with no password) */
    $conn = openconnection();

    $productLine     = $_POST['productLine'];
    $textDescription = $_POST['textDescription'];
    $htmlDescription = $_POST['htmlDescription'];
    //$image           = $_POST['image'];
    
    // Image file handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    //$uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        //$uploadOk = 1;
    } else {
        echo "File is not an image.";
        //$uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            //$uploadOk = 0;
    }
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    /* if(getimagesize($_FILES['image']['tmp_name'])==false)
     {
        echo " error ";
     }
     else
     {
        $image = $_FILES['image']['tmp_name'];
        $image = addslashes(file_get_contents($image));
     } */


    $sql = "INSERT INTO offices ". "(productLine, textDescription, 
        htmlDescription, image) ". "VALUES('$productLine','$textDescription','$htmlDescription', '$image')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        echo "New record created successfully. Last inserted ID is: " . $last_id . "</br>";
        queryproductlinebyid($conn, $last_id);

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    closeconnection($conn);
}

?>

<h2>PHP Form - MySQL Testing Example</h2>
<br>
<a href="../productlines.php">Back to Productlines</a>
<br>
<br>
<h2>Add a Productline</h2>

<p><span class = "error">* required field.</span></p>
<form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 <table>
	<tr>
	   <td>ProductLine:</td>
	   <td><input type = "text" name = "productLine" value="<?php echo $productLine;?>">
		  <span class = "error">* <?php echo $productLineErr;?></span>
	   </td>
	</tr>

	<tr>
	   <td>Text Description:</td>
	   <!-- <td><input type = "text" maxlength = "4000" size="140" name = "textDescription" value="<//?php echo $textDescription;?>"> -->
       <td><textarea name="textDescription" maxlength = "4000" rows="10" cols="50" value="<?php echo $textDescription;?>"></textarea>

		  <!-- <span class = "error">* <?//php echo $phoneErr;?></span> -->
	   </td>
	</tr>
	
	<tr>
	   <td>Html Description: </td>
	   <!-- <td><input type = "text" name = "htmlDescription" value="<//?php echo $htmlDescription;?>"> -->
       <td><textarea name="htmlDescription" rows="10" cols="50" value="<?php echo $htmlDescription;?>"></textarea>
		  <!-- <span class = "error">* <//?php echo $addressLine1Err;?></span> -->
	   </td>
	</tr>

	<tr>
	   <td>Image:</td>
	   <td> <input type = "file" width="100" height="100" name = "image" id = "image" value="<?php echo $image;?>">
		  <!-- <span class = "error"> <?//php echo $addressLine1Err;?></span> -->
	   </td>
	</tr>
					
	<tr>
	   <td>
		  <input type = "submit" name = "submit" value = "Submit"> 
	   </td>
	</tr>
	
 </table>
</form>

<br>

<a href="../productlines.php">Back to Productlines</a>

</body>
</html>