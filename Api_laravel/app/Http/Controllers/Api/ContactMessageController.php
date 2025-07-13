<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // For API: GET /api/contact-messages (if needed)
    public function apiIndex()
    {
        return response()->json(ContactMessage::all());
    }

    // For admin: GET /admin/contact-messages
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all');
        $query = ContactMessage::query();
        if ($filter === 'unread') {
            $query->where('is_read', false);
        } elseif ($filter === 'read') {
            $query->where('is_read', true);
        }
        $contactMessages = $query->orderByDesc('created_at')->get();
        return view('admin.contact-messages.index', compact('contactMessages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'boolean'
        ]);
        try {
            $message = ContactMessage::create($data);
            // If the request expects JSON (API), return JSON
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['success' => true, 'message' => 'Contact message created successfully!', 'data' => $message], 201);
            }
            // Otherwise, fallback to web/admin redirect
            return redirect()->route('admin.contact-message.index')->with('success', 'Contact message created successfully!');
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['success' => false, 'error' => 'An unexpected error occurred. Please try again.'], 500);
            }
            return back()->withInput()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function show($id)
    {
        $contactMessage = ContactMessage::findOrFail($id);
        if (!$contactMessage->is_read) {
            $contactMessage->is_read = true;
            $contactMessage->save();
        }
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'is_read' => 'boolean'
        ]);
        try {
            $contactMessage = ContactMessage::findOrFail($id);
            $contactMessage->update($data);
            return redirect()->route('admin.contact-message.index')->with('success', 'Contact message updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $contactMessage = ContactMessage::findOrFail($id);
            $contactMessage->delete();
            return redirect()->route('admin.contact-message.index')->with('success', 'Contact message deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function pendingCount()
    {
        $count = ContactMessage::where('status', 'pending')->count();
        return response()->json(['pending_count' => $count]);
    }

    public function edit($id)
    {
        $contactMessage = ContactMessage::findOrFail($id);
        return view('admin.contact-messages.edit', compact('contactMessage'));
    }

    public function toggleRead($id)
    {
        $contactMessage = ContactMessage::findOrFail($id);
        $contactMessage->is_read = !$contactMessage->is_read;
        $contactMessage->save();
        return redirect()->back()->with('success', 'Message status updated.');
    }
} 