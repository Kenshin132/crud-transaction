<?php
// Include the database connection file
require_once("admin/dbConnection.php");

// Include the cart functions file
require_once("cartFunction.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Karinderya</title>
</head>

<body>
    <h1>Cart</h1>
    <a href='index.php'><button type='button' class='btn btn-primary'>Home</button></a>
    <table class='table table-striped'>
        <thead>
        <tr>
            <th scope='col'>Product Name</th>
            <th scope='col'>Price</th>
            <th scope='col'>Quantity</th>
            <th scope='col'>Subtotal</th>
            <th scope='col'></th>
        </tr>
        </thead>
        <tbody>
            <?php echo $content; ?>
        </tbody>
    </table>

    <h5>Total Price: ₱ <?php echo $totalPrice; ?></h5>

    <?php
    // Checkout button to update the product quantity in the database
    if (!empty($_SESSION['cart'])) {
        echo "<form method='POST'>";
        echo "<button type='submit' name='checkout' class='btn btn-success'>Checkout</button>";
        echo "</form>";
    }

    // Process the checkout
    if (isset($_POST['checkout'])) {
        // Update the product quantities in the database
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $productQuery = mysqli_query($mysqli, "SELECT * FROM products WHERE id = $productId");
            $product = mysqli_fetch_assoc($productQuery);

            // Check if the available quantity is sufficient
            if ($product['quantity'] >= $quantity) {
                // Update the product quantity
                $newQuantity = $product['quantity'] - $quantity;
                mysqli_query($mysqli, "UPDATE products SET quantity = $newQuantity WHERE id = $productId");
            } else {
                // Insufficient quantity, display an error message
                echo "<script>alert('Insufficient quantity for product: " . $product['prod_name'] . "');</script>";
            }
        }

        // Clear the cart and display a success message
        $_SESSION['cart'] = [];
        echo "<script>alert('Checkout successful.');</script>";
    }
    ?>

</body>

</html>