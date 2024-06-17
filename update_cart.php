<?php
session_start();

if (isset($_POST['index']) && isset($_POST['quantity'])) {
    $index = intval($_POST['index']);
    $quantity = intval($_POST['quantity']);

    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        echo json_encode(array('status' => 'success', 'quantity' => $quantity));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid index'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Quantity or index not set'));
}
?>
