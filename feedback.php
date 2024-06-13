<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chickengang";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Feedback Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 800px;
        margin: auto;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        color: #333;
    }
    form {
        margin-bottom: 30px;
    }
    form input, form textarea {
        width: 100%;
        padding: 10px;
        margin: 5px 0 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    form button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    form button:hover {
        background-color: #45a049;
    }
    .feedback {
        background: #f9f9f9;
        margin-bottom: 20px;
        padding: 15px;
        border-left: 5px solid #4CAF50;
        border-radius: 4px;
    }
    .feedback p {
        margin: 5px 0;
    }
    .feedback p strong {
        color: #333;
    }
    .feedback p.date {
        color: #aaa;
        font-size: 0.9em;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Feedback Form</h2>
    <form action="feedback.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>
        <button type="submit">Submit Feedback</button>
    </form>

    <?php
    include 'db.php';

    // Handle feedback form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
            $name = $conn->real_escape_string($_POST['name']);
            $email = $conn->real_escape_string($_POST['email']);
            $message = $conn->real_escape_string($_POST['message']);

            $sql = "INSERT INTO Feedback1 (name, email, message) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $message);

            if ($stmt->execute()) {
                echo "<p>Feedback submitted successfully</p>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Please fill out all fields.";
        }
    }

    // Retrieve feedbacks
    $sql = "SELECT name, email, message, created_at FROM Feedback1 ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Feedbacks</h2>";
        while($row = $result->fetch_assoc()) {
            echo "<div class='feedback'>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($row["name"]) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($row["email"]) . "</p>";
            echo "<p><strong>Message:</strong> " . htmlspecialchars($row["message"]) . "</p>";
            echo "<p class='date'><strong>Date:</strong> " . htmlspecialchars($row["created_at"]) . "</p>";
            echo "</div>";
        }
    } else {
        echo "No feedbacks found.";
    }

    $conn->close();
    ?>
</div>
</body>
</html>
