<?php
/* Write a program for Inventory Management using Associative Arrays.
   Calculate total inventory value and display the result in styled table. */

session_start();

// Initialize inventory in session if not already set
if (!isset($_SESSION['inventory'])) {
    $_SESSION['inventory'] = [];
}

$inventory = $_SESSION['inventory'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST["product"];
    $price = floatval($_POST["price"]);
    $quantity = intval($_POST["quantity"]);

    $itemTotal = $price * $quantity;

    // Add item to session inventory
    $inventory[] = [
        "product" => $product,
        "price" => $price,
        "quantity" => $quantity,
        "total" => $itemTotal
    ];

    $_SESSION['inventory'] = $inventory;
}

// Calculate total value
$totalValue = array_sum(array_column($inventory, "total"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management</title>
    <style>
        body { font-family: sans-serif; background: #f5f5f5; padding: 30px; }
        .container { width: 600px; margin: auto; background: #fff; padding: 20px;
                     box-shadow: 0 0 10px #aaa; border-radius: 10px; }
        input, button { padding: 8px; margin: 5px 0; width: 100%; }
        input[type="submit"] { background: #3f51b5; color: white; border: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ccc; }
        th { background: #3f51b5; color: white; }
        .total-row { font-weight: bold; background: #eee; }
    </style>
</head>
<body>
<div class="container">
    <h2>Inventory Entry Form</h2>
    <form method="post">
        <input type="text" name="product" placeholder="Product Name" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <input type="submit" value="Add Product">
    </form>

    <?php if (!empty($inventory)): ?>
    <table>
        <tr>
            <th>Product</th><th>Price</th><th>Quantity</th><th>Total</th>
        </tr>
        <?php foreach ($inventory as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item["product"]) ?></td>
            <td>₹<?= number_format($item["price"], 2) ?></td>
            <td><?= $item["quantity"] ?></td>
            <td>₹<?= number_format($item["total"], 2) ?></td>
        </tr>
        <?php endforeach; ?>
        <tr class="total-row">
            <td colspan="3">Total Inventory Value</td>
            <td>₹<?= number_format($totalValue, 2) ?></td>
        </tr>
    </table>
    <?php endif; ?>
</div>
</body>
</html>
