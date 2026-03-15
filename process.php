<?php
// User-defined functions

function compute_subtotal($price, $quantity) {
    return $price * $quantity;
}

function compute_discount($subtotal) {
    // Assume 10% discount if subtotal > 100
    if ($subtotal > 100) {
        return $subtotal * 0.10;
    }
    return 0;
}

function compute_tax($subtotal) {
    // Assume 8% tax
    return $subtotal * 0.08;
}

function compute_final_amount($subtotal, $discount, $tax) {
    return $subtotal - $discount + $tax;
}

function format_currency($amount) {
    return number_format($amount, 2);
}

// Built-in functions used: number_format (in format_currency), strtoupper, round (for rounding tax or something)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = strtoupper($_POST['item_name']); // built-in: strtoupper
    $price = (float)$_POST['price'];
    $quantity = (int)$_POST['quantity'];

    $subtotal = compute_subtotal($price, $quantity);
    $discount = compute_discount($subtotal);
    $tax = compute_tax($subtotal);
    $final_amount = compute_final_amount($subtotal, $discount, $tax);

    // Round tax to 2 decimals, built-in: round
    $tax = round($tax, 2);

    echo "<h1>Transaction Summary</h1>";
    echo "<p>Item Name: " . $item_name . "</p>";
    echo "<p>Price: $" . format_currency($price) . "</p>";
    echo "<p>Quantity: " . $quantity . "</p>";
    echo "<p>Subtotal: $" . format_currency($subtotal) . "</p>";
    echo "<p>Discount: $" . format_currency($discount) . "</p>";
    echo "<p>Tax: $" . format_currency($tax) . "</p>";
    echo "<p>Final Amount to Pay: $" . format_currency($final_amount) . "</p>";
} else {
    echo "Invalid request.";
}
?>
