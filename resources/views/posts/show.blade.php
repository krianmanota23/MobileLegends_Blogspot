@extends('layouts.app')

@section('title', $post->title)

@section('content')
<!-- Featured Image Hero -->
<div class="relative h-96 md:h-[500px] overflow-hidden bg-[#0A0E1A]">
    @if($post->featured_image)
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
    @else
        <div class="w-full h-full bg-gradient-to-r from-[#0A0E1A] to-[#111827] flex items-center justify-center">
            <span class="text-[#9CA3AF]">Featured Image</span>
        </div>
    @endif
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-[#0A0E1A] via-transparent to-transparent"></div>

    <!-- Title Overlay -->
    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12">
        <div class="container mx-auto px-4">
            <span class="inline-block bg-[#C89B3C] text-[#0A0E1A] text-sm font-semibold px-3 py-1 rounded mb-4">
                {{ $post->category }}
            </span>
            <h1 class="text-3xl md:text-5xl font-bold text-[#F5F5F5] mb-4">{{ $post->title }}</h1>
            <div class="flex flex-col md:flex-row md:items-center gap-4 text-[#9CA3AF]">
                <span>By {{ $post->author }}</span>
                <span>•</span>
                <span>{{ $post->published_at->format('F d, Y') }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Post Content -->
<div class="bg-[#0A0E1A] py-12 md:py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Main Content -->
            <div class="bg-[#111827] rounded-lg p-8 md:p-12 border border-[#1F2937] mb-8">
                <div class="prose prose-invert max-w-none text-[#F5F5F5]">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Back Link -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-[#C89B3C] hover:text-[#E8B85C] transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Homepage
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
