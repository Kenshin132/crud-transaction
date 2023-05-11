<?php
// Include the database connection file
require_once("dbConnection.php");

// Fetch data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM products ORDER BY id DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin</title>
</head>
<body>
<h1>Admin</h1>

<a href="add.php"><button type='button' class='btn btn-success'>Add New Data</button></a>

<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">Product Name</th>
				<th scope="col">Quantity</th>
				<th scope="col">Price</th>
				<th scope="col">Action</th>
			</tr>
		</thead>
		<?php
            // Fetch the next row of a result set as an associative array
            while ($res = mysqli_fetch_assoc($result)) {
                
                echo "<tr>";
                echo "<td>".$res['prod_name']."</td>";
                echo "<td>".$res['quantity']."</td>";
                echo "<td>₱ ".$res['price']."</td>";	
                echo "<td><a href=\"edit.php?id=$res[id]\"><button type='button' class='btn btn-primary'>Edit</button></a>
                <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                echo "</tr>";
            }
		?>
</table>
</body>
</html>