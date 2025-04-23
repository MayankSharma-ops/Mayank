<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, role FROM suppliers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
          <img src="https://emojicdn.elk.sh/🥰" alt="Supplier" class="w-16 h-16 mx-auto mb-4"/>
          <h3 class="text-xl font-semibold">' . htmlspecialchars($row["name"]) . '</h3>
          <p class="text-blue-600 font-medium">' . htmlspecialchars($row["role"]) . '</p>
        </div>';
    }
} else {
    echo "<p class='col-span-full text-center text-gray-600'>No suppliers found.</p>";
}

$conn->close();
?>
