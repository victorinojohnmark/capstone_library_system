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
                    <th scope="col">Option</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($availableBooks as $availableBook)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $availableBook->title }}</td>
                        <td>{{ $availableBook->author }}</td>
                        <td>{{ $availableBook->isbn }}</td>
                        <td>
                            {{-- @if (!$bookRequest->rejected_at && !$bookRequest->approved_at)
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#rejectBookRequest{{ $bookRequest->id ?? null }}">
                                    <i class="fas fa-fw fa-times"></i> Reject
                                </button>
                                @include('transaction.book-request.reject-book-request-modal') 

                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#approveBookRequest{{ $bookRequest->id ?? null }}">
                                    <i class="fas fa-fw fa-thumbs-up"></i> Approved
                                </button>
                                @include('transaction.book-request.approve-book-request-modal') 
                            @else
                                <button type="button" class="btn btn-secondary btn-sm" disabled>N/A</button>
                            @endif --}}
                            
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
</div>