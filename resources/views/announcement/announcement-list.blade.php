@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Announcements')

@section('content_header')
    <h2 class="pl-1">Announcements</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#announcementModal"><i class="fas fa-fw fa-bullhorn"></i> Create Announcement</button>
                    @include('announcement.announcement-modal')
                </div>
            </div>

            <div class="card-body">
                <table id="announcements-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{!! $announcement->title !!}</td>
                                <td>{!! $announcement->created_at->format('Y-m-d g:i A') !!}</td>
                                <td>
                                    <a href="{{ route('announcements.show', ['announcement' => $announcement->id]) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-fw fa-edit"></i> Update
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAnnouncementModal{{ $announcement->id }}">
                                        <i class="fas fa-fw fa-trash"></i> Delete
                                    </button>
                                    @include('announcement.announcement-delete-modal')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Announcement/s available.</td>
                            </tr>
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
