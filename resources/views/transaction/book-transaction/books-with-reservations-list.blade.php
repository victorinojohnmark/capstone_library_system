<div class="card">
    <div class="card-header">
        <div class="float-right d-inline-flex">
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBook"><i class="fas fa-fw fa-book"></i> Add Book</button> --}}
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="bookWithReservationTable" class="datatable table table-bordered table-hover table-stripe">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Book</th>
                        <th scope="col">Author</th>
                        {{-- <th scope="col">ISBN</th> --}}
                        <th scope="col">Reservation Date</th>
                        <th scope="col">Option</th>
    
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookRequests as $bookRequest)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $bookRequest->user->name }}</td>
                            <td>{{ $bookRequest->book->title }}</td>
                            <td>
                                @forelse (json_decode($bookRequest->book->author, true) as $author)
                                    <span class="badge badge-success">{{ $author }}</span>
                                @empty
                                    
                                @endforelse
                            </td>
                            {{-- <td>{{ $bookRequest->isbn }}</td> --}}
                            <td>{{ $bookRequest->approved_at }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lendBook{{ $bookRequest->id ?? null }}">
                                    <i class="far fa-thumbs-up"></i> Lend Book
                                </button>
                                @include('transaction.book-transaction.modals.book-lending-modal')
                                
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>