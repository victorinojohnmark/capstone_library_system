@extends('adminlte::page')

@section('title', env('APP_NAME', 'LMS') . ' | ' .  'Borrower List')

@section('content_header')
    <h2 class="pl-1">Users/Borrowers</h2>
@stop

@section('content')
<div class="row justify-content-center pl-1">
    <div class="col-md-12">
        @include('layouts.message')
        <div class="card">
            <div class="card-header">
                <div class="float-right d-inline-flex">
                    <a href="{{ route('borrower-create') }}" class="btn btn-primary"><i class="fas fa-fw fa-user-plus"></i> Add Borrower</a>
                </div>
            </div>

            <div class="card-body">
                <table id="borrowers-table" class="table table-bordered table-hover table-stripe">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>
                            <th scope="col">LRN</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Section</th>
                            <th scope="col">Adviser</th>
                            <th scope="col">Department</th>
                            <th scope="col">Employee No</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($borrowers as $borrower)
                            <tr>
                                <td><strong>{{ $loop->index + 1 }}</strong></td>
                                <td>
                                    <strong><a href="{{ route('borrower-show', ['borrower' => $borrower->id]) }}">{{ $borrower->name }}</a></strong>
                                </td>
                                <td>{{ $borrower->type }}</td>
                                <td>{{ $borrower->lrn ?? '-' }}</td>
                                <td>{{ $borrower->grade ?? '-' }}</td>
                                <td>{{ $borrower->section_id ? $borrower->section->section_name : '-' }}</td>
                                <td>{{ $borrower->adviser_id ? $borrower->adviser->name : '-' }}</td>
                                <td>{{ $borrower->department ? $borrower->department->department_name : '-' }}</td>
                                <td>{{ $borrower->employee_no ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#borrowerModal{{ $borrower->id }}"><i class="fas fa-trash"></i></button>
                                    <div class="modal fade" id="borrowerModal{{ $borrower->id ?? null }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">Delete Borrower Confirmation</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <form action="{{ route('borrower-delete', ['borrower' => $borrower->id]) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="id" value="{{ $borrower->id }}">
                                                <p>Are you sure you want to delete this borrower from the record?</p>
                                                <p>Borrower: <strong>{{ $borrower->name }}</strong></p>
                                                <button type="submit" class="btn btn-danger btn-sm">Confirm Delete</button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </td>
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
