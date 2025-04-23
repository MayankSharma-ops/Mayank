<?php
// Error reporting to see any issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("connection.php");

if (isset($_POST['register'])) {
    $name  = $_POST["name"];
    $email = $_POST["email"];
    $pass  = $_POST["password"];

    // Dummy hardcoded credentialsa
    $validname  = "Sourodip Dey";
    $validemail = "sourodipdey19@gmail.com";
     $validpass  = "Sd@13";

    if ($name === $validname && $email === $validemail && $pass === $validpass) {
        // Optional: insert into DB
        $query = "INSERT INTO user_data VALUES ('$name', '$email', '$pass')";
        mysqli_query($conn, $query);

        // Redirect
        header("Location: project2.html");
        exit();
    } else {
        $errorMsg = "Invalid login credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Form</title>
  </head>
  <body class="bg-gradient-to-r from-blue-100 to-purple-200 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

      <?php if (!empty($errorMsg)): ?>
        <div class="text-red-600 text-center mb-4 font-semibold"><?= $errorMsg ?></div>
      <?php endif; ?>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block mb-1 font-medium text-gray-700" for="name">Name</label>
          <input type="text" id="name" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div>
          <label class="block mb-1 font-medium text-gray-700" for="email">Email</label>
          <input type="email" id="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div>
          <label class="block mb-1 font-medium text-gray-700" for="password">Password</label>
          <input type="password" id="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
        </div>

        <div class="flex items-center">
          <input type="checkbox" id="terms" name="terms" class="mr-2" required />
          <label for="terms" class="text-gray-700 text-sm">I agree to all terms and conditions</label>
        </div>

        <button type="submit" name="register" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
          Register
        </button>
      </form>
    </div>
  </body>
</html>
