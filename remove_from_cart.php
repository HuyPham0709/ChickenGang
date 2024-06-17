<?php
session_start();

if (isset($_POST['index'])) {
    $index = intval($_POST['index']);
    
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Re-index the cart array to maintain consistency
        $_SESSION['cart'] = array_values($_SESSION['cart']);
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Invalid index'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Index not set'));
}
?>
