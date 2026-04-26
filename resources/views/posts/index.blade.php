@extends('layouts.app')

@section('title', 'Mobile Legends Blogspot')

@section('content')
<!-- Hero Banner -->
<div class="bg-gradient-to-r from-[#0A0E1A] via-[#111827] to-[#0A0E1A] py-16 md:py-24 border-b border-[#1F2937]">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-[#C89B3C] mb-4">Mobile Legends Blogspot</h1>
        <p class="text-xl text-[#9CA3AF]">Your #1 source for ML news, guides, and updates</p>
    </div>
</div>

<!-- Posts Grid -->
<div class="container mx-auto px-4 py-12">
    @forelse($posts as $post)
        @if($loop->first)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @endif

        <!-- Post Card -->
        <div class="bg-[#111827] rounded-lg overflow-hidden border border-[#1F2937] hover:border-[#C89B3C] transition duration-300 h-full flex flex-col">
            <!-- Featured Image -->
            @if($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-[#0A0E1A] flex items-center justify-center">
                    <span class="text-[#9CA3AF]">No Image</span>
                </div>
            @endif

            <!-- Card Content -->
            <div class="p-6 flex flex-col flex-grow">
                <!-- Category Badge -->
                <span class="inline-block bg-[#C89B3C] text-[#0A0E1A] text-xs font-semibold px-3 py-1 rounded mb-3 w-fit">
                    {{ $post->category }}
                </span>

                <!-- Title -->
                <h2 class="text-xl font-bold text-[#F5F5F5] mb-3">{{ $post->title }}</h2>

                <!-- Excerpt -->
                <p class="text-[#9CA3AF] text-sm mb-4 flex-grow">
                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
                </p>

                <!-- Date -->
                <p class="text-[#9CA3AF] text-xs mb-4">
                    {{ $post->published_at->format('M d, Y') }}
                </p>

                <!-- Read More Button -->
                <a href="{{ route('posts.show', $post->slug) }}" class="inline-block bg-[#C89B3C] text-[#0A0E1A] px-4 py-2 rounded font-semibold hover:bg-[#E8B85C] transition">
                    Read More →
                </a>
            </div>
        </div>

        @if($loop->last)
            </div>
        @endif
    @empty
        <div class="text-center py-16">
            <p class="text-[#9CA3AF] text-lg">No posts yet. Check back soon!</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($posts->hasPages())
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-center">
            {{ $posts->links('pagination::tailwind') }}
        </div>
    </div>
@endif
@endsection
