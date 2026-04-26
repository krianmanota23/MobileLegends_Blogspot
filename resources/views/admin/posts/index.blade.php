@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-[#F5F5F5] pb-2 border-b-4 border-[#C89B3C] inline-block">
                Admin Dashboard
            </h1>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="inline-block bg-[#C89B3C] text-[#0A0E1A] px-6 py-2 rounded font-semibold hover:bg-[#E8B85C] transition">
            + New Post
        </a>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-[#0D9488] bg-opacity-20 border border-[#0D9488] text-[#5EEAD4] px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-[#DC2626] bg-opacity-20 border border-[#DC2626] text-[#FF6B6B] px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Posts Table -->
    @if($posts->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-[#1F2937]">
                        <th class="text-left px-4 py-3 text-[#9CA3AF] font-semibold text-sm">#</th>
                        <th class="text-left px-4 py-3 text-[#9CA3AF] font-semibold text-sm">Image</th>
                        <th class="text-left px-4 py-3 text-[#9CA3AF] font-semibold text-sm">Title</th>
                        <th class="text-left px-4 py-3 text-[#9CA3AF] font-semibold text-sm">Category</th>
                        <th class="text-left px-4 py-3 text-[#9CA3AF] font-semibold text-sm">Status</th>
                        <th class="text-left px-4 py-3 text-[#9CA3AF] font-semibold text-sm">Published Date</th>
                        <th class="text-left px-4 py-3 text-[#9CA3AF] font-semibold text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $index => $post)
                        <tr class="border-b border-[#1F2937] hover:bg-[#111827] transition">
                            <td class="px-4 py-4 text-[#F5F5F5]">{{ $loop->iteration }}</td>
                            
                            <td class="px-4 py-4">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-12 h-12 rounded object-cover">
                                @else
                                    <div class="w-12 h-12 rounded bg-[#0A0E1A] flex items-center justify-center text-[#9CA3AF] text-xs">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            
                            <td class="px-4 py-4 text-[#F5F5F5] font-semibold">{{ Str::limit($post->title, 30) }}</td>
                            
                            <td class="px-4 py-4 text-[#9CA3AF]">{{ $post->category }}</td>
                            
                            <td class="px-4 py-4">
                                @if($post->status === 'published')
                                    <span class="inline-block bg-[#0D9488] text-[#ECF0FF] text-xs font-semibold px-3 py-1 rounded">Published</span>
                                @else
                                    <span class="inline-block bg-[#6B7280] text-[#F3F4F6] text-xs font-semibold px-3 py-1 rounded">Draft</span>
                                @endif
                            </td>
                            
                            <td class="px-4 py-4 text-[#9CA3AF] text-sm">
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not published' }}
                            </td>
                            
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="inline-block bg-blue-600 text-white px-3 py-1 text-xs rounded hover:bg-blue-700 transition">
                                        Edit
                                    </a>
                                    
                                    <!-- Delete Form -->
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this post? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-[#DC2626] text-white px-3 py-1 text-xs rounded hover:bg-red-700 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="mt-6">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @endif
    @else
        <div class="bg-[#111827] border border-[#1F2937] rounded-lg p-12 text-center">
            <p class="text-[#9CA3AF] mb-4">No posts yet. Create your first post!</p>
            <a href="{{ route('admin.posts.create') }}" class="inline-block bg-[#C89B3C] text-[#0A0E1A] px-6 py-2 rounded font-semibold hover:bg-[#E8B85C] transition">
                Create First Post
            </a>
        </div>
    @endif
</div>
@endsection
