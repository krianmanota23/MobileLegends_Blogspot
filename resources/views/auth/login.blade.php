@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12" style="background: linear-gradient(135deg, #0A0E1A 0%, #111827 100%);">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-[#111827] rounded-lg border border-[#C89B3C] border-opacity-30 p-8 shadow-2xl">
            <!-- Heading -->
            <h1 class="text-3xl font-bold text-[#C89B3C] text-center mb-2">Admin Portal</h1>
            <p class="text-[#9CA3AF] text-center mb-8">Enter your credentials to access the dashboard</p>

            <!-- Display Validation Errors -->
            @if($errors->any())
                <div class="bg-[#DC2626] bg-opacity-20 border border-[#DC2626] text-[#FF6B6B] px-4 py-3 rounded mb-6 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Display Success Message -->
            @if(session('success'))
                <div class="bg-[#0D9488] bg-opacity-20 border border-[#0D9488] text-[#5EEAD4] px-4 py-3 rounded mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-medium text-[#9CA3AF] mb-2">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username"
                        placeholder="Enter your username"
                        value="{{ old('username') }}"
                        class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition"
                        required
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#9CA3AF] mb-2">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="Enter your password"
                        class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition"
                        required
                    >
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-[#C89B3C] text-[#0A0E1A] font-semibold py-2 rounded hover:bg-[#E8B85C] transition duration-200"
                >
                    Login
                </button>
            </form>

            <!-- Footer Note -->
            <p class="text-center text-[#9CA3AF] text-xs mt-6">
                Demo: mladmin / mobilelegends2026
            </p>
        </div>
    </div>
</div>
@endsection
