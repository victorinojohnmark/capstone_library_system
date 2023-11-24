<?php

namespace App\Http\Controllers\Borrower;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class BorrowerFrontendController extends Controller
{
    public function home()
    {
        return view('borrower.borrower-home', []);
    }

    public function borrowedBooks()
    {
        return view('borrower.borrowed-books.borrowed-books-list', [
            'borrowedBookTransactions' => auth()->user()->borrowedBooks
        ]);
    }

    
}
