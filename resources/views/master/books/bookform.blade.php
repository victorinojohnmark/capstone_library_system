<form class="form-row" action="/admin/books{{ $book->id ? '/' . $book->id : null }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group col-md-12">
        <label for="title{{ $book->id ?? null }}">Title</label>
        <input type="text" name="title" class="form-control" id="title{{ $book->id ?? null }}" value="{{ old('title', $book->title ?? null) }}" required>
    </div>

    <div class="form-group col-md-12">
        <label for="author{{ $book->id ?? null }}">Author</label>
        <input type="text" name="author" class="form-control" id="author{{ $book->id ?? null }}" value="{{ old('author', $book->author ?? null) }}" required>
    </div>

    <div class="form-group col-md-12">
        <label for="isbn{{ $book->id ?? null }}">ISBN</label>
        <input type="text" name="isbn" class="form-control" id="isbn{{ $book->id ?? null }}" value="{{ old('isbn', $book->isbn ?? null) }}" required>
    </div>

    <div class="form-group col-md-12">
        <label for="publisher{{ $book->id ?? null }}">Publisher</label>
        <input type="text" name="publisher" class="form-control" id="publisher{{ $book->id ?? null }}" value="{{ old('publisher', $book->publisher ?? null) }}" required>
    </div>

    <div class="form-group col-md-12">
        <label for="remarks{{ $book->id ?? null }}">Remarks</label>
        <textarea name="remarks" class="form-control" id="remarks{{ $book->id ?? null }}" cols="30" rows="10">{{ old('remarks', $book->remarks ?? null) }}</textarea>
    </div>

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
    
</form>