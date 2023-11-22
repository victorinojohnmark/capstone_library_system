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
                    <th scope="col">Reservation Date</th>
                    <th scope="col">Option</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($bookWithReservations as $bookWithReservation)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $bookWithReservation->title }}</td>
                        <td>{{ $bookWithReservation->author }}</td>
                        <td>{{ $bookWithReservation->isbn }}</td>
                        <td>{{ $bookWithReservation->bookRequest->approved_at }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lendBook{{ $bookWithReservation->id ?? null }}">
                                <i class="far fa-thumbs-up"></i> Lend Book
                            </button>
                            
                        </td>
                    </tr>
                @empty
                    
                @endforelse
            </tbody>
        </table>
    </div>
</div>