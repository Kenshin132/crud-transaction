<?php
// Include the database connection file
require_once("admin/dbConnection.php");

// Initialize the cart array
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if a product is removed from the cart
if (isset($_POST['remove_item'])) {
    $productId = $_POST['product_id'];

    // Remove the product from the cart
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        echo "<script>alert('Product removed from the cart.');</script>";
    }
}

// Check if the quantity of a product is updated in the cart
if (isset($_POST['update_quantity'])) {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['quantity'];

    // Update the quantity in the cart
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = $newQuantity;
    }
}

// Calculate the total price and update the product quantity
$totalPrice = 0;

// Fetch data in descending order (latest entry first)
$client = mysqli_query($mysqli, "SELECT * FROM products ORDER BY id DESC");

ob_start(); // Start output buffering

foreach ($_SESSION['cart'] as $productId => $quantity) {
    // Fetch the product details
    $productQuery = mysqli_query($mysqli, "SELECT * FROM products WHERE id = $productId");
    $product = mysqli_fetch_assoc($productQuery);

    // Calculate the subtotal for each item
    $subtotal = $product['price'] * $quantity;

    // Update the total price
    $totalPrice += $subtotal;

    echo "<tr>";
    echo "<td>".$product['prod_name']."</td>";
    echo "<td>₱ ".$product['price']."</td>";
    echo "<td>
            <form method='POST'>
                <input type='hidden' name='product_id' value='".$productId."'>
                <input type='number' name='quantity' value='".$quantity."' min='1'>
                <button type='submit' name='update_quantity' class='btn btn-primary'>Update</button>
            </form>
          </td>";
    echo "<td>₱ ".$subtotal."</td>";
    echo "<td>
            <form method='POST'>
                <input type='hidden' name='product_id' value='".$productId."'>
                <button type='submit' name='remove_item' class='btn btn-danger'>Remove</button>
            </form>
          </td>";
    echo "</tr>";
}

$content = ob_get_clean(); // Get the buffered content
?>