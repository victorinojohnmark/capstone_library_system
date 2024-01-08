<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookTransaction;

class BookHistoryController extends Controller
{
    public function index()
    {
        return view('system.history.historyview', [
            'books' => Book::whereHas('bookTransactions')->get()
        ]);
    }
}
