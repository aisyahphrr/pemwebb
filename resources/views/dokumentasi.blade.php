@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-gray-50">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-blue-800 mb-8">Dokumentasi Komponen</h1>

        <!-- Baris 1 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Breadboard -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/breadboard.jpg') }}" alt="Breadboard" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Breadboard</h3>
                    <p class="text-gray-600 text-sm">
                        Papan untuk merangkai komponen elektronik tanpa perlu menyolder
                    </p>
                </div>
            </div>

            <!-- Kabel Jumper -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/jumper.jpg') }}" alt="Kabel Jumper" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Kabel Jumper</h3>
                    <p class="text-gray-600 text-sm">
                        Kabel untuk menghubungkan antar komponen elektronik
                    </p>
                </div>
            </div>

            <!-- Sensor Ultrasonik -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/ultrasonic.jpg') }}" alt="Sensor Ultrasonik" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Sensor Ultrasonik</h3>
                    <p class="text-gray-600 text-sm">
                        Sensor untuk mengukur ketinggian air menggunakan gelombang ultrasonik
                    </p>
                </div>
            </div>
        </div>

        <!-- Baris 2 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- ESP8266 -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/esp8266.jpeg') }}" alt="ESP8266" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">ESP8266</h3>
                    <p class="text-gray-600 text-sm">
                        Mikrokontroler dengan modul WiFi untuk mengirim data ke Firebase
                    </p>
                </div>
            </div>

            <!-- Powerbank -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/powerbank.jpg') }}" alt="Powerbank" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Powerbank</h3>
                    <p class="text-gray-600 text-sm">
                        Sumber daya portabel untuk menjalankan sistem
                    </p>
                </div>
            </div>

            <!-- Kabel ESP -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/biru.jpg') }}" alt="Kabel ESP" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Kabel ESP</h3>
                    <p class="text-gray-600 text-sm">
                        Kabel untuk memprogram ESP8266 dan power supply
                    </p>
                </div>
            </div>
        </div>

        <!-- Baris 3 -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Firebase -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/firebase.png') }}" alt="Firebase" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Firebase</h3>
                    <p class="text-gray-600 text-sm">
                        Database realtime untuk menyimpan data ketinggian air
                    </p>
                </div>
            </div>

            <!-- Arduino IDE -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/arduino.png') }}" alt="Arduino IDE" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Arduino IDE</h3>
                    <p class="text-gray-600 text-sm">
                        Software untuk memprogram ESP8266
                    </p>
                </div>
            </div>

            <!-- Laravel -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/docs/laravel.png') }}" alt="Laravel" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-blue-800 mb-2">Laravel</h3>
                    <p class="text-gray-600 text-sm">
                        Framework untuk membuat web application monitoring
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection 