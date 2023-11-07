@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Borrower List')

@section('content_header')
    <h2 class="pl-1">Users/Borrowers</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBorrower"><i class="fas fa-fw fa-user-plus"></i> Add Borrower</button>
                    @include('master.borrowers.borrowermodal')
                </div>
            </div>

            <div class="card-body">
                <table id="borrowers-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">LRN</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Section</th>
                            <th scope="col">Adviser</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($borrowers as $borrower)
                            <tr>
                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                <td><strong><a href="#">{{ $borrower->name }}</a></strong></td>
                                <td>{{ $borrower->lrn ?? '-' }}</td>
                                <td>{{ $borrower->grade_id ?? '-' }}</td>
                                <td>{{ $borrower->section_id ?? '-' }}</td>
                                <td>{{ $borrower->adviser_id ?? '-' }}</td>
                                <td>{{ $borrower->type }}</td>
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
    <script src="/vendor/datatables/datatables.min.js"></script>
    <script src="/js/custom.js"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <script>
        $(document).ready(function () {
            $('#borrowers-table').DataTable({
                "order": [],
            });

        });
    </script>
@stop
