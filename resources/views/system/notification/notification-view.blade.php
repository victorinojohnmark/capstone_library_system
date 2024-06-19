@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Notifications')

@section('content_header')
    <h2 class="pl-1">Notifications</h2>
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
                <table id="notifications-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Message</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($notifications as $notification)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    {!! $notification->data['message'] !!}
                                </td>
                                <td><a href="{{ route('notification.markAsRead', ['id' => $notification->id]) }}" class="btn btn-primary btn-sm">Mark as Read</a></td>
                                {{-- <td>{{ $transaction->status }}</td> --}}
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
