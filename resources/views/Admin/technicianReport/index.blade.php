@extends('layouts.Admin.app')
@section('page', 'Technician Management')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                {{-- <h3 class="card-label font-weight-bolder text-dark">
                    Technician Report
                </h3> --}}
                {{-- {{ dd($techActivity); }} --}}
                <form id="searchForm" action="{{ route('technicianSearch') }}" method="get">
                    @csrf
                    <div class="card card-custom" style="width: 167%;">
                        <div class="card-header py-3">
                            <div class="card-title">
                                <h3 class="card-label font-weight-bolder text-dark">Technician Report</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Technician Name</label>
                                    <select id="name" name="name" class="form-control">
                                        <option value="" selected disabled>Select Technician</option>
                                        @foreach ($techActivity as $tech)
                                            <option value="{{ $tech->id }}">{{ $tech->technician_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Date</label>
                                    {!! Form::date('date', null, [
                                        'placeholder' => 'date',
                                        'class' => 'form-control',
                                        'max' => now()->format('Y-m-d'),
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option>Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="searchButton" class="btn btn-primary mr-2">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>Technician Name</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $reports)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reports->technician_name }}</td>
                            <td>{{ $reports->name }}</td>
                            <td>
                                @if ($reports->status == '1')
                                    Active
                                @elseif ($reports->status == '0')
                                    Inactive
                                @else
                                    NULL
                                @endif
                            </td>
                            <td>{{ $reports->Address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#searchButton').on('click', function() {
                $('#searchForm').submit();
            });
        });
    </script>
@endsection
