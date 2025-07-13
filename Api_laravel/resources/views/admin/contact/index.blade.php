@extends('admin.layouts.app')

@section('content')
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
    @endif
    <div class="mt-10 mb-6 px-6 w-full">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Contact Information</h1>
            <a href="{{ route('admin.contact.create') }}"
               class="inline-block px-5 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition font-semibold">
                Add New Contact
            </a>
        </div>
        <x-admin.table :items="$contacts" :fields="['address', 'phone', 'email', 'website']" editRoute="admin.contact.edit" deleteRoute="admin.contact.destroy" />
    </div>
@endsection 