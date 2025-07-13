<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    // For API: GET /api/promotion
    public function apiIndex()
    {
        return response()->json(Promotion::where('is_active', true)->get());
    }

    // For admin: GET /admin/promotion
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.promotion.index', compact('promotions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'app_store_url' => 'nullable|url|max:255',
            'play_store_url' => 'nullable|url|max:255',
            'qr_code_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);

        // Handle image uploads
        if ($request->hasFile('qr_code_image')) {
            $qrCodePath = $request->file('qr_code_image')->store('promotion-images', 'public');
            $data['qr_code_image'] = $qrCodePath;
        }

        if ($request->hasFile('phone_image')) {
            $phoneImagePath = $request->file('phone_image')->store('promotion-images', 'public');
            $data['phone_image'] = $phoneImagePath;
        }

        try {
            Promotion::create($data);
            return redirect()->route('admin.promotion.index')->with('persistent_success', 'Promotion created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function show($id)
    {
        $promotion = Promotion::findOrFail($id);
        return response()->json($promotion);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'app_store_url' => 'nullable|url|max:255',
            'play_store_url' => 'nullable|url|max:255',
            'qr_code_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'phone_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
            'is_active' => 'boolean'
        ]);

        try {
            $promotion = Promotion::findOrFail($id);
            
            // Handle image uploads
            if ($request->hasFile('qr_code_image')) {
                // Delete old QR code image if exists
                if ($promotion->qr_code_image && Storage::disk('public')->exists($promotion->qr_code_image)) {
                    Storage::disk('public')->delete($promotion->qr_code_image);
                }
                
                $qrCodePath = $request->file('qr_code_image')->store('promotion-images', 'public');
                $data['qr_code_image'] = $qrCodePath;
            }

            if ($request->hasFile('phone_image')) {
                // Delete old phone image if exists
                if ($promotion->phone_image && Storage::disk('public')->exists($promotion->phone_image)) {
                    Storage::disk('public')->delete($promotion->phone_image);
                }
                
                $phoneImagePath = $request->file('phone_image')->store('promotion-images', 'public');
                $data['phone_image'] = $phoneImagePath;
            }

            $promotion->update($data);
            return redirect()->route('admin.promotion.index')->with('persistent_success', 'Promotion updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            
            // Delete image files if exist
            if ($promotion->qr_code_image && Storage::disk('public')->exists($promotion->qr_code_image)) {
                Storage::disk('public')->delete($promotion->qr_code_image);
            }
            
            if ($promotion->phone_image && Storage::disk('public')->exists($promotion->phone_image)) {
                Storage::disk('public')->delete($promotion->phone_image);
            }
            
            $promotion->delete();
            return redirect()->route('admin.promotion.index')->withSuccess('Promotion deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('persistent_error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function create()
    {
        $action = route('admin.promotion.store');
        $buttonText = 'Add Promotion';
        return view('admin.promotion.create', compact('action', 'buttonText'));
    }

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        $action = route('admin.promotion.update', $promotion->id);
        $buttonText = 'Update Promotion';
        return view('admin.promotion.edit', compact('promotion', 'action', 'buttonText'));
    }
} 