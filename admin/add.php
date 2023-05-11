<html>
<head>
	<title>Add Data</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<h2>Add Data</h2>
	<p>
		<a href="index.php"><button type='button' class='btn btn-warning'>Home</button></a>
	</p>

	<form action="addAction.php" method="post" name="add">
		<table width="25%" border="0">
			<tr> 
				<td>Product Name</td>
				<td><input type="text" name="prod_name"></td>
			</tr>
			<tr> 
				<td>Quantity</td>
				<td><input type="number" name="quantity"></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="number" name="price"></td>
			</tr>
			<tr> 
				<td></td>
				<td><button type='submit' name="submit" class='btn btn-success'>Add</button></td>
			</tr>
		</table>
	</form>
</body>
</html>