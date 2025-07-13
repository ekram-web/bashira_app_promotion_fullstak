@extends('admin.layouts.app')

@section('content')
    <div class="mt-10 mb-6 px-6 w-full">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Reviews</h1>
            <a href="{{ route('admin.reviews.create') }}"
               class="inline-block px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition font-semibold">
                Add New Review
            </a>
        </div>
        <div class="overflow-x-auto rounded-lg shadow bg-white p-6 mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Profile</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Text</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($reviews as $review)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 align-top">
                                @if($review->image)
                                    <img src="{{ asset('storage/' . $review->image) }}" alt="Profile" class="w-12 h-12 rounded-full shadow border-2 border-blue-200 object-cover" style="object-fit:cover;">
                                @else
                                    <span class="inline-block w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $review->name }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $review->role }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $review->text }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $review->rating }}</td>
                            <td class="px-6 py-4 align-top">
                                @if($review->is_active)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">Available</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">Absent</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                <a href="{{ route('admin.reviews.edit', $review->id) }}" class="inline-flex items-center justify-center mr-2 p-1 rounded hover:bg-blue-100 transition" aria-label="Edit" title="Edit">
                                    <span class="material-icons text-blue-600 text-lg align-middle">edit</span>
                                </a>
                                <div x-data="{ open: false, showAbove: false }" class="inline relative">
                                    <button type="button" @click="
                                        open = true;
                                        $nextTick(() => {
                                            const btn = $el.querySelector('button');
                                            const rect = btn.getBoundingClientRect();
                                            showAbove = (window.innerHeight - rect.bottom) < 220;
                                            // Auto-scroll popover into view if needed
                                            const popover = $el.querySelector('.delete-popover');
                                            if (popover) {
                                                popover.scrollIntoView({ behavior: 'smooth', block: showAbove ? 'end' : 'start' });
                                            }
                                        });
                                    " class="inline-flex items-center justify-center p-1 rounded hover:bg-red-100 transition" aria-label="Delete" title="Delete">
                                        <span class="material-icons text-red-600 text-lg align-middle">delete</span>
                                    </button>
                                    <!-- Smart Popover Modal with Auto-Scroll -->
                                    <div x-show="open" x-cloak :class="showAbove ? 'absolute right-0 bottom-full mb-2' : 'absolute right-0 top-full mt-2'" class="delete-popover bg-white rounded-lg shadow-lg p-4 border border-gray-200 z-50" style="min-width: 260px;">
                                        <h2 class="text-lg font-bold mb-2 text-gray-800">Confirm Delete</h2>
                                        <p class="mb-4 text-gray-600">Are you sure you want to delete this review?</p>
                                        <div class="flex justify-end space-x-2">
                                            <button @click="open = false" type="button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-400">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection 