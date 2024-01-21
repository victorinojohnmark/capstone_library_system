<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\System\Helper;

class BookController extends Controller
{
    public function index()
    {
        return view('master.books.booklist', [
            'book' => new Book(),
            'books' => Book::orderBy('title')->get(),
            
        ]);
    }

    public function show(Request $request, Book $book)
    {
        return view('master.books.bookcreate', [
            'book' => $book,
            'categories' => Helper::getDropDownJson('book_category.json'),
            'conditions' => Helper::getDropDownJson('book_condition.json'),
        ]);
    }

    public function create(Request $request)
    {
        return view('master.books.bookcreate', [
            'book' => new Book(),
            'categories' => Helper::getDropDownJson('book_category.json'),
            'conditions' => Helper::getDropDownJson('book_condition.json'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:books,title',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'category' =>'required',
            'subject' => 'nullable',
            'year' => 'required|numeric|between:1900,' . date('Y'),
            'quantity' =>'required|integer',
            'condition' =>'required',
            'remarks' => 'nullable'
        ]);

        if($data['category'] != 'Books') {
            $data['subject'] = null;
        }

        $book = Book::create($data);

        session()->flash('success', $book->title . ' added successfully.');

        return redirect()->route('book-index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|unique:books,title,'.$book->id.',id',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id . ',id',
            'category' =>'required',
            'subject' => 'nullable',
            'year' => 'required|numeric|between:1900,' . date('Y'),
            'quantity' =>'required|integer',
            'condition' =>'required',
            'remarks' => 'nullable'
        ]);

        if($data['category'] != 'Books') {
            $data['subject'] = null;
        }

        $book->fill($data);
        $book->save();

        session()->flash('success', $book->title . ' updated successfully.');

        return redirect()->route('book-index');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        session()->flash('success', $book->title . ' deleted successfully.');

        return redirect()->route('book-index');
    }

}
