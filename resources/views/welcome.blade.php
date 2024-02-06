@extends('layouts.app')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center mb-5 bg-info border shadow-sm p-3">
                    <img src="/img/ashi-library-logo.png" alt="" class="img-fluid mx-3" style="width: 100px; height: 100px;">
                    <div class="text-center">
                        <h1 class="mb-0 mt-3 font-weight-bolder text-white">Amaya School of Home Industries</h1>
                        <p><strong>Web-based Library System</strong></p>
                    </div>
                    <img src="/img/ashi-logo.png" alt="" class="img-fluid mx-3" style="width: 100px; height: 100px;">
                </div>
            </div>

            <div class="col-md-4">

                <div class="calendar card rounded-0 p-3 text-dark bg-light shadow-sm mb-3">
                    <div id="calendar-basic"></div>
                </div>
                

                <x-announcement-widget :announcements="$announcements" />

                <div class="card rounded-0 shadow-sm mb-3 text-left" id="accordionAnnouncement">
                    <div class="card-header px-4">
                        <h6 class="mb-0 font-weight-bold text-danger">Penalty Notice</h6>
                    </div>
                    <div class="card-body p-3">
                        <small><strong>Overdue books are subject to a Php 50.00 penalty.</strong></small>    
                    </div>   
                    
                </div>
            </div>

            <div class="col-md-8">
                <div id="books">
                    @include('layouts.message')
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0 text-info"><strong>Book List</strong></h6>
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
                                            {{-- <th scope="col">ISBN</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($books as $book)
                                            <tr>
                                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                                <td>{{ $book->title }}</td>
                                                <td>{{ $book->author }}</td>
                                                {{-- <td>{{ $book->isbn }}</td> --}}
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
    <style>
        .navbar-brand {
            display: none !important;
        }
    </style>
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
