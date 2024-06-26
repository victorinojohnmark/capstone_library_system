@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book Requests')

@section('content_header')
    <h2 class="pl-1">Book Requests</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBook"><i class="fas fa-fw fa-book"></i> Add Book</button> --}}
                </div>
            </div>

            <div class="card-body">
                <table id="book-requests-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Book</th>
                            <th scope="col">Author</th>
                            {{-- <th scope="col">ISBN</th> --}}
                            <th scope="col">Date Request</th>
                            <th scope="col">Status</th>
                            <th scope="col">Option</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookRequests as $bookRequest)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $bookRequest->user->name }}</td>
                                <td>
                                    {{-- <a href="#" data-toggle="modal" data-target="#modalBookRequest{{ $bookRequest->id }}"> --}}
                                        {{ $bookRequest->book->title }}
                                    {{-- </a> --}}
                                    {{-- @include('borrower.book-requests.book-request-modal') --}}
                                </td>
                                <td>
                                    @forelse (json_decode($bookRequest->book->author, true) as $author)
                                        <span class="badge badge-success">{{ $author }}</span>
                                    @empty
                                        
                                    @endforelse
                                </td>
                                {{-- <td>{{ $bookRequest->book->isbn }}</td> --}}
                                <td>{{ $bookRequest->requested_at }}</td>
                                <td>{{ $bookRequest->status }}</td>
                                <td>
                                    @if (!$bookRequest->rejected_at && !$bookRequest->approved_at)
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
                                    @endif
                                    
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    
    {{-- <link rel="stylesheet" href="/css/custom.css"> --}}
    @vite(['public/css/custom.css'])
    <link rel="stylesheet" href="/vendor/datatables/datatables.min.css">
@stop

@push('css')
    
@endpush

@section('js')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script>
        $(document).ready(function () {
            $('#book-requests-table').DataTable({
                "order": [],
                columns: [
                    { data: 'number', visible: true }, 
                    { data: 'name', visible: true }, 
                    { data: 'book', visible: true }, 
                    { data: 'author', visible: true }, 
                    { data: 'date_request', visible: true },
                    { data:'status', visible: true },
                    { data: 'options', visible: true }, 
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Include the invisible column
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Include the invisible column
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5] // Include the invisible column
                        }
                    },
                    
                ]
            });

            $('#borrowedBookTable').DataTable({
                "order": [],
                columns: [
                    { data: 'number', visible: true }, 
                    { data: 'name', visible: true }, 
                    { data: 'book', visible: true }, 
                    { data: 'date_borrowed', visible: true }, 
                    { data: 'due_date', visible: true }, 
                    { data: 'options', visible: true }, 
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4] // Include the invisible column
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4] // Include the invisible column
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4] // Include the invisible column
                        }
                    },
                    
                ]
            });

        });
    </script>
@stop
