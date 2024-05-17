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
                    <a href="{{ route('book-create') }}"><i class="fas fa-fw fa-book"></i> Add Book</a>
                    {{-- @include('master.books.bookmodal') --}}
                </div>
            </div>

            <div class="card-body">
                <table id="books-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            {{-- <th scope="col">Author</th> --}}
                            {{-- <th scope="col">ISBN</th> --}}
                            <th scope="col">Category</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Year</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Current Stock</th>
                            <th scope="col">Condition</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr data-toggle="tooltip" data-placement="top" title="{{ $book->remarks }}">
                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                <td>
                                    <strong><a href="{{ route('book-show', ['book' => $book->id]) }}">{{ $book->title }}</a></strong>
                                    {{-- @include('master.books.bookmodal') --}}
                                </td>
                                {{-- <td>{{ $book->author }}</td> --}}
                                {{-- <td>{{ $book->isbn }}</td> --}}
                                <td>{{ $book->category }}</td>
                                <td>{{ $book->subject ?? '-' }}</td>
                                <td>{{ $book->year }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>{{ $book->current_stock }}</td>
                                <td>{{ $book->condition }}</td>
                                <td>
                                    {{ $book->status }}
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#bookModal{{ $book->id }}"><i class="fas fa-trash"></i></button>
                                    <div class="modal fade" id="bookModal{{ $book->id ?? null }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Delete Book Confirmation</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('book-delete', ['book' => $book->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{ $book->id }}">
                                                <p>Are you sure you want to delete this book from the record?</p>
                                                <p>Book: <strong>{{ $book->title }}</strong></p>
                                                <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
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
            $('#books-table').DataTable({
                "order": [],
            });

        });
    </script>
@stop
