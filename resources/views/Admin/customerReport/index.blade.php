@extends('layouts.Admin.app')
@section('page', 'Customer Reports')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <form id="searchForm" action="{{ route('customerSearch') }}" method="get">
                    @csrf
                    <div class="card card-custom" style="width: 129%;">
                        <div class="card-header py-3">
                            <div class="card-title">
                                <h3 class="card-label font-weight-bolder text-dark">Customer Report</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Customer Name</label>
                                    <select id="name" name="name" class="form-control">
                                        <option value="" selected disabled>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>From Date</label>
                                    {!! Form::date('fromdate', null, [
                                        'placeholder' => 'date',
                                        'class' => 'form-control',
                                        'max' => now()->format('Y-m-d'),
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label>To Date</label>
                                    {!! Form::date('todate', null, [
                                        'placeholder' => 'date',
                                        'class' => 'form-control',
                                        'max' => now()->format('Y-m-d'),
                                    ]) !!}
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
                        <th>Customer Name</th>
                        <th>Technician Name</th>  
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $reports)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reports->name }}</td>
                            <td>{{ $reports->technician_name }}</td>                            
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
