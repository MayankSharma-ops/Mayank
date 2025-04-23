<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Suppliers</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-blue-50 text-blue-950 min-h-screen font-sans">
    <div class="text-center py-10">
      <h1 class="text-4xl font-bold mb-2">Meet Our Suppliers</h1>
      <p class="text-lg text-blue-700">
        A group of trusted partners powering our business.
      </p>
    </div>

   <!-- Supplier List Section -->
<div class="max-w-6xl mx-auto mt-10 px-4">
  <h2 class="text-2xl font-semibold text-center text-blue-800 mb-6">Current Suppliers</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php include 'fetch_suppliers.php'; ?>
  </div>
</div>


    <!-- Form Section -->
    <div class="max-w-xl mx-auto mt-12 bg-white rounded-lg shadow-md p-6">
      <h2 class="text-2xl font-semibold mb-4 text-center">
        Add a New Supplier
      </h2>
      <form action="add_supplier.php" method="POST" class="space-y-4">
        <input
          type="text"
          name="name"
          placeholder="Supplier Name"
          class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400"
          required
        />
        <input
          type="text"
          name="role"
          placeholder="Supplier Role (e.g., Raw Material, Equipment)"
          class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-400"
          required
        />
        <input
          type="submit"
          value="Add Supplier"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded cursor-pointer"
        />
      </form>
    </div>
  </body>
</html>
