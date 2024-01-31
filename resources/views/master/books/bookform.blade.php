<form class="form-row" action="/admin/books{{ $book->id ? '/' . $book->id : null }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row col-md-6">
        <div class="form-group col-md-12">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $book->title ?? null) }}" required>
        </div>

        <div class="form-group col-md-12">
            <label for="author">Author</label>
            <input type="text" name="author" class="form-control" id="author" value="{{ old('author', $book->author ?? null) }}">
        </div>

        <div class="form-group col-md-12">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" class="form-control" id="isbn" value="{{ old('isbn', $book->isbn ?? null) }}">
        </div>

        <div class="form-group col-md-12">
            <label for="category">Category</label>
            <select name="category" class="custom-select" id="category" onchange="handleCategoryChange(this)" onload="handleCategoryChange(this)" required>
                <option selected disabled>Select here...</option>
                @forelse ($categories as $category)
                    <option value="{{ $category['name'] }}" {{ $book->category == $category['name'] ? 'selected' : null }}>{{ $category['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>

        <div class="form-group col-md-12">
            <label for="subject">Subject</label>
            <input type="text" name="subject" class="form-control" id="subject" value="{{ old('subject', $book->subject ?? null) }}">
        </div>
    </div>

    <div class="row col-md-6">
        <div class="form-group col-md-12">
            <label for="year">Year</label>
            <input type="year" name="year" class="form-control" id="year" value="{{ old('year', $book->year ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-12">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" id="quantity" value="{{ old('quantity', $book->quantity ?? null) }}" required>
        </div>
    
        <div class="form-group col-md-12">
            <label for="condition">Condition</label>
            <select name="condition" class="custom-select" id="condition">
                <option selected disabled>Select here...</option>
                @forelse ($conditions as $condition)
                    <option value="{{ $condition['name'] }}" {{ $book->condition == $condition['name'] ? 'selected' : null }}>{{ $condition['name'] }}</option>
                @empty
                @endforelse
            </select>
        </div>
    
        <div class="form-group col-md-12">
            <label for="remarks">Remarks</label>
            <textarea name="remarks" class="form-control" id="remarks" cols="30" rows="10">{{ old('remarks', $book->remarks ?? null) }}</textarea>
        </div>
    </div>

    

    <div class="col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
    
</form>