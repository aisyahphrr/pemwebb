@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-800 text-center">Tim Pengembang</h1>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Anggota Tim 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="aspect-w-1 aspect-h-1">
                    <img src="{{ asset('images/aisyah.jpg') }}" alt="Foto Aisyah Putri Harmelia" 
                         class="w-full h-64 object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Aisyah Putri Harmelia</h3>
                    <p class="text-gray-600">NIM: J0404231048</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="https://wa.me/+6287805987309" class="text-green-500 hover:text-green-700">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://instagram.com/aisyahphr" class="text-pink-500 hover:text-pink-700">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>

            <!-- Anggota Tim 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="aspect-w-1 aspect-h-1">
                    <img src="{{ asset('images/gesit.jpg') }}" alt="Foto Gesit Tri Nugroho" 
                         class="w-full h-64 object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Gesit Tri Nugroho</h3>
                    <p class="text-gray-600">NIM: J0404231025</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="https://wa.me/qr/MLAYFPVAKS7TC1 " class="text-green-500 hover:text-green-700">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://instagram.com/gsittri" class="text-pink-500 hover:text-pink-700">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>

            <!-- Anggota Tim 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="aspect-w-1 aspect-h-1">
                    <img src="{{ asset('images/jon.jpg') }}" alt="Foto Lim Sony" 
                         class="w-full h-64 object-cover">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Michael Lim Sony Wijaya</h3>
                    <p class="text-gray-600">NIM: J0404231152</p>
                    <div class="mt-4 flex space-x-3">
                        <a href="wa.me/+6281386501217 " class="text-green-500 hover:text-green-700">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://instagram.com/michaellimwijaya_" class="text-pink-500 hover:text-pink-700">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi Tim -->
        <div class="mt-12 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold mb-4 text-gray-700">Tentang Tim Kami</h2>
            <p class="text-gray-600">
                Kami adalah tim mahasiswa yang berkolaborasi dalam pengembangan aplikasi web menggunakan Laravel.
                Setiap anggota tim membawa keahlian unik yang berkontribusi pada keberhasilan proyek ini.
            </p>
        </div>
    </div>
</div>

<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection 