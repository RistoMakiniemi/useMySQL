<!DOCTYPE HTML>  
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MySQL Database App</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>  
	<h1>MySQL Database App</h1>
	
	<ul>
		<li><a href="offices.php"><strong>Offices</strong></a> - a office</li>
		<li><a href="employees.php"><strong>Employees</strong></a> - a employee</li>
		<li><a href="customers.php"><strong>Customers</strong></a> - a customer</li>
		<li><a href="productlines.php"><strong>Productlines</strong></a> - a productline</li>
		<li><a href="products.php"><strong>Products</strong></a> - a product</li>
		<li><a href="orders.php"><strong>Orders</strong></a> - a order</li>
		<li><a href="orderdetails.php"><strong>Orderdetails</strong></a> - a orderdetail</li>
		<li><a href="payments.php"><strong>Payments</strong></a> - a payment</li>
	</ul>	

<form action="index.php" method="get">

	<input class="MyButton" type="button" name="offices" value="offices" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/offices.php';" />
    <input class="MyButton" type="button" name="employees" value="employees" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/employees.php';" />
    <input class="MyButton" type="button" name="customers" value="customers" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/customers.php';"/>
	<input class="MyButton" type="button" name="productlines" value="productlines" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/productlines.php';" />
    <input class="MyButton" type="button" name="products" value="products" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/products.php';" />
    <input class="MyButton" type="button" name="orders" value="orders" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/orders.php';" />
    <input class="MyButton" type="button" name="orderdetails" value="orderdetails" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/orderdetails.php';" />
    <input class="MyButton" type="button" name="payments" value="payments" 
		onclick="window.location.href = 'http://localhost:8080/useMySQL/payments.php';" />
</form>

<br>
<br>

<img src="MySQL-Sample-Database-Schema.png" alt="MySQL Sample Database Schema">

</body>
</html>