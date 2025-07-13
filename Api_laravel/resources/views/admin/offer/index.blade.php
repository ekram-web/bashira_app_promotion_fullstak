@extends('admin.layouts.app')

@section('content')
    <div class="mt-10 mb-6 px-6 w-full">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Offers</h1>
            <a href="{{ route('admin.offers.create') }}"
               class="inline-block px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition font-semibold">
                Add Offer
            </a>
        </div>
        <div class="overflow-x-auto rounded-lg shadow bg-white p-6 mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Subtitle</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Section Title</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Section Description</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($offers as $offer)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $offer->id }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $offer->title }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $offer->subtitle }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ Str::limit($offer->description, 40) }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ Str::limit($offer->section_title, 30) }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ Str::limit($offer->section_description, 40) }}</td>
                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                <a href="{{ route('admin.offers.edit', $offer->id) }}" class="inline-flex items-center justify-center mr-2 p-1 rounded hover:bg-blue-100 transition" aria-label="Edit" title="Edit">
                                    <span class="material-icons text-blue-600 text-lg align-middle">edit</span>
                                </a>
                                <div x-data="{ open: false, showAbove: false }" class="inline relative">
                                    <button type="button" @click="
                                        open = true;
                                        $nextTick(() => {
                                            const btn = $el.querySelector('button');
                                            const rect = btn.getBoundingClientRect();
                                            showAbove = (window.innerHeight - rect.bottom) < 220;
                                            const popover = $el.querySelector('.delete-popover');
                                            if (popover) {
                                                popover.scrollIntoView({ behavior: 'smooth', block: showAbove ? 'end' : 'start' });
                                            }
                                        });
                                    " class="inline-flex items-center justify-center p-1 rounded hover:bg-red-100 transition" aria-label="Delete" title="Delete">
                                        <span class="material-icons text-red-600 text-lg align-middle">delete</span>
                                    </button>
                                    <div x-show="open" x-cloak :class="showAbove ? 'absolute right-0 bottom-full mb-2' : 'absolute right-0 top-full mt-2'" class="delete-popover bg-white rounded-lg shadow-lg p-4 border border-gray-200 z-50" style="min-width: 260px;">
                                        <h2 class="text-lg font-bold mb-2 text-gray-800">Confirm Delete</h2>
                                        <p class="mb-4 text-gray-600">Are you sure you want to delete this offer?</p>
                                        <div class="flex justify-end space-x-2">
                                            <button @click="open = false" type="button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                                            <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" class="inline">
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