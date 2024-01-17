@extends('layouts.borrower')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Borrowed Books')

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
                        <strong>Borrowed Books</strong>
                        <div class="float-right d-inline-flex">
                            {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBookRequest"><i class="fas fa-fw fa-book"></i> Create Request</button> --}}
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
                                    <th scope="col">Date Borrowed</th>
                                    <th scope="col">Due Date</th>
                                    {{-- <th scope="col">Status</th> --}}
        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($borrowedBookTransactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $transaction->book->title }}
                                            @if ($transaction->book->latestBorrowedTransaction->is_overdue)
                                            <span class="badge badge-danger inline">Overdue</span>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->book->author }}</td>
                                        <td>{{ $transaction->book->isbn }}</td>
                                        <td>{{  $transaction->borrowed_at }}</td>
                                        <td>{{  $transaction->due_date }}</td>
                                        {{-- <td>{{ $transaction->status }}</td> --}}
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
