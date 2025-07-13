@extends('admin.layouts.app')

@section('content')
<div x-data="{ open: false, deleteId: null }">
    <div class="mt-10 mb-6 px-6 w-full">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Contact Messages</h1>
            <form method="GET" action="" class="flex items-center">
                <label for="filter" class="mr-2 text-gray-700">Filter:</label>
                <select name="filter" id="filter" class="border rounded px-2 py-1" onchange="this.form.submit()">
                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="unread" {{ request('filter') == 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('filter') == 'read' ? 'selected' : '' }}>Read</option>
                </select>
            </form>
        </div>
        <div class="overflow-x-auto rounded-lg shadow bg-white p-6 mt-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-50 to-blue-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-extrabold text-blue-900 uppercase tracking-wider whitespace-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($contactMessages as $item)
                        <tr class="hover:bg-blue-50 transition {{ !$item->is_read ? 'font-bold' : '' }}">
                            <td class="px-6 py-4 align-top whitespace-pre-line text-gray-800 text-sm">{{ $item->name }}</td>
                            <td class="px-6 py-4 align-top whitespace-pre-line text-gray-800 text-sm">{{ $item->email }}</td>
                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                @if(!$item->is_read)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded bg-blue-100 text-blue-800"><span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>Unread</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded bg-gray-100 text-gray-600"><span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span>Read</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                <a href="{{ route('admin.contact-messages.show', $item->id) }}" class="inline-flex items-center justify-center mr-2 p-1 rounded hover:bg-blue-100 transition" aria-label="View" title="View">
                                    <span class="material-icons text-blue-600 text-lg align-middle">visibility</span>
                                </a>
                                <div x-data="{ open: false }" class="inline relative">
                                    <button type="button" @click="open = true" class="inline-flex items-center justify-center p-1 rounded hover:bg-red-100 transition" aria-label="Delete" title="Delete">
                                        <span class="material-icons text-red-600 text-lg align-middle">delete</span>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.contact-messages.destroy', $item->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <!-- Inline Popover Modal -->
                                    <div x-show="open" x-cloak class="absolute right-0 top-full mt-2 bg-white rounded-lg shadow-lg p-4 border border-gray-200 z-50" style="min-width: 260px;">
                                        <h2 class="text-lg font-bold mb-2 text-gray-800">Confirm Delete</h2>
                                        <p class="mb-4 text-gray-600">Are you sure you want to delete this message?</p>
                                        <div class="flex justify-end space-x-2">
                                            <button @click="open = false" type="button" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Cancel</button>
                                            <button @click="if({{ $item->id }}) { document.getElementById('delete-form-{{ $item->id }}').submit(); }" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('admin.contact-messages.toggle-read', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center justify-center p-1 rounded hover:bg-yellow-100 transition" aria-label="{{ $item->is_read ? 'Mark as Unread' : 'Mark as Read' }}" title="{{ $item->is_read ? 'Mark as Unread' : 'Mark as Read' }}">
                                        <span class="material-icons {{ $item->is_read ? 'text-yellow-600' : 'text-green-600' }} text-lg align-middle">
                                            {{ $item->is_read ? 'mark_email_unread' : 'mark_email_read' }}
                                        </span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-400">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 