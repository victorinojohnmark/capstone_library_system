@extends('layouts.borrower')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Book Requests - Books')

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
                        <strong>Books</strong>
                        <div class="float-right d-inline-flex">
                            <a href="{{ route('borrower.book-requests') }}" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-book"></i> Back to Book Request List</a>
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
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->isbn }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalBookRequest{{ $book->id ?? null }}">Request</a>
                                            <div class="modal fade" id="modalBookRequest{{ $book->id ?? null }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title">Book Request</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-row" action="/borrower/book-requests{{ $bookRequest->id ? '/' . $bookRequest->id : null }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                            <p>Are you sure you want to request the book: <br> <strong>{{ $book->title }}</strong>?</p>
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">Confirm</button>
                                                            </div>
                                                            
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
