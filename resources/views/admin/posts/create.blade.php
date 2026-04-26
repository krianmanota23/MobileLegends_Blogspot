@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.posts.index') }}" class="text-[#C89B3C] hover:text-[#E8B85C] transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Dashboard
        </a>
        <h1 class="text-3xl font-bold text-[#F5F5F5]">Create New Post</h1>
    </div>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="bg-[#DC2626] bg-opacity-20 border border-[#DC2626] rounded-lg p-4 mb-6">
            <h3 class="text-[#FF6B6B] font-semibold mb-2">Validation Errors:</h3>
            <ul class="list-disc list-inside text-[#FF6B6B] text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-[#111827] border border-[#1F2937] rounded-lg p-8 max-w-3xl mx-auto">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-[#9CA3AF] mb-2">
                    Title <span class="text-[#DC2626]">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter post title"
                    class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition"
                    required
                >
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-sm font-medium text-[#9CA3AF] mb-2">
                    Excerpt <span class="text-[#9CA3AF] text-xs">(Optional)</span>
                </label>
                <textarea 
                    id="excerpt" 
                    name="excerpt"
                    rows="3"
                    placeholder="Enter a brief excerpt"
                    class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition resize-none"
                >{{ old('excerpt') }}</textarea>
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-[#9CA3AF] mb-2">
                    Content <span class="text-[#DC2626]">*</span>
                </label>
                <textarea 
                    id="content" 
                    name="content"
                    rows="10"
                    placeholder="Enter the full post content"
                    class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition resize-none"
                    required
                >{{ old('content') }}</textarea>
            </div>

            <!-- Featured Image -->
            <div>
                <label for="featured_image" class="block text-sm font-medium text-[#9CA3AF] mb-2">
                    Featured Image <span class="text-[#9CA3AF] text-xs">(Optional)</span>
                </label>
                <input 
                    type="file" 
                    id="featured_image" 
                    name="featured_image"
                    accept="image/*"
                    class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded file:bg-[#C89B3C] file:text-[#0A0E1A] file:border-0 file:px-3 file:py-1 file:rounded file:font-semibold focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition"
                >
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-[#9CA3AF] mb-2">
                    Category <span class="text-[#DC2626]">*</span>
                </label>
                <select 
                    id="category" 
                    name="category"
                    class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition"
                    required
                >
                    <option value="">-- Select a category --</option>
                    <option value="General" {{ old('category') === 'General' ? 'selected' : '' }}>General</option>
                    <option value="Hero Guide" {{ old('category') === 'Hero Guide' ? 'selected' : '' }}>Hero Guide</option>
                    <option value="Patch Notes" {{ old('category') === 'Patch Notes' ? 'selected' : '' }}>Patch Notes</option>
                    <option value="Event" {{ old('category') === 'Event' ? 'selected' : '' }}>Event</option>
                    <option value="Tips & Tricks" {{ old('category') === 'Tips & Tricks' ? 'selected' : '' }}>Tips & Tricks</option>
                    <option value="Esports" {{ old('category') === 'Esports' ? 'selected' : '' }}>Esports</option>
                </select>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-[#9CA3AF] mb-2">
                    Status <span class="text-[#DC2626]">*</span>
                </label>
                <select 
                    id="status" 
                    name="status"
                    class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition"
                    required
                >
                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>

            <!-- Author -->
            <div>
                <label for="author" class="block text-sm font-medium text-[#9CA3AF] mb-2">
                    Author <span class="text-[#9CA3AF] text-xs">(Optional)</span>
                </label>
                <input 
                    type="text" 
                    id="author" 
                    name="author"
                    value="{{ old('author') }}"
                    placeholder="ML Admin"
                    class="w-full bg-[#0A0E1A] border border-[#1F2937] text-[#F5F5F5] px-4 py-2 rounded focus:outline-none focus:border-[#C89B3C] focus:ring-1 focus:ring-[#C89B3C] transition"
                >
            </div>

            <!-- Form Actions -->
            <div class="flex gap-4 pt-6">
                <button 
                    type="submit"
                    class="flex-1 bg-[#C89B3C] text-[#0A0E1A] font-semibold py-2 rounded hover:bg-[#E8B85C] transition"
                >
                    Publish Post
                </button>
                <a 
                    href="{{ route('admin.posts.index') }}" 
                    class="flex-1 text-center bg-[#1F2937] text-[#9CA3AF] font-semibold py-2 rounded hover:bg-[#374151] transition"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
