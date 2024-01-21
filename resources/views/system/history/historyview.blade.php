@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book History')

@section('content_header')
    <h2 class="pl-1">Book History</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    
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
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr data-toggle="tooltip" data-placement="top" title="{{ $book->remarks }}">
                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                <td>
                                    <strong><a href="#" data-toggle="modal" data-target="#modalBook{{ $book->id }}">{{ $book->title }}</a></strong>
                                    @include('system.history.historymodal')
                                </td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->isbn }}</td>
                                <td>
                                    {{ $book->status }}
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
@stop
