<?php
include('../admin/db.php');

// Hàm để làm sạch và kiểm tra đầu vào
function sanitize_input($input) {
    global $con;
    return $con->real_escape_string(trim($input));
}

// Hàm thêm khách hàng mới
function addCustomer($username, $email, $phone_number, $address, $login_id) {
    global $con;
    $username = sanitize_input($username);
    $email = sanitize_input($email);
    $phone_number = sanitize_input($phone_number);
    $address = sanitize_input($address);
    $login_id = (int)$login_id; // Đảm bảo rằng login_id là một số nguyên

    $stmt = $con->prepare("INSERT INTO Customer (username, email, phone_number, address, login_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $username, $email, $phone_number, $address, $login_id);

    if ($stmt->execute() === TRUE) {
        return true;
    } else {
        return "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Hàm cập nhật thông tin khách hàng
function updateCustomer($id, $username, $email, $phone_number, $address, $login_id) {
    global $con;
    $id = (int)$id;
    $username = sanitize_input($username);
    $email = sanitize_input($email);
    $phone_number = sanitize_input($phone_number);
    $address = sanitize_input($address);
    $login_id = (int)$login_id; // Đảm bảo rằng login_id là một số nguyên

    $stmt = $con->prepare("UPDATE Customer SET username=?, email=?, phone_number=?, address=?, login_id=? WHERE id_User=?");
    $stmt->bind_param("ssssii", $username, $email, $phone_number, $address, $login_id, $id);

    if ($stmt->execute() === TRUE) {
        return true;
    } else {
        return "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Hàm xóa khách hàng
function deleteCustomer($delete_id) {
    global $con;
    $delete_id = (int)$delete_id;

    $stmt = $con->prepare("DELETE FROM Customer WHERE id_User=?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute() === TRUE) {
        return true;
    } else {
        return "Lỗi: " . $stmt->error;
    }

    $stmt->close();
}

// Hàm lấy danh sách khách hàng
function getCustomer() {
    global $con;
    $customers = array();

    $sql = "SELECT * FROM Customer";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }

    return $customers;
}

// Hàm lấy thông tin khách hàng theo ID
function getCustomerById($id) {
    global $con;
    $id = (int)$id;

    $sql = "SELECT * FROM Customer WHERE id_User=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}
?>
