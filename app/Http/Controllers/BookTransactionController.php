<?php

namespace App\Http\Controllers;

use App\Models\BookTransaction;
use Illuminate\Http\Request;

use App\Models\Book;

class BookTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('transaction.book-transaction.book-transaction-list', [
            'bookWithReservations' => Book::withApprovedRequests()->orderBy('title')->get(),
            'availableBooks' => Book::WithoutApprovalRequests()->orderBy('title')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BookTransaction $bookTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookTransaction $bookTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookTransaction $bookTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookTransaction $bookTransaction)
    {
        //
    }
}
