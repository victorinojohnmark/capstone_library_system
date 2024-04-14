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
                        <small><strong>Overdue books are subject to 2 pesos per day.</strong></small>    
                    </div>   
                    
                </div>
            </div>

            <div class="col-md-8">
                <div id="books">
                    @include('layouts.message')
                    
                    <div id="libraryGallery" class="carousel slide mb-3" data-ride="carousel">
                        <ol class="carousel-indicators">
                            
                            
                            @forelse ($galleries as $gallery)
                                <li data-target="#libraryGallery" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @empty   
                            @endforelse
                        </ol>

                        <div class="carousel-inner">

                          @forelse($galleries as $gallery)
                            <div class="carousel-item {{ $loop->first? 'active' : '' }}">
                                <img src="{{ '/storage/gallery/'. $gallery->file }}" class="d-block w-100" style="object-fit: cover; aspect-ratio: 4/2" alt="...">
                            </div>
                          @empty
                            <div class="carousel-item active">
                                <img src="https://placehold.co/600x400?text=Welcome" style="object-fit: cover; aspect-ratio: 4/2" class="d-block w-100" alt="...">
                            </div>
                          @endforelse

                        
                          
                        </div>
                       <button class="carousel-control-prev" type="button" data-target="#libraryGallery" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#libraryGallery" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </button>
                    </div>

                    <div class="card text-white bg-info mb-3 d-block w-100 rounded-lg">
                        
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center">
                                <span class="bg-warning p-2 px-4 rounded-pill font-weight-bolder" style="color: #A47525; z-index: 10;">MISSION</span>
                                <p class="bg-white text-dark p-3 rounded-lg font-weight-bolder" style="margin-top: -13px;">{!! $appSetting->mission !!}</p>
                            </div>

                            <div class="d-flex flex-column align-items-center">
                                <span class="bg-warning p-2 px-4 rounded-pill font-weight-bolder" style="color: #A47525; z-index: 10;">VISION</span>
                                <p class="bg-white text-dark p-3 rounded-lg font-weight-bolder" style="margin-top: -13px;">{!! $appSetting->vision !!}</p>
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
