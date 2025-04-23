<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data is sent via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if name and role fields exist
    if (isset($_POST['name']) && isset($_POST['role'])) {
        $name = $conn->real_escape_string($_POST['name']);
        $role = $conn->real_escape_string($_POST['role']);

        $sql = "INSERT INTO suppliers (name, role) VALUES ('$name', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Supplier added successfully!'); window.location.href='supliers.php';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid input data!";
    }
} else {
    echo "Invalid request method!";
}

$conn->close();
?>
