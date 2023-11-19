<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\BookRequest;
use App\Models\Book;

class BookRequestController extends Controller
{
    public function allBookRequests()
    {
        //all book requests
    }
    public function index()
    {
        //book requests of current user

        return view('borrower.book-requests.book-request-list', [
            'bookRequest' => new BookRequest(),
            'books' => Book::orderBy('title')->get(),
            'bookRequests' => BookRequest::where('requested_by_id', auth()->user()->id)->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        //save book request
        $data = $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $data['requested_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $data['requested_by_id'] = auth()->id();

        // for add - check if request already exist to avoid duplicate request

        $bookRequest = BookRequest::create($data);

        return redirect()->route('borrower.book-requests')->with('success', 'Book request submitted!');
        
    }

    
    public function update(Request $request, BookRequest $bookRequest)
    {
        $data = $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $bookRequest->fill($data);
        $bookRequest->save();

        return redirect()->route('borrower.book-requests')->with('success', 'Book request updated!');
    }

    public function destroy(BookRequest $bookRequest)
    {
        //delete book request
    }
}
