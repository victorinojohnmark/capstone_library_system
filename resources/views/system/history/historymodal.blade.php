<div class="modal fade" id="modalBook{{ $book->id ?? null }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Book History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table id="books-table" class="table table-bordered table-hover table-stripe">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Borrower</th>
                        <th scope="col">Date Borrowed</th>
                        <th scope="col">Date Returned</th>
                        <th scope="col">Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($book->bookTransactions as $transaction)
                    <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $transaction->user->name }}</td>
                      <td>{{ \Carbon\Carbon::parse($transaction->borrowed_at)->format('Y-m-d') }}</td>
                      <td>
                        @if ($transaction->returned_at)
                          {{ \Carbon\Carbon::parse($transaction->returned_at)->format('Y-m-d') }}
                        @else
                          {{ '-' }}
                        @endif
                      </td>
                      
                      <td>{{ $transaction->due_date }}</td>
                    </tr>
                    
                    @empty
                    <tr>
                      <td colspan="3">No History</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>