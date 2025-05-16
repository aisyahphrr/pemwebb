<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok 4 - B1</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom CSS -->
    <style>
        .gradient-background {
            background: linear-gradient(135deg, #EBF4FF 0%, #FFFFFF 50%, #F9FAFB 100%);
        }
        .nav-link {
            @apply px-4 py-2 text-gray-600 hover:text-blue-600 transition duration-300;
        }
        .nav-link.active {
            @apply text-blue-600 font-semibold;
        }
        .card-hover {
            @apply transform transition duration-300 hover:scale-105 hover:shadow-xl;
        }
    </style>
</head>
<body class="gradient-background min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-blue-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto mr-3">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">
                            Kelompok 4 - B1
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-4 items-center">
                        @if(Session::has('logged_in'))
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('dokumentasi') }}" class="nav-link {{ request()->routeIs('dokumentasi') ? 'active' : '' }}">
                                Dokumentasi
                            </a>
                            <a href="{{ route('tentang') }}" class="nav-link {{ request()->routeIs('tentang') ? 'active' : '' }}">
                                Tentang
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right Side -->
                <div class="hidden sm:flex sm:items-center">
                    @if(Session::has('logged_in'))
                        <div class="flex items-center space-x-4">
                            <span class="text-gray-600">{{ Session::get('user')['name'] }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login.form') }}" class="nav-link">Login</a>
                        <a href="{{ route('register.form') }}" class="nav-link">Register</a>
                    @endif
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center sm:hidden">
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-blue-600 hover:bg-blue-50 focus:outline-none">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="hidden mobile-menu sm:hidden border-t border-blue-100">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @if(Session::has('logged_in'))
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600">Dashboard</a>
                    <a href="{{ route('dokumentasi') }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600">Dokumentasi</a>
                    <a href="{{ route('tentang') }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600">Tentang</a>
                    <form method="POST" action="{{ route('logout') }}" class="block px-3 py-2">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-blue-600 w-full text-left">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login.form') }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600">Login</a>
                    <a href="{{ route('register.form') }}" class="block px-3 py-2 text-gray-600 hover:text-blue-600">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-blue-100">
        <div class="max-w-7xl mx-auto py-8 px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">Quick Links</h3>
                    <div class="space-y-2">
                        <a href="{{ route('dashboard') }}" class="block text-gray-600 hover:text-blue-600">Dashboard</a>
                        <a href="{{ route('dokumentasi') }}" class="block text-gray-600 hover:text-blue-600">Dokumentasi</a>
                        <a href="{{ route('tentang') }}" class="block text-gray-600 hover:text-blue-600">Tentang</a>
                    </div>
                </div>

                <!-- Resources -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">Resources</h3>
                    <div class="space-y-2">
                        <a href="#" class="block text-gray-600 hover:text-blue-600">Documentation</a>
                        <a href="#" class="block text-gray-600 hover:text-blue-600">API Reference</a>
                        <a href="#" class="block text-gray-600 hover:text-blue-600">Support</a>
                    </div>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">Contact</h3>
                    <div class="space-y-2 text-gray-600">
                        <p>Email: tekom@gmail.com</p>
                        <p>Phone: (123) 3456</p>
                    </div>
                </div>

                <!-- Social -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-800 mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-600 hover:text-blue-600">
                            <i class="fab fa-github text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">
                            <i class="fab fa-linkedin text-2xl"></i>
                        </a>
                        <a href="#" class="text-gray-600 hover:text-blue-600">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-blue-100 text-center text-gray-600">
                <p>&copy; {{ date('Y') }} Terima Kasih Semuanya!</p>
            </div>
        </div>
    </footer>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Mobile menu JavaScript -->
    <script>
        const btn = document.querySelector('.mobile-menu-button');
        const menu = document.querySelector('.mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html> 