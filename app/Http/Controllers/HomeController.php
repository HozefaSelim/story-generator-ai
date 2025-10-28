<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application homepage
     */
    public function index()
    {
        $recentStories = null;
        
        if (Auth::check()) {
            $recentStories = Auth::user()->stories()
                ->where('status', 'completed')
                ->orderBy('created_at', 'desc')
                ->limit(6)
                ->get();
        }

        return view('home', compact('recentStories'));
    }

    /**
     * Show the about page
     */
    public function about()
    {
        return view('pages.about');
    }

    /**
     * Show the features page
     */
    public function features()
    {
        return view('pages.features');
    }

    /**
     * Show how it works page
     */
    public function howItWorks()
    {
        return view('pages.how-it-works');
    }
}
