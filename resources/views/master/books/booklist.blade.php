@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book List')

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
                    @include('master.books.bookmodal')
                </div>
            </div>

            <div class="card-body">
                <table id="books-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">Remarks</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr data-toggle="tooltip" data-placement="top" title="{{ $book->remarks }}">
                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                <td>
                                    <strong><a href="#" data-toggle="modal" data-target="#modalBook{{ $book->id }}">{{ $book->title }}</a></strong>
                                    @include('master.books.bookmodal')
                                </td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->remarks ?? '-' }}</td>
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
            $('#books-table').DataTable({
                "order": [],
            });

        });
    </script>
@stop
