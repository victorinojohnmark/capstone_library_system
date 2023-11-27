@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Announcements')

@section('content_header')
    <h2 class="pl-1">Announcement</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <h1>{!! $announcement->title !!}</h1>
            </div>

            <div class="card-body">
                @include('announcement.announcement-form')
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
    <script src="{{ asset('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script>
        $(document).ready(function () {
            $('#announcements-table').DataTable({
                "order": [],
            });

        });

        tinymce.init({
            selector: '.tinymce-editor'
        });
    </script>
@stop
