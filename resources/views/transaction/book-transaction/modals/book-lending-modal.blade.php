<div class="modal fade" id="lendBook{{ $bookWithReservation->id ?? null }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lend Book</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-row" action="{{ route('admin.book-transactions.lend-book', ['book' => $bookWithReservation->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="book_id" value="{{ $bookWithReservation->id }}">
                <input type="hidden" name="user_id" value="{{ $bookWithReservation->latestApprovedBookRequest->user->id }}">
                <p>You are lending <strong>{{ $bookWithReservation->title }}</strong> <br>to <strong>{{ $bookWithReservation->latestApprovedBookRequest->user->name }}</strong>, please confirm.</p>
                <div class="form-group col-md-6">
                    <label for="due_date{{ $bookWithReservation->id ?? null }}">Due Date</label>
                    <input type="date" name="due_date" class="form-control" id="due_date{{ $bookWithReservation->id ?? null }}" min="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
        </div>
      </div>
    </div>
  </div>