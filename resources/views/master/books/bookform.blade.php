<form class="form-row" action="/admin/books{{ $book->id ? '/' . $book->id : null }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row col-md-6">
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
            <label for="category{{ $book->id ?? null }}">Category</label>
            <select name="category" class="custom-select" id="category{{ $book->id ?? null }}">
                <option selected disabled>Select here...</option>
                @forelse ($categories as $category)
                    <option value="{{ $category['name'] }}" {{ $book->category == $category['name'] ? 'selected' : null }}>{{ $category['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="subject{{ $book->id ?? null }}">Subject</label>
            <input type="text" name="subject" class="form-control" id="subject{{ $book->id ?? null }}" value="{{ old('subject', $book->subject ?? null) }}" required>
        </div>
    </div>

    <div class="row col-md-6">
        <div class="form-group col-md-12">
            <label for="year{{ $book->id ?? null }}">Year</label>
            <input type="year" name="year" class="form-control" id="year{{ $book->id ?? null }}" value="{{ old('year', $book->year ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-12">
            <label for="quantity{{ $book->id ?? null }}">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity{{ $book->id ?? null }}" value="{{ old('quantity', $book->quantity ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-12">
            <label for="condition{{ $book->id ?? null }}">Condition</label>
            <select name="condition" class="custom-select" id="condition{{ $book->id ?? null }}">
                <option selected disabled>Select here...</option>
                @forelse ($conditions as $condition)
                    <option value="{{ $condition['name'] }}" {{ $book->condition == $condition['name'] ? 'selected' : null }}>{{ $condition['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>
    
        <div class="form-group col-md-12">
            <label for="remarks{{ $book->id ?? null }}">Remarks</label>
            <textarea name="remarks" class="form-control" id="remarks{{ $book->id ?? null }}" cols="30" rows="10">{{ old('remarks', $book->remarks ?? null) }}</textarea>
        </div>
    </div>

    

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
    
</form>