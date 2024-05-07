<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Book;
use App\Models\User;
use App\Models\BookRequest;
use App\Models\BookTransaction;

class BookTransactionController extends Controller
{

    public function index()
    {

        $books = Book::all();
        $availableBooks = $books->filter(function ($book) {
            return $book->current_stock > 0;
        });

        return view('transaction.book-transaction.book-transaction-list', [
            'bookRequests' => BookRequest::approved()->orderBy('requested_at')->get(),
            // 'availableBooks' => Book::AvailableForLending()->orderBy('title')->get(),
            'availableBooks' => $availableBooks->sortBy('title'),
            // 'borrowedBooks' => Book::borrowedBooks()->orderBy('title')->get(),
            'borrowedTransactions' => BookTransaction::where('returned_at', '=', null)->orderBy('borrowed_at')->get(),
            'users' => User::borrowers()->orderBy('lastname')->get()
        ]);
    }

    public function lendBook(Request $request, Book $book)
    {
        // once book is borrowed, book requests should be removed
        
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'due_date' => 'required|date'
        ]);

        //get user whos borrowing the book
        $user = User::findOrFail($data['user_id']);

        //check if reserved
        // if($book->isReserved) {
            
        //     // the reservation is not the same with the requested user, return error
        //     if($book->latestApprovedBookRequest->requested_by_id != $data['user_id']) {
        //         return redirect()->back()->with('error', 'Invalid Transaction. The book is already reserved for ' . $user->name . '.');
        //     }
        // }

        if ($book->current_stock <= 0) {
            return redirect()->back()->with('error', 'There are no available copies of this book at the moment.');
        }

        // dd($data);
        //create bookTransaction - lend book
        $data['borrowed_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $bookTransaction = BookTransaction::create($data);

        //delete reservation
        $book->latestApprovedBookRequest?->delete();

        return redirect()->back()->with('success', 'The book was successfully lent to ' . $user->name . '.');

    }

    public function returnBook(Request $request, Book $book)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Get the user who is returning the book
        $user = User::findOrFail($data['user_id']);

        // Check if the book is currently borrowed by the user
        if (!$book->isBorrowed || $book->latestBorrowedTransaction->user_id != $data['user_id']) {
            return redirect()->back()->with('error', 'Invalid Transaction. The book is not currently borrowed by ' . $user->name . '.');
        }

        // Update bookTransaction - mark book as returned
        $book->latestBorrowedTransaction->update(['returned_at' => now()]);

        return redirect()->back()->with('success', 'The book was successfully returned by ' . $user->name . '.');
    }

    // public function show(BookTransaction $bookTransaction)
    // {
    //     //
    // }

    // public function edit(BookTransaction $bookTransaction)
    // {
    //     //
    // }

    // public function update(Request $request, BookTransaction $bookTransaction)
    // {
    //     //
    // }

    // public function destroy(BookTransaction $bookTransaction)
    // {
    //     //
    // }
}
