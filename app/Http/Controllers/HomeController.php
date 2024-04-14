<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Book;
use App\Models\AppSetting;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->is_admin) {
            // If admin, go to the regular home route
            return view('home');
        } else {
            // If not admin, go to the borrower.home route
            return redirect()->route('borrower.home');
        }

    }

    public function welcome()
    {
        return view('welcome', [
            'announcements' => Announcement::latest()->get(),
            'books' => Book::latest()->get(),
            'appSetting' => AppSetting::first(),
            'galleries' => Gallery::all()
        ]);
    }
}
