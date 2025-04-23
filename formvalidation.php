<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gradient-to-r from-blue-100 to-purple-200 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Sign up</h2>

      <form id="signupForm" action="signup.php" method="POST" class="space-y-4" onsubmit="return validateForm(event)">
        <div>
          <label class="block mb-1 font-medium text-gray-700" for="name">Name</label>
          <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
          <span id="blank_name" class="text-sm text-red-600"></span>
        </div>

        <div>
          <label class="block mb-1 font-medium text-gray-700" for="email">Email</label>
          <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
          <span id="blank_email" class="text-sm text-red-600"></span>
        </div>

        <div>
          <label class="block mb-1 font-medium text-gray-700" for="password">Password</label>
          <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
          <span id="blank_password" class="text-sm text-red-600"></span>
        </div>

        <div class="flex items-center">
          <input type="checkbox" id="terms" name="terms" class="mr-2" />
          <label for="terms" class="text-gray-700 text-sm">I agree to all terms and conditions</label>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">Register</button>
      </form>

      <div id="successMessage" class="hidden text-center text-green-700 font-semibold mt-6">
        ✅ Form submitted successfully!
      </div>

      <script>
        function validateForm(event) {
          const name = document.getElementById("name").value.trim();
          const email = document.getElementById("email").value.trim();
          const password = document.getElementById("password").value.trim();

          const nameError = document.getElementById("blank_name");
          const emailError = document.getElementById("blank_email");
          const passwordError = document.getElementById("blank_password");

          nameError.textContent = emailError.textContent = passwordError.textContent = "";

          let isValid = true;

          if (!name) {
            nameError.textContent = "Please enter name";
            isValid = false;
          }

          if (!email) {
            emailError.textContent = "Please enter email";
            isValid = false;
          }

          if (!password) {
            passwordError.textContent = "Please enter password";
            isValid = false;
          }

          return isValid;
        }
      </script>
    </div>
  </body>
</html>

<!-- PHP: signup.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!$name || !$email || !$password) {
        echo "<script>alert('All fields are required.'); history.back();</script>";
        exit;
    }

    // In production, always hash passwords before storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Replace this with actual DB logic
    // Example: Save to DB (this part is simplified)
    // $conn = new mysqli("localhost", "username", "password", "database");
    // $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    // $stmt->bind_param("sss", $name, $email, $hashedPassword);
    // $stmt->execute();

    echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
}
?>
