@extends('layouts.borrower')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Notifications')

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
                        <strong>Notifications</strong>
                        <div class="float-right d-inline-flex">
                        </div>
                    </div>
        
                    <div class="card-body">
                        <table id="book-requests-table" class="table table-bordered table-hover table-stripe">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Message</th>
        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($notifications as $notification)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a href="{!! $notification->data['action_url']!!}">
                                                {!! $notification->data['message'] !!}
                                            </a>
                                        </td>
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
