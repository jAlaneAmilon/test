<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $name, $description, $price, $quantity);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        $error = "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        label { display: block; margin-top: 10px; }
        input { padding: 6px; width: 250px; }
        button { margin-top: 15px; padding: 8px 14px; background: #2c7be5; color: #fff; border: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Add New Product</h1>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Description</label>
        <input type="text" name="description">

        <label>Price</label>
        <input type="number" step="0.01" name="price" required>

        <label>Quantity</label>
        <input type="number" name="quantity" required>

        <button type="submit">Save</button>
    </form>
    <p><a href="index.php">Back to list</a></p>
</body>
</html>
