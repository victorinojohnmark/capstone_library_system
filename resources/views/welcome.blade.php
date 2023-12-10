@extends('layouts.app')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center mb-5 bg-white border shadow-sm p-3">
                    <img src="/img/ashi-library-logo.png" alt="" class="img-fluid mx-3" style="width: 100px; height: 100px;">
                    <div class="text-center">
                        <h1 class="mb-0 mt-3 font-weight-bolder text-secondary">Amaya School of Home Industries</h1>
                        <p>Library Management System</p>
                    </div>
                    <img src="/img/ashi-logo.png" alt="" class="img-fluid mx-3" style="width: 100px; height: 100px;">
                </div>
            </div>

            <div class="col-md-4">

                {{-- Calendar Widget --}}
                <div class="calendar card rounded-0 p-3 bg-white shadow-sm mb-3">
                    <div id="calendar-basic"></div>
                </div>
                

                <x-announcement-widget :announcements="$announcements" />

            </div>

            <div class="col-md-8">
                <div id="books">
                    @include('layouts.message')
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0"><strong>Book List</strong></h6>
                            <div class="float-right d-inline-flex">
                                
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="books-table" class="table table-bordered table-hover table-stripe">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">ISBN</th>
                                            <th scope="col">Publisher</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($books as $book)
                                            <tr>
                                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->author }}</td>
                                                <td>{{ $book->isbn }}</td>
                                                <td>{{ $book->publisher }}</td>
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

            


        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/vendor/datatables/datatables.min.css">
    <link rel="stylesheet" href="/vendor/zabuto-calendar/zabuto_calendar.min.css">
@stop

@section('js')
    <script src="/vendor/jquery/jquery.min.js"></script>
    {{-- <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <script src="/vendor/datatables/datatables.min.js"></script>
    <script src="/vendor/zabuto-calendar/zabuto_calendar.min.js"></script>
    <script src="/js/custom.js"></script>
    <script>
        $(document).ready(function () {
            $('#books-table').DataTable({
                "order": [],
            });

            // $('#calendar-basic').zabuto_calendar();

            $("#calendar-basic").zabuto_calendar({
                header_format: '[month] [year]',
                week_starts: 'sunday',
                show_days: true,
                today_markup: '<span class="badge bg-primary text-white p-1">[day]</span>',
                navigation_markup: {
                    prev: '<i class="fas fa-chevron-circle-left"></i>',
                    next: '<i class="fas fa-chevron-circle-right"></i>'
                }
            });

        });
        
    </script>
@stop
