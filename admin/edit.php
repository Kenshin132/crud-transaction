<?php
// Include the database connection file
require_once("dbConnection.php");

// Get id from URL parameter
$id = $_GET['id'];

// Select data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM products WHERE id = $id");

// Fetch the next row of a result set as an associative array
$resultData = mysqli_fetch_assoc($result);

$prod_name = $resultData['prod_name'];
$quantity = $resultData['quantity'];
$price = $resultData['price'];
?>
<html>
<head>	
	<title>Edit Data</title>
</head>

<body>
    <h2>Edit Data</h2>
    <p>
	    <a href="index.php">Home</a>
    </p>
	
	<form name="edit" method="post" action="editAction.php">
		<table border="0">
			<tr> 
				<td>Product Name</td>
				<td><input type="text" name="prod_name" value="<?php echo $prod_name; ?>"></td>
			</tr>
			<tr> 
				<td>Quantity</td>
				<td><input type="text" name="quantity" value="<?php echo $quantity; ?>"></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="text" name="price" value="<?php echo $price; ?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $id; ?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>