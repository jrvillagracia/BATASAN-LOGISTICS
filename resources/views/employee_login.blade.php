<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BHNHS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/main_index.css')}}">
    <!-- @vite('resources/css/app.css') -->
</head>

<body class="m-0">
    <div class="aside fixed top-0 bottom-0 items-center justify-center lg:right-0 w-[300px]">
        <!-- Logo -->
        <div class="w-full h-full  p-8 flex flex-col items-center justify-center">
            <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center mb-8">
                <span class="text-gray-500 text-2xl">LOGO</span>
            </div>
            <!-- Title -->
            <h2 class="text-2xl font-bold mb-6 text-center text-white">Log Into Your Account</h2>

            <!-- Form -->
            <form class="w-full">
                <!-- Staff ID -->
                <div class="mb-4 py-2">
                    <label class="block text-white text-sm font-semibold mb-2" for="employee_id">Employee ID</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" id="employee_id" type="text" placeholder="Employee ID" required autofocus>
                </div>
                <div class="mb-0">
                    <label class="block text-white text-sm font-semibold mb-2" for="password">Password</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" id="password" type="password" placeholder="Password" required autofocus>
                </div>
                <div class="flex items-end mb-6 py-0">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 text-blue-500 focus:ring-blue-400 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 text-sm  text-white">Remember Me</label>
                    <div class="ml-auto">
                        <a href="#" class="text-sm text-white hover:underline">Forgot Password?</a>
                    </div>
                </div>
                <div class="mb-8">
                    <a href="{{ route('admin_dashboard') }}" class="w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Log In
                    </a>
                </div>
                <!-- Terms and Conditions -->
                <p class="text-center text-white text-sm mt-4">
                    By using this service, you understand and agree to the Terms and Conditions of the system.
                </p>
            </form>
        </div>
    </div>
</body>

</html>