<?php
session_start();
include "db.php";

if (!isset($_SESSION["logged_in"])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST["save"])) {
    $name  = $_POST["name"];
    $unit  = $_POST["unit"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];

    if ($_POST["id"] == "") {
        
        $sql = "INSERT INTO products (name, unit, price, stock) VALUES ('$name', '$unit', '$price', '$stock')";
    } else {
        
        $id = $_POST["id"];
        $sql = "UPDATE products SET
                name='$name',
                unit='$unit',
                price='$price',
                stock='$stock'
                WHERE id=$id";
    }
    mysqli_query($conn, $sql);
    header("Location: stock.php");
    exit();
}


$editData = null;
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
    $editData = mysqli_fetch_assoc($result);
}

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY name ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Stock Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="top-bar">
    <h2>Stock Management</h2>
    <a href="billing.php" class="btn">Go to Billing</a>
    <a href="logout.php" class="btn logout">Logout</a>
</div>

<div class="container">

    <div class="card">
        <h3><?php echo $editData ? "Edit Product" : "Add Product"; ?></h3>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">

            <label>Product Name</label>
            <input type="text" name="name" required
                   value="<?php echo $editData['name'] ?? ''; ?>">

            <label>Unit</label>
            <select name="unit" required>
                <?php
                $units = ["Kg", "Litre", "Pcs", "Pack"];
                foreach ($units as $u) {
                    $selected = ($editData && $editData["unit"] == $u) ? "selected" : "";
                    echo "<option $selected>$u</option>";
                }
                ?>
            </select>

            <label>Price (₹)</label>
            <input type="number" step="0.01" name="price" required
                   value="<?php echo $editData['price'] ?? ''; ?>">

            <label>Stock</label>
            <input type="number" step="0.01" name="stock" required
                   value="<?php echo $editData['stock'] ?? ''; ?>">

            <button type="submit" name="save">Save Product</button>
        </form>
    </div>

    <div class="card">
        <h3>Product List</h3>

        <table>
            <tr>
                <th>Name</th>
                <th>Unit</th>
                <th>Price(₹)</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($products)) { ?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["unit"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["stock"]; ?></td>
                    <td>
                        <a href="stock.php?edit=<?php echo $row["id"]; ?>">Edit</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
</body>
</html>
