<form class="form-row" action="/borrower/book-requests{{ $bookRequest->id ? '/' . $bookRequest->id : null }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-md-12">
        <label for="book_id{{ $bookRequest->id ?? null }}">Book Title</label>
        <select name="book_id" class="custom-select" id="book_id{{ $bookRequest->id ?? null }}">
            <option selected disabled>Select here...</option>
            @forelse ($books as $book)
                <option value="{{ $book->id }}" {{ $bookRequest->id && $bookRequest->book_id == $book->id ? 'selected' : null }} >{{ $book->title }}</option>
            @empty
                
            @endforelse
        </select>
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
</form>