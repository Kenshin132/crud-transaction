<?php
// Include the database connection file
require_once("admin/dbConnection.php");

// Initialize the cart array
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if a product is added to the cart
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $quantity;
        echo "<script>alert('Product quantity updated in the cart.');</script>";
    } else {
        // Add the product to the cart with the specified quantity
        $_SESSION['cart'][$productId] = $quantity;
        echo "<script>alert('Product added to the cart.');</script>";
    }
}

// Fetch data in descending order (latest entry first)
$client = mysqli_query($mysqli, "SELECT * FROM products ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Karinderya</title>
</head>
<body>

<h1>Products</h1>

<a href="cart.php"><button type="button" class="btn btn-primary">Cart</button></a> <!-- Add this line -->

<h5>Products</h5>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch the next row of a result set as an associative array
        while ($clnt = mysqli_fetch_assoc($client)) {
            echo "<tr>";
            echo "<td>".$clnt['prod_name']."</td>";
            echo "<td>₱ ".$clnt['price']."</td>";
            echo "<td>
            <form method='POST'>
            <input type='hidden' name='product_id' value='".$clnt['id']."'>
            <input type='number' name='quantity' value='1' min='1'>
            <button type='submit' name='add_to_cart' class='btn btn-success'>Add to cart</button>
            </form>
            </td>";
            echo "</tr>";
            }
            ?>
        </tbody>
            
    </table>
</body>
</html>