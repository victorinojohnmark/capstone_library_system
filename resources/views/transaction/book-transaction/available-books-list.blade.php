<div class="card">
    <div class="card-header">
        <div class="float-right d-inline-flex">
            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBook"><i class="fas fa-fw fa-book"></i> Add Book</button> --}}
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="availableBookTable" class="datatable table table-bordered table-hover table-stripe">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book</th>
                        <th scope="col">Author</th>
                        {{-- <th scope="col">ISBN</th> --}}
                        <th scope="col">Option</th>
    
                    </tr>
                </thead>
                <tbody>
                    @forelse ($availableBooks as $availableBook)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $availableBook->title }}</td>
                            <td>
                                @forelse (json_decode($availableBook->author, true) as $author)
                                    <span class="badge badge-success">{{ $author }}</span>
                                @empty
                                    
                                @endforelse
                            </td>
                            {{-- <td>{{ $availableBook->isbn }}</td> --}}
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#lendBook{{ $availableBook->id ?? null }}">
                                    <i class="far fa-thumbs-up"></i> Lend Book
                                </button>
                                @include('transaction.book-transaction.modals.available-book-lending-modal')
                                
                            </td>
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>