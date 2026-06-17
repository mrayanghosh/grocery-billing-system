<?php
session_start();
include "db.php";

if (!isset($_SESSION["logged_in"])) {
    header("Location: index.php");
    exit();
}

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY name ASC");

if (isset($_POST["generate_bill"])) {

    $product_ids = $_POST["product_id"];
    $quantities  = $_POST["quantity"];

    $bill_items = [];
    $grand_total = 0;

    for ($i = 0; $i < count($product_ids); $i++) {
        $pid = $product_ids[$i];
        $qty = $quantities[$i];

        if ($qty <= 0) continue;

        $result = mysqli_query($conn, "SELECT * FROM products WHERE id=$pid");
        $product = mysqli_fetch_assoc($result);

        if ($product["stock"] < $qty) {
            die("Not enough stock for " . $product["name"]);
        }

        $subtotal = $qty * $product["price"];
        $grand_total += $subtotal;

        $new_stock = $product["stock"] - $qty;
        mysqli_query($conn, "UPDATE products SET stock=$new_stock WHERE id=$pid");

        $bill_items[] = [
            "name" => $product["name"],
            "unit" => $product["unit"],
            "price" => $product["price"],
            "qty" => $qty,
            "subtotal" => $subtotal
        ];
    }

    $_SESSION["bill_items"] = $bill_items;
    $_SESSION["grand_total"] = $grand_total;
    $_SESSION["bill_date"] = date("d-m-Y H:i");

    header("Location: print_bill.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Billing</title>
    <link rel="stylesheet" href="style.css">
    <script src="billing.js"></script>
</head>

<body>

<div class="top-bar">
    <h2>Billing</h2>
    <a href="stock.php" class="btn">Back to Stock</a>
</div>

<div class="container">
    <form method="POST" onsubmit="return validateBill();">

        <table id="billTable">
            <tr>
                <th>Product</th>
                <th>Price (₹)</th>
                <th>Quantity</th>
                <th>Subtotal (₹)</th>
                <th>Action</th>
            </tr>

            <tr>
                <td>
                    <select name="product_id[]" onchange="updatePrice(this)">
                        <option value="">Select</option>
                        <?php while ($p = mysqli_fetch_assoc($products)) { ?>
                            <option value="<?php echo $p['id']; ?>"
                                    data-price="<?php echo $p['price']; ?>">
                                <?php echo $p['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="text" class="price" readonly></td>
                <td><input type="number" name="quantity[]" class="qty" min="1" oninput="calculateSubtotal(this)"></td>
                <td><input type="text" class="subtotal" readonly></td>
                <td><button type="button" class="remove" onclick="removeRow(this)">X</button></td>
            </tr>
        </table>

        <button type="button" onclick="addRow()">+ Add Row</button>

        <h3>Total: ₹ <span id="grandTotal">0.00</span></h3>

        <button type="submit" name="generate_bill" class="primary">
            Generate & Print Bill
        </button>
    </form>
</div>
</body>
</html>