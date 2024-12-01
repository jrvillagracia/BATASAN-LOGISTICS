<!-- resources/views/facultyLayouts/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,500,0,0" />
</head>

<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <header class="bg-blue-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <img src="{{ asset('img/logo.png') }}" alt="School Logo" class="h-10">
                    <h1 class="text-white text-lg font-bold ml-3">Batasan Hills National Highschool</h1>
                </div>
                <div class="flex items-center ml-auto space-x-4 px-4">
                    <button id="notifFacultyBTN" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160ZM480-80q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80Z"/></svg>
                    </button>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-white">Jersom Tumacder</span>
                    <img src="{{ asset('img/profile.png') }}" alt="Profile" class="h-8 w-8 rounded-full">
                </div>
            </div>
        </div>
    </header>

    <!-- Responsive Secondary Navigation Bar -->
    <div class="bg-blue-200 w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Centered Navigation Bar -->
            <nav class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-10 py-4">
                <!-- Menu items will stack vertically on small screens and align horizontally on larger screens -->
                <a href="#" class="block text-center text-black border-b-2 border-black hover:text-gray-900">Dashboard</a>
                <a href="#" class="block text-center text-gray-700 hover:text-gray-900">Events and Activities</a>
                <a href="#" class="block text-center text-gray-700 hover:text-gray-900">Inventory</a>
                <a href="#" class="block text-center text-gray-700 hover:text-gray-900">Repair</a>
                
            </nav>
        </div>
    </div>


    <!-- Main Content Section -->
    <main class="max-w-7xl mx-auto mt-8">
        @yield('content')
    </main>

    <!-- Optional Footer -->
    <footer class="bg-blue-900 text-white text-center py-4 mt-8">
        <p>&copy; 2024 Batasan Hills National Highschool</p>
    </footer>
</body>

</html>