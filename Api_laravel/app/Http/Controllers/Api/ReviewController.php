<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    // For API: GET /api/reviews
    public function apiIndex()
    {
        return response()->json(Review::where('is_active', true)->orderBy('order')->get());
    }

    // For admin: GET /admin/reviews
    public function index()
    {
        $reviews = Review::all();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        \Log::info('Review store request received', $request->all());
        if ($request->hasFile('image')) {
            \Log::info('Image file received in store:', [$request->file('image')]);
        } else {
            \Log::warning('No image file received in store.');
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'rating' => 'nullable|integer',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('review-images', 'public');
            $data['image'] = $imagePath;
        }

        try {
            $review = Review::create($data);
            return redirect()->route('admin.reviews.index')->withSuccess('Review created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        return response()->json($review);
    }

    public function update(Request $request, $id)
    {
        \Log::info('Review update request received', $request->all());
        if ($request->hasFile('image')) {
            \Log::info('Image file received in update:', [$request->file('image')]);
        } else {
            \Log::warning('No image file received in update.');
        }
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'text' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'rating' => 'nullable|integer',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        try {
            $review = Review::findOrFail($id);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($review->image && Storage::disk('public')->exists($review->image)) {
                    Storage::disk('public')->delete($review->image);
                }
                
                $imagePath = $request->file('image')->store('review-images', 'public');
                $data['image'] = $imagePath;
            }

            $review->update($data);
            return redirect()->route('admin.reviews.index')->withSuccess('Review updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);
            
            // Delete image file if exists
            if ($review->image && Storage::disk('public')->exists($review->image)) {
                Storage::disk('public')->delete($review->image);
            }
            
            $review->delete();
            return redirect()->route('admin.reviews.index')->withSuccess('Review deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function create()
    {
        $action = route('admin.reviews.store');
        $buttonText = 'Add Review';
        return view('admin.reviews.create', compact('action', 'buttonText'));
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        $action = route('admin.reviews.update', $review->id);
        $buttonText = 'Update Review';
        return view('admin.reviews.edit', compact('review', 'action', 'buttonText'));
    }
} 