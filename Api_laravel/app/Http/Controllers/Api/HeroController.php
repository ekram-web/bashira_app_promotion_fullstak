<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    // For API: GET /api/hero
    public function apiIndex()
    {
        return response()->json(Hero::where('is_active', true)->orderBy('order')->get());
    }

    // For admin: GET /admin/hero
    public function index()
    {
        $heros = Hero::all();
        return view('admin.hero.index', compact('heros'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background_gradient' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hero-images', 'public');
            $data['image'] = $imagePath;
        }

        try {
            Hero::create($data);
            return redirect()->route('admin.hero.index')->with('persistent_success', 'Hero created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function show($id)
    {
        $hero = Hero::findOrFail($id);
        return response()->json($hero);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'background_gradient' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        try {
            $hero = Hero::findOrFail($id);
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                    Storage::disk('public')->delete($hero->image);
                }
                
                $imagePath = $request->file('image')->store('hero-images', 'public');
                $data['image'] = $imagePath;
            }

            $hero->update($data);
            return redirect()->route('admin.hero.index')->with('persistent_success', 'Hero updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $hero = Hero::findOrFail($id);
            
            // Delete image file if exists
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }
            
            $hero->delete();
            return redirect()->route('admin.hero.index')->withSuccess('Hero deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function create()
    {
        $action = route('admin.hero.store');
        $buttonText = 'Add Hero';
        return view('admin.hero.create', compact('action', 'buttonText'));
    }

    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        $action = route('admin.hero.update', $hero->id);
        $buttonText = 'Update Hero';
        return view('admin.hero.edit', compact('hero', 'action', 'buttonText'));
    }
} 