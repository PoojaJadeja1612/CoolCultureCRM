@extends('layouts.Admin.app')
@section('page', 'Activity Details')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Activity Details
                </h3>
            </div>
            {{-- <div class="card-toolbar">
                <a href="{{ route('activity.index') }}" class="btn btn-primary font-weight-bolder">
                    </span>Back</a>
            </div> --}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Customer Name:</strong>
                        {{ $activity->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Technician Name:</strong>
                        {{ $activity->technician_name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Address:</strong>
                        {{ $activity->Address }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Date:</strong>
                        {{ $activity->date }}
                    </div>
                </div>


                <table class="table table-separate table-head-custom table-checkable" id="example_datatable">
                    <thead>
                        <tr>
                            <th>Work</th>
                            <th>Quantity</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activityWork as $key => $activityWorks)
                            <tr>
                                <td>{{ $activityWorks->name }}</td>
                                <td>{{ $activityWorks->quantity }}</td>
                                <td>{{ $activityWorks->remark }}</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
