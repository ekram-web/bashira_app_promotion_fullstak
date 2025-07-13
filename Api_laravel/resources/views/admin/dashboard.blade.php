@extends('admin.layouts.app')

@section('content')
<div class="w-full space-y-6">
    <!-- Page Header -->
    <div class="bg-white dark:bg-[#23294D] rounded-xl shadow p-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
        <p class="mt-1 text-lg text-gray-600 dark:text-gray-300">Welcome to Basirah Institute Admin Panel</p>
    </div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Hero Slides -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-500 dark:bg-blue-600 mb-4">
                <span class="material-icons text-white text-3xl">image</span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_hero_slides'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Hero Slides</div>
        </div>
        <!-- Reviews -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-green-500 dark:bg-green-600 mb-4">
                <span class="material-icons text-white text-3xl">star</span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_reviews'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Reviews</div>
        </div>
        <!-- Messages (Total) -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-yellow-500 dark:bg-yellow-600 mb-4">
                <span class="material-icons text-white text-3xl">sms</span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_messages'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Messages</div>
        </div>
        <!-- Unread Messages -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-blue-500 dark:bg-blue-600 mb-4">
                <span class="material-icons text-white text-3xl">mark_email_unread</span>
            </div>
            <div class="text-3xl font-extrabold text-blue-700 dark:text-blue-400 mb-1">{{ $stats['unread_messages'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Unread Messages</div>
        </div>
        <!-- Read Messages -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-400 dark:bg-gray-500 mb-4">
                <span class="material-icons text-white text-3xl">mark_email_read</span>
            </div>
            <div class="text-3xl font-extrabold text-gray-700 dark:text-gray-100 mb-1">{{ $stats['read_messages'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Read Messages</div>
        </div>
        <!-- Promotions -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-purple-500 dark:bg-purple-600 mb-4">
                <span class="material-icons text-white text-3xl">local_offer</span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_promotions'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Promotions</div>
        </div>
        <!-- Contacts -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-pink-500 dark:bg-pink-600 mb-4">
                <span class="material-icons text-white text-3xl">contacts</span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_contacts'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Contacts</div>
        </div>
        <!-- Users -->
        <div class="bg-white dark:bg-[#23294D] border border-gray-200 dark:border-blue-900/40 rounded-xl shadow dark:shadow-blue-900/20 p-6 flex flex-col items-center transition-colors duration-300">
            <div class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-800 dark:bg-gray-700 mb-4">
                <span class="material-icons text-white text-3xl">people</span>
            </div>
            <div class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 mb-1">{{ $stats['total_users'] }}</div>
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Users</div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Messages -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Messages</h3>
                @if($recent_messages->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_messages as $message)
                            <div class="border-l-4 border-blue-400 pl-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $message->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $message->email }}</p>
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($message->message, 100) }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ !$message->is_read ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }}">
                                        {{ !$message->is_read ? 'Unread' : 'Read' }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-2">{{ $message->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.contact-messages.index') }}" class="text-sm text-blue-600 hover:text-blue-500">View all messages →</a>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No recent messages</p>
                @endif
            </div>
        </div>

        <!-- Recent Reviews -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Reviews</h3>
                @if($recent_reviews->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_reviews as $review)
                            <div class="border-l-4 border-green-400 pl-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $review->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $review->role }}</p>
                                        <p class="text-sm text-gray-500 mt-1">{{ Str::limit($review->text, 100) }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($review->is_active) bg-green-100 text-green-800 @else bg-gray-100 text-gray-800 @endif">
                                        {{ $review->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-400 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.reviews.index') }}" class="text-sm text-blue-600 hover:text-blue-500">View all reviews →</a>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">No recent reviews</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
