<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elmwood Elementary School</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/main_index.css')}}">
    <!-- @vite('resources/css/app.css') -->
</head>

<body class="m-0">
    <div class="fixed top-0 bottom-0 items-center justify-center lg:right-0 w-[300px] bg-white">
        <!-- Logo -->
        <div class="w-full h-full bg-gray-50 p-8 flex flex-col items-center justify-center">
            <div class="w-24 h-24 bg-gray-300 rounded-full flex items-center justify-center mb-8">
                <span class="text-gray-500 text-2xl">LOGO</span>
            </div>
            <!-- Title -->
            <h2 class="text-2xl font-bold mb-6 text-center">Register Account</h2>

            <!-- Form -->
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form class="w-full" action="{{ route('register.post') }}" method="POST">
                @csrf
                <!-- Staff ID -->
                <div class="mb-4 py-2">
                    <label class="block text-gray-600 text-sm font-semibold mb-2" for="employee_id">Employee ID</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" id="employee_id" name="employee_id" type="text" placeholder="Employee ID" required autofocus>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-600 text-sm font-semibold mb-2" for="email">Email</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" id="email" name="email" type="email" placeholder="Enter your Email" required autofocus>
                </div>
                <div class="mb-8">
                    <label class="block text-gray-600 text-sm font-semibold mb-2" for="password">Password</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" id="password" name="password" type="password" placeholder="Password" required autofocus>
                </div>
                <div class="mb-8">
                    <button type="submit" class="w-full block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Register
                    </a>
                </div>
                <!-- Terms and Conditions -->
                <p class="text-center text-gray-600 text-sm mt-4">
                    By using this service, you understand and agree to the Terms and Conditions of the system.
                </p>
            </form>
        </div>
    </div>
</body>

</html>