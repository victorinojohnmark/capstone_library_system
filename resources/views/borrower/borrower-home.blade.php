@extends('layouts.borrower')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Welcome')

@section('content_header')
    <h2>Dashboard</h2>
@stop

@section('content')
    <div class="container">
        <div class="row">
            
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
