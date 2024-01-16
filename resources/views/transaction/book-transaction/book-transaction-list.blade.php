@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book Requests')

@section('content_header')
    <h2 class="pl-1">Book Transactions</h2>
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
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="available-transaction-tab" data-toggle="tab" data-target="#available-transaction"
                            type="button" role="tab" aria-controls="available-transaction" aria-selected="true">Available Books</button>
                        <button class="nav-link" id="reservation-transaction-tab" data-toggle="tab" data-target="#reservation-transaction"
                            type="button" role="tab" aria-controls="reservation-transaction" aria-selected="true">Book Reservations</button>
                        <button class="nav-link" id="borrow-transaction-tab" data-toggle="tab" data-target="#borrow-transaction"
                            type="button" role="tab" aria-controls="borrow-transaction" aria-selected="true">Borrowed Books</button>
                        {{-- <button class="nav-link" id="return-transaction-tab" data-toggle="tab" data-target="#return-transaction"
                            type="button" role="tab" aria-controls="return-transaction" aria-selected="false">Returns</button> --}}
                    </div>
                </nav>
                <div class="tab-content py-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="available-transaction" role="tabpanel" aria-labelledby="available-transaction-tab">
                        @include('transaction.book-transaction.available-books-list')
                    </div>
                    <div class="tab-pane fade show" id="reservation-transaction" role="tabpanel" aria-labelledby="reservation-transaction-tab">
                        @include('transaction.book-transaction.books-with-reservations-list')
                    </div>
                    <div class="tab-pane fade show" id="borrow-transaction" role="tabpanel" aria-labelledby="borrow-transaction-tab">
                        @include('transaction.book-transaction.borrowed-books-list')
                    </div>
                    {{-- <div class="tab-pane fade show" id="return-transaction" role="tabpanel" aria-labelledby="return-transaction-tab">
                        Returns
                    </div> --}}
                </div>
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
            $('.datatable').DataTable({
                "order": [],
            });

            $('#borrowedBookDatatable').DataTable({
                "order": [],
                "searching": false
            });

        });
    </script>
@stop
