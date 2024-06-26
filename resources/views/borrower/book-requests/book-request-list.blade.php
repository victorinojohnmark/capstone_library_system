@extends('layouts.borrower')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book Requests')

{{-- @section('content_header')
    <h2>Your Book Requests</h2>
@stop --}}

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.message')

                <div class="card">
                    <div class="card-header">
                        <strong>Book Requests</strong>
                        <div class="float-right d-inline-flex">
                            <a href="{{ route('borrower.book-requests-create') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i> Create Request</a>
                        </div>
                    </div>
        
                    <div class="card-body">
                        <table id="book-requests-table" class="table table-bordered table-hover table-stripe">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Author</th>
                                    {{-- <th scope="col">ISBN</th> --}}
                                    <th scope="col">Date Request</th>
                                    <th scope="col">Status</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookRequests as $bookRequest)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <p>{{ $bookRequest->book->title }}</p>
                                            {{-- @include('borrower.book-requests.book-request-modal') --}}
                                        </td>
                                        <td>
                                            @forelse (json_decode($bookRequest->book->author, true) as $author)
                                                <span class="badge badge-success">{{ $author }}</span>
                                            @empty
                                                
                                            @endforelse
                                        </td>
                                        {{-- <td>{{ $bookRequest->book->isbn }}</td> --}}
                                        <td>{{  $bookRequest->requested_at }}</td>
                                        <td>{{ $bookRequest->status }}</td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/datatables/datatables.min.css">
@stop

@section('js')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/datatables/datatables.min.js"></script>
    <script src="/js/custom.js"></script>
    <script>
        $(document).ready(function () {
            $('#book-requests-table').DataTable({
                "order": [],
                "searching": false
            });

        });
    </script>
@stop
