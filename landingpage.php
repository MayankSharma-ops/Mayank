<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restaurant Inventory Management</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
  </head>

  <body class="font-sans text-gray-800">
    <header
      class="bg-blue-900 text-white py-6 px-8 flex justify-between items-center"
    >
      <div class="text-2xl font-bold">RestroStock</div>
      <nav class="space-x-8">
        <a href="#features" class="hover:text-yellow-400">Features</a>
               <a
  href="https://mail.google.com/mail/?view=cm&fs=1&to=restro@gmail.com"
  target="_blank"
  class="hover:text-yellow-400">Contact</a>
        <button
          href="loginpage.html"
          class="bg-yellow-400 text-blue-900 font-semibold px-4 py-2 rounded hover:bg-yellow-300"
          onclick="window.location.href='signup.html'"
          >Sign In
        </button>
      </nav>
    </header>

    <section
      class="bg-gradient-to-br from-blue-900 to-blue-700 text-white text-center py-24 px-4"
    >
      <h1 class="text-4xl md:text-6xl font-bold mb-6">
        Smart Inventory Management for Restaurants
      </h1>
      <p class="max-w-2xl mx-auto text-lg mb-8">
        Streamline your kitchen operations, reduce waste, and optimize food
        costs with our intelligent inventory platform built for modern
        restaurants.
      </p>
    <button
  class="bg-yellow-400 text-blue-900 font-semibold px-6 py-3 rounded-lg hover:bg-yellow-300"
  onclick="window.location.href='project2.html'"
>
  Get Started Free
</button>
    </section>

    <section id="features" class="bg-gray-100 py-20 px-6 md:px-16">
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
        <div class="bg-white p-6 rounded-2xl shadow-md">
          <h3 class="text-xl font-semibold mb-2">Real-time Stock Tracking</h3>
          <p>
            Monitor your stock levels live and receive low-stock alerts to
            ensure you never run out of essential ingredients.
          </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md">
          <h3 class="text-xl font-semibold mb-2">Supplier Management</h3>
          <p>
            Keep all your vendor details organized in one place, and manage
            purchases and restocks efficiently.
          </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md">
          <h3 class="text-xl font-semibold mb-2">Recipe Costing</h3>
          <p>
            Understand your food costs by tracking ingredient usage and pricing
            for every menu item.
          </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-md">
          <h3 class="text-xl font-semibold mb-2">Reports & Analytics</h3>
          <p>
            Gain insights into stock movement, wastage, and expenses with
            powerful dashboards and downloadable reports.
          </p>
        </div>
      </div>
    </section>

    <footer class="bg-blue-900 text-white text-center py-6">
      <p>&copy; 2025 RestroStock. All rights reserved.</p>
    </footer>
  </body>
</html>
