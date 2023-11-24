<div class="card">
    <div class="card-header">
        <div class="float-right d-inline-flex">
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBook"><i class="fas fa-fw fa-book"></i> Add Book</button> --}}
        </div>
    </div>

    <div class="card-body">
        <table class="datatable table table-bordered table-hover table-stripe">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book</th>
                    <th scope="col">Author</th>
                    <th scope="col">ISBN</th>
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
                        <td>{{ $borrowedBook->author }}</td>
                        <td>{{ $borrowedBook->isbn }}</td>
                        <td>{{ $borrowedBook->latestBorrowedTransaction->borrowed_at }}</td>
                        <td>{{ $borrowedBook->latestBorrowedTransaction->due_date }}</td>
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