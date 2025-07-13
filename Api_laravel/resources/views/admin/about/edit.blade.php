@extends('admin.layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit About</h2>
        @php $action = route('about.update', $about->id); @endphp
        @include('admin.about.form', ['about' => $about, 'buttonText' => 'Update About', 'action' => $action])
    </div>
@endsection 