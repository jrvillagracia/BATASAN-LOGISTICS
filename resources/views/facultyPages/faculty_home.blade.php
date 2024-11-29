<!-- resources/views/facultyPages/faculty_home.blade.php -->
@extends('facultyLayouts.layout')

@section('title', 'Dashboard')

@section('content')
<!-- User Greeting -->
<section class="bg-white p-4 shadow rounded">
    <h2 class="text-lg font-semibold">Hello, Sir. Jersom Tumacder</h2>
</section>

<!-- Dashboard Table -->
<section class="bg-white p-6 mt-6 shadow rounded">
    <div class="grid grid-cols-3 gap-4 mt-8 pb-8">
        <!-- Card 1 -->
        <div class="block max-w-screen-md p-6 bg-white border border-gray-200 rounded-lg shadow transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img class="w-full" src="{{asset('img/facility.jpg')}}" alt="Facility">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">School Facility Analytics</div>
                <p class="text-gray-700 text-base">
                    Look up at the night sky, and find yourself <span class="font-semibold">immersed</span> in the amazing mountain range of Aspen.
                </p>
            </div>
            <div class="px-6 py-4 flex justify-end">
                <button class="bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded hover:bg-blue-200 transition duration-300">
                    Explore →
                </button>
            </div>
        </div>


        <!-- Card 2 -->
        <div class="block max-w-screen-md p-6 bg-white border border-gray-200 rounded-lg shadow transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img class="w-full" src="{{asset('img/eventactivities.jpg')}}" alt="Facility">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Event and Activities</div>
                <p class="text-gray-700 text-base">
                    Look up at the night sky, and find yourself <span class="font-semibold">immersed</span> in the amazing mountain range of Aspen.
                </p>
            </div>
            <div class="px-6 py-4 flex justify-end">
                <button class="bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded hover:bg-blue-200 transition duration-300">
                    Explore →
                </button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="block max-w-screen-md p-6 bg-white border border-gray-200 rounded-lg shadow transform transition duration-300 hover:scale-105 hover:shadow-2xl">
            <img class="w-full" src="{{asset('img/inventory.jpg')}}" alt="Facility">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Inventory</div>
                <p class="text-gray-700 text-base">
                    Look up at the night sky, and find yourself <span class="font-semibold">immersed</span> in the amazing mountain range of Aspen.
                </p>
            </div>
            <div class="px-6 py-4 flex justify-end">
                <button class="bg-blue-100 text-blue-700 font-semibold py-2 px-4 rounded hover:bg-blue-200 transition duration-300">
                    Explore →
                </button>
            </div>
        </div>
    </div>

</section>
@endsection