<?php
session_start();

if (!isset($_SESSION["bill_items"])) {
    header("Location: billing.php");
    exit();
}

$items = $_SESSION["bill_items"];
$total = $_SESSION["grand_total"];
$date  = $_SESSION["bill_date"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Print Bill</title>
    <link rel="stylesheet" href="style.css">
    <style>
        @media print {
            button { display: none; }
        }
    </style>
</head>
<body>
<div class="bill-container">
    <h2>XYZ Grocery Store</h2>
    <p>Date: <?php echo $date; ?></p>

    <table>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price (₹)</th>
            <th>Total (₹)</th>
        </tr>

        <?php foreach ($items as $item) { ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo $item["qty"] . " " . $item["unit"]; ?></td>
            <td><?php echo $item["price"]; ?></td>
            <td><?php echo number_format($item["subtotal"], 2); ?></td>
        </tr>
        <?php } ?>

        <tr class="grand-total">
            <td colspan="3">Grand Total</td>
            <td>₹ <?php echo number_format($total, 2); ?></td>
        </tr>
    </table>

    <p class="thanks">Thank you! Visit again 🙏</p>

    <button onclick="window.print()">Print Bill</button>
</div>
</body>
</html>

<?php
unset($_SESSION["bill_items"]);
unset($_SESSION["grand_total"]);
unset($_SESSION["bill_date"]);
?>
