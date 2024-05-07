<div class="modal fade" id="returnBook{{ $borrowedTransaction->book->id ?? null }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Return Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-row" action="{{ route('admin.book-transactions.return-book', ['book' => $borrowedTransaction->book->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="book_id" value="{{ $borrowedTransaction->book->id }}">
                <input type="hidden" name="user_id" value="{{ $borrowedTransaction->user->id }}">
                <p>You are returning <strong>{{ $borrowedTransaction->book->title }}</strong> <br>from <strong>{{ $borrowedTransaction->user->name }}</strong>, please confirm.</p>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
        </div>
      </div>
    </div>
  </div>