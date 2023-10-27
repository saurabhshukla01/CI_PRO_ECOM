<!-- app/Views/cart/index.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= $item['product_name']; ?></td>
                    <td><?= $item['quantity']; ?></td>
                    <td><?= $item['price']; ?></td>
                    <td><?= $item['quantity'] * $item['price']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="<?= site_url('checkout'); ?>">Checkout</a>
</body>
</html>
