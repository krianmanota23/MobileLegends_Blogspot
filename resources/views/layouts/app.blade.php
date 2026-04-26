<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ML Blogspot')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0A0E1A] text-[#F5F5F5]">
    <!-- Navigation -->
    <nav class="bg-[#0A0E1A] border-b border-[#1F2937] sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo/Brand -->
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-[#C89B3C]">ML Blogspot</span>
                </a>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-[#C89B3C] hover:text-[#F5F5F5]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    @if(session('admin_logged_in'))
                        <a href="{{ route('admin.posts.index') }}" class="text-[#9CA3AF] hover:text-[#C89B3C] transition">
                            Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-[#9CA3AF] hover:text-[#C89B3C] transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-[#C89B3C] text-[#0A0E1A] rounded font-semibold hover:bg-[#E8B85C] transition">
                            Admin Login
                        </a>
                    @endif
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2">
                @if(session('admin_logged_in'))
                    <a href="{{ route('admin.posts.index') }}" class="block text-[#9CA3AF] hover:text-[#C89B3C] transition py-2">
                        Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left text-[#9CA3AF] hover:text-[#C89B3C] transition py-2">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 bg-[#C89B3C] text-[#0A0E1A] rounded font-semibold hover:bg-[#E8B85C] transition">
                        Admin Login
                    </a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#0A0E1A] border-t border-[#1F2937] mt-12 py-6">
        <div class="container mx-auto px-4 text-center text-[#9CA3AF]">
            <p>© 2026 Mobile Legends Blogspot. All rights reserved.</p>
        </div>
    </footer>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
