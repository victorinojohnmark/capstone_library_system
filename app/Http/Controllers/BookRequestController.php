<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\BookRequest;
use App\Models\Book;
use App\Models\User;

use App\Notifications\BookRequest\BookRequestNotification;
use App\Notifications\BookRequest\BookRequestApprovedNotification;
use App\Notifications\BookRequest\BookRequestRejectedNotification;

class BookRequestController extends Controller
{
    public function allBookRequests()
    {
        return view('transaction.book-request.book-request-list', [
            'bookRequests' => BookRequest::latest()->get()
        ]);
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

        $bookRequest = BookRequest::create($data);

        $adminUsers = User::admins()->get();

        foreach ($adminUsers as $user) {
            $user->notify(new BookRequestNotification($bookRequest));
        }

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

    public function approveBookRequest(Request $request, BookRequest $bookRequest)
    {
        $bookRequest->approved_at = Carbon::now()->format('Y-m-d H:i:s');
        $bookRequest->save();

        $bookRequest->user->notify(new BookRequestApprovedNotification($bookRequest));

        return redirect()->route('admin.book-requests')->with('success', 'Book request successfully approved. Borrower will get notified.');
    }

    public function rejectBookRequest(Request $request, BookRequest $bookRequest)
    {
        $bookRequest->rejected_at = Carbon::now()->format('Y-m-d H:i:s');
        $bookRequest->save();

        $bookRequest->user->notify(new BookRequestRejectedNotification($bookRequest));

        return redirect()->route('admin.book-requests')->with('success', 'Book request successfully rejected. Borrower will get notified.');
    }
}
