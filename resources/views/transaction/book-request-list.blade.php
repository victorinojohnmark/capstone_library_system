@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book Requests')

@section('content_header')
    <h2 class="pl-1">Books</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBook"><i class="fas fa-fw fa-book"></i> Add Book</button>
                </div>
            </div>

            <div class="card-body">
                <table id="books-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Borrower</th>
                            <th scope="col">Book</th>
                            <th scope="col">Date</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">Remarks</th>

                        </tr>
                    </thead>
                    
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
            $('#books-table').DataTable({
                "order": [],
            });

        });
    </script>
@stop
