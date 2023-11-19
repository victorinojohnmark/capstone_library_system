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
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBookRequest"><i class="fas fa-fw fa-book"></i> Create Request</button>
                            @include('borrower.book-requests.book-request-modal')
                        </div>
                    </div>
        
                    <div class="card-body">
                        <table id="book-requests-table" class="table table-bordered table-hover table-stripe">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Date Request</th>
                                    <th scope="col">Status</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookRequests as $bookRequest)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#modalBookRequest{{ $bookRequest->id }}">{{ $bookRequest->book->title }}</a>
                                            @include('borrower.book-requests.book-request-modal')
                                        </td>
                                        <td>{{ $bookRequest->book->author }}</td>
                                        <td>{{ $bookRequest->book->isbn }}</td>
                                        <td>{{ $bookRequest->requested_at }}</td>
                                        <td>{{ 'Status here' }}</td>
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
            });

        });
    </script>
@stop
