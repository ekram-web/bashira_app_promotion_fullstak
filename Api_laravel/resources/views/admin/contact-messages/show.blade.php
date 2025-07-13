@extends('admin.layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-lg">
        <div class="flex items-center mb-6">
            <span class="material-icons text-blue-500 mr-3" style="font-size: 2rem;">mail</span>
            <h2 class="text-2xl font-bold text-gray-800">Contact Message</h2>
        </div>
        <hr class="mb-6">
        <dl class="mb-8">
            <dt class="font-semibold text-gray-700 mb-1">Name:</dt>
            <dd class="mb-4 text-gray-900">{{ $contactMessage->name }}</dd>
            <dt class="font-semibold text-gray-700 mb-1">Email:</dt>
            <dd class="mb-4 text-gray-900">{{ $contactMessage->email }}</dd>
            <dt class="font-semibold text-gray-700 mb-1">Subject:</dt>
            <dd class="mb-4 text-gray-900">{{ $contactMessage->subject }}</dd>
            <dt class="font-semibold text-gray-700 mb-1">Message:</dt>
            <dd class="text-gray-900">{{ $contactMessage->message }}</dd>
        </dl>
        <a href="{{ route('admin.contact-messages.index') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold shadow transition">← Back to List</a>
    </div>
</div>
@endsection 