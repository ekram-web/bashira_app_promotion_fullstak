@extends('admin.layouts.app')

@section('content')
    <div class="mt-10 mb-6 px-6 w-full">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Promotions</h1>
            <a href="{{ route('admin.promotion.create') }}"
               class="inline-block px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition font-semibold">
                Add New Promotion
            </a>
        </div>
        <div class="overflow-x-auto rounded-lg shadow bg-white p-6 mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">QR Code</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Phone Image</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Subtitle</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">App Store URL</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Play Store URL</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($promotions as $promotion)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-6 py-4 align-top">
                                @if($promotion->qr_code_image)
                                    <img src="{{ asset('storage/' . $promotion->qr_code_image) }}" alt="QR Code" class="w-16 h-16 object-cover rounded shadow border border-gray-200">
                                @else
                                    <span class="inline-block w-16 h-16 bg-gray-100 text-gray-400 flex items-center justify-center rounded">No Image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top">
                                @if($promotion->phone_image)
                                    <img src="{{ asset('storage/' . $promotion->phone_image) }}" alt="Phone Image" class="w-16 h-16 object-cover rounded shadow border border-gray-200">
                                @else
                                    <span class="inline-block w-16 h-16 bg-gray-100 text-gray-400 flex items-center justify-center rounded">No Image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $promotion->title }}</td>
                            <td class="px-6 py-4 align-top text-gray-800 text-sm">{{ $promotion->subtitle }}</td>
                            <td class="px-6 py-4 align-top text-blue-700 text-xs underline break-all"><a href="{{ $promotion->app_store_url }}" target="_blank">{{ Str::limit($promotion->app_store_url, 30) }}</a></td>
                            <td class="px-6 py-4 align-top text-blue-700 text-xs underline break-all"><a href="{{ $promotion->play_store_url }}" target="_blank">{{ Str::limit($promotion->play_store_url, 30) }}</a></td>
                            <td class="px-6 py-4 align-top">
                                @if($promotion->is_active)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded">Active</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                <a href="{{ route('admin.promotion.edit', $promotion->id) }}" class="inline-flex items-center justify-center mr-2 p-1 rounded hover:bg-blue-100 transition" aria-label="Edit" title="Edit">
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
                                        <p class="mb-4 text-gray-600">Are you sure you want to delete this promotion?</p>
                                        <div class="flex justify-end space-x-2">
                                            <button @click="open = false" type="button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                                            <form action="{{ route('admin.promotion.destroy', $promotion->id) }}" method="POST" class="inline">
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
                            <td colspan="8" class="px-6 py-4 text-center text-gray-400">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection 