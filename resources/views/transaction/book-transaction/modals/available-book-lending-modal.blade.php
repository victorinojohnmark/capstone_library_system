<div class="modal fade" id="lendBook{{ $availableBook->id ?? null }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lend Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-row" action="{{ route('admin.book-transactions.lend-book', ['book' => $availableBook->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="book_id" value="{{ $availableBook->id }}">
                <div class="form-group col-md-12">
                    <p>Book: {{ $availableBook->title }}</p>
                </div>
                
                <div class="form-group col-md-12">
                    <label for="user_id{{ $availableBook->id ?? null }}">Borrower</label>
                    <select name="user_id" class="custom-select" id="user_id{{ $availableBook->id ?? null }}">
                        <option selected disabled>Select here...</option>
                        @forelse ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @empty
                            
                        @endforelse
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="due_date{{ $availableBook->id ?? null }}">Due Date</label>
                    <input type="date" name="due_date" class="form-control" id="due_date{{ $availableBook->id ?? null }}" required>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
        </div>
      </div>
    </div>
  </div>