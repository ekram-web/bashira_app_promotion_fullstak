<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\Review;
use App\Models\ContactMessage;
use App\Models\Promotion;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Share unread messages count with all admin views
        View::composer('admin.layouts.app', function ($view) {
            $view->with('unreadMessagesCount', \App\Models\ContactMessage::where('is_read', false)->count());
        });
    }

    public function index()
    {
        $stats = [
            'total_hero_slides' => Hero::count(),
            'active_hero_slides' => Hero::where('is_active', true)->count(),
            'total_reviews' => Review::count(),
            'active_reviews' => Review::where('is_active', true)->count(),
            'total_messages' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'read_messages' => ContactMessage::where('is_read', true)->count(),
            'total_promotions' => Promotion::count(),
            'total_contacts' => Contact::count(),
            'total_users' => User::count(),
        ];

        $recent_messages = ContactMessage::latest()->take(5)->get();
        $recent_reviews = Review::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_messages', 'recent_reviews'));
    }

    /**
     * Admin search handler (professional placeholder)
     */
    public function search(Request $request)
    {
        $query = $request->input('q');
        // TODO: Implement actual search logic across models
        // For now, just return a view with the query and a placeholder
        return view('admin.search-results', [
            'query' => $query,
            'results' => [], // Placeholder for future search results
        ]);
    }
} 