<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Http\Response;

class OfferController extends Controller
{
    // For API: GET /api/offers
    public function apiIndex()
    {
        return response()->json(Offer::all());
    }

    // For admin: GET /admin/offers
    public function index()
    {
        $offers = Offer::all();
        return view('admin.offer.index', compact('offers'));
    }

    // For admin: GET /admin/offers/create
    public function create()
    {
        $action = route('admin.offers.store');
        $buttonText = 'Add Offer';
        return view('admin.offer.create', compact('action', 'buttonText'));
    }

    // For admin: POST /admin/offers
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'section_title' => 'nullable|string|max:255',
            'section_description' => 'nullable|string',
        ]);
        try {
            Offer::create($data);
            return redirect()->route('admin.offers.index')->withSuccess('Offer created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    // For admin: GET /admin/offers/{id}/edit
    public function edit($id)
    {
        $offer = Offer::findOrFail($id);
        $action = route('admin.offers.update', $offer->id);
        $buttonText = 'Update Offer';
        return view('admin.offer.edit', compact('offer', 'action', 'buttonText'));
    }

    // For admin: PUT/PATCH /admin/offers/{id}
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'section_title' => 'nullable|string|max:255',
            'section_description' => 'nullable|string',
        ]);
        try {
            $offer = Offer::findOrFail($id);
            $offer->update($data);
            return redirect()->route('admin.offers.index')->withSuccess('Offer updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    // For admin: DELETE /admin/offers/{id}
    public function destroy($id)
    {
        try {
            $offer = Offer::findOrFail($id);
            $offer->delete();
            return redirect()->route('admin.offers.index')->withSuccess('Offer deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    // For API: GET /api/offers/{id}
    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        return response()->json($offer);
    }
}
