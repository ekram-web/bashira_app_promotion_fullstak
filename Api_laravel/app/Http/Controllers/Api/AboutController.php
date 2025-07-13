<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    // For API: GET /api/about
    public function apiIndex()
    {
        return response()->json(About::first());
    }

    // For admin: GET /admin/about
    public function index()
    {
        $abouts = About::all();
        return view('admin.about.index', compact('abouts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|array'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('about-images', 'public');
            $data['image'] = $imagePath;
        }

        try {
            About::create($data);
            \Log::info('AboutController@store: Setting success for add');
            return redirect()->route('admin.about.index')->withSuccess('About section created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function show($id)
    {
        $about = About::findOrFail($id);
        return response()->json($about);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'values' => 'nullable|array'
        ]);

        try {
            $about = About::findOrFail($id);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($about->image && Storage::disk('public')->exists($about->image)) {
                    Storage::disk('public')->delete($about->image);
                }
                
                $imagePath = $request->file('image')->store('about-images', 'public');
                $data['image'] = $imagePath;
            }

            $about->update($data);
            \Log::info('AboutController@update: Setting success for edit');
            return redirect()->route('admin.about.index')->withSuccess('About section updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $about = About::findOrFail($id);
            
            // Delete image file if exists
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            
            $about->delete();
            return redirect()->route('admin.about.index')->withSuccess('About section deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function create()
    {
        $action = route('admin.about.store');
        $buttonText = 'Add About';
        return view('admin.about.create', compact('action', 'buttonText'));
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        $action = route('admin.about.update', $about->id);
        $buttonText = 'Update About';
        return view('admin.about.edit', compact('about', 'action', 'buttonText'));
    }
} 