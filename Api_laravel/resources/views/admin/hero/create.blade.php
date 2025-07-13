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
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
        @php $action = route('hero.store'); @endphp
        @include('admin.hero.form', ['buttonText' => 'Create Hero', 'action' => $action])
    </div>
@endsection 