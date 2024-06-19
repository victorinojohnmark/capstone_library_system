<div class="card">
    <div class="card-header">
        <div class="float-right d-inline-flex">
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBook"><i class="fas fa-fw fa-book"></i> Add Book</button> --}}
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="borrowedBookTable" class="table table-bordered table-hover table-stripe">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Borrower</th>
                        <th scope="col">Book</th>
                        
                        {{-- <th style="width: 100px;">ISBN</th> --}}
                        <th scope="col">Date Borrowed</th>
                        <th scope="col">Due Date</th>
                        <th scope="col">Option</th>
    
                    </tr>
                </thead>
                <tbody>
                    @forelse ($borrowedTransactions as $borrowedTransaction)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $borrowedTransaction->user->name }}</td>
                            <td>{{ $borrowedTransaction->book->title }}</td>
                            
                            {{-- <td>{{ $borrowedTransactions->book->isbn }}</td> --}}
                            <td>{{ $borrowedTransaction->borrowed_at }}</td>
                            <td>{{ $borrowedTransaction->due_date }} 
                                @if ($borrowedTransaction->is_overdue)
                                <span class="badge badge-danger inline">Overdue</span>
                                <span class="badge badge-danger inline">{{ number_format($borrowedTransaction->penalty, 2) }} pesos fine</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#returnBook{{ $borrowedTransaction->book->id ?? null }}">
                                    <i class="far fa-thumbs-up"></i> Return Book
                                </button>
                                @include('transaction.book-transaction.modals.book-return-modal')
                                
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>