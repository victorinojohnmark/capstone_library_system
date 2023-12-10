@extends('layouts.borrower')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Welcome')

@section('content_header')
    <h2>Dashboard</h2>
@stop

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Requested Book</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $reservedBookCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-bookmark fa-2x text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Borrowed Book</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $borrowedBookCount }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book fa-2x text-secondary"></i>
                    </div>
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
@stop
