<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="bg-gray-800 w-64 min-h-screen flex flex-col">
            <div class="bg-gray-900 text-white p-4">
                <h2 class="text-xl font-bold">Dashboard</h2>
            </div>
            <nav class="flex-grow p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center text-white p-2 hover:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-white p-2 hover:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-white p-2 hover:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center text-white p-2 hover:bg-gray-700 rounded-lg">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Reports
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Bar -->
            <header class="bg-white shadow-lg p-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <input type="text" placeholder="Search..." class="px-4 py-2 border rounded-lg">
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Language Switch -->
                        <a href="/dashboard" class="p-2 hover:bg-gray-100 rounded-lg flex items-center">
                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                            </svg>
                            <span>العربية</span>
                        </a>
                        <button class="p-2 hover:bg-gray-100 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                        </button>
                        <div class="relative">
                            <button class="flex items-center space-x-2">
                                <img src="https://ui-avatars.com/api/?name=Admin" alt="Admin" class="w-8 h-8 rounded-full">
                                <span>Admin</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-gray-500 text-sm">Total Sales</h3>
                        <p class="text-2xl font-bold">$12,500</p>
                        <span class="text-green-500 text-sm">+25%</span>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-gray-500 text-sm">New Users</h3>
                        <p class="text-2xl font-bold">120</p>
                        <span class="text-green-500 text-sm">+10%</span>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-gray-500 text-sm">Orders</h3>
                        <p class="text-2xl font-bold">85</p>
                        <span class="text-red-500 text-sm">-5%</span>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-gray-500 text-sm">Products</h3>
                        <p class="text-2xl font-bold">250</p>
                        <span class="text-green-500 text-sm">+15%</span>
                    </div>
                </div>

                <!-- Recent Orders Table -->
                <div class="bg-white rounded-lg shadow-md">
                    <div class="p-4 border-b">
                        <h2 class="text-xl font-bold">Recent Orders</h2>
                    </div>
                    <div class="p-4">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="p-2 text-left">Order ID</th>
                                    <th class="p-2 text-left">Customer</th>
                                    <th class="p-2 text-left">Product</th>
                                    <th class="p-2 text-left">Price</th>
                                    <th class="p-2 text-left">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-t">
                                    <td class="p-2">#1234</td>
                                    <td class="p-2">John Doe</td>
                                    <td class="p-2">Product 1</td>
                                    <td class="p-2">$500</td>
                                    <td class="p-2"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Completed</span></td>
                                </tr>
                                <tr class="border-t">
                                    <td class="p-2">#1235</td>
                                    <td class="p-2">Sarah Smith</td>
                                    <td class="p-2">Product 2</td>
                                    <td class="p-2">$750</td>
                                    <td class="p-2"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-sm">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html> 
