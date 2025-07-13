@extends('admin.layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
        @php $action = route('admin.offers.store'); @endphp
        @include('admin.offer.form', ['buttonText' => 'Create Offer', 'action' => $action])
    </div>
@endsection 