@extends('layouts.Admin.app')
@section('page', 'Company Management')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Deleted company
                </h3>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $company)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $company->id }}</td>
                            <td>{{ $company->companyName }}</td>
                            <td>
                                <a class="btn btn-sm btn-clean btn-icon" href="{{ route('companyRestore', $company->id) }}"
                                    title="Restore"><i class="la la-rotate-left"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
@endsection
