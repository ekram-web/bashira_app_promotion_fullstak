@extends('admin.layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
        @php $action = route('about.store'); @endphp
        @include('admin.about.form', ['buttonText' => 'Create About', 'action' => $action])
    </div>
@endsection 