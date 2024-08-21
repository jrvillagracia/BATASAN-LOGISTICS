<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Batasan Hills National High School</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/main_index.css')}}">
  <!-- @vite('resources/css/app.css') -->
</head>

<body class="m-0">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="aside fixed top-0 bottom-0 lg:right-0 w-[300px]">
            <div class="w-full h-full  p-8 flex flex-col items-center justify-center">
                <div class="w-45 h-45 rounded-full flex items-center justify-center mb-8">
                    <img src="{{asset('img/logo.png')}}" alt="Logo" class="w-full h-full object-cover" />
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Welcome!</h1>
                <p class="mt-5 mb-5 text-white">Please click or tap your destination.</p>
                <a href="#" class="w-full bg-blue-500 text-white py-2 px-4 rounded text-center mb-4 hover:bg-blue-600">Student</a>
                <a href="{{ route('employee_login') }}" class="w-full bg-red-500 text-white py-2 px-4 rounded text-center mb-4 hover:bg-red-600">Employee</a>

                <div class="text-center mb-4">
                    <a href="{{ route('register') }}" class="text-blue-500 hover:underline block">Register an account</a>
                </div>
                <p class="text-center text-white text-sm mt-4">
                    By using this service, you understand and agree to the Terms and Conditions of the system.
                </p>
            </div>
        </div>
    </div>
</html>