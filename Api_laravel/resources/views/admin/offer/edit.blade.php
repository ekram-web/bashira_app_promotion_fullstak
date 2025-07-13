@extends('admin.layouts.app')

@section('content')
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-6">Edit Offer</h2>
        @php $action = route('admin.offers.update', $offer->id); @endphp
        @include('admin.offer.form', ['offer' => $offer, 'buttonText' => 'Update Offer', 'action' => $action])
    </div>
@endsection