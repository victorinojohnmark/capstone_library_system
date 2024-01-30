<div class="card">
    <div class="card-header">
        <div class="float-right d-inline-flex">
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBook"><i class="fas fa-fw fa-book"></i> Add Book</button> --}}
        </div>
    </div>

    <div class="card-body">
        <table id="borrowedBookDatatable" class="table table-bordered table-hover table-stripe">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book</th>
                    <th scope="col">Borrower</th>
                    <th style="width: 100px;">ISBN</th>
                    <th scope="col">Date Borrowed</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Option</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($borrowedBooks as $borrowedBook)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $borrowedBook->title }}</td>
                        <td>{{ $borrowedBook->latestBorrowedTransaction->user->name }}</td>
                        <td>{{ $borrowedBook->isbn }}</td>
                        <td>{{ $borrowedBook->latestBorrowedTransaction->borrowed_at }}</td>
                        <td>{{ $borrowedBook->latestBorrowedTransaction->due_date }} 
                            @if ($borrowedBook->latestBorrowedTransaction->is_overdue)
                            <span class="badge badge-danger inline">Overdue</span>
                            <span class="badge badge-danger inline">50 pesos fine</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#returnBook{{ $borrowedBook->id ?? null }}">
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