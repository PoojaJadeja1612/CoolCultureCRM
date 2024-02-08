@extends('layouts.Admin.app')
@section('page', 'Activity Details')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Activity Details
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('activity.index') }}" class="btn btn-primary font-weight-bolder">
                    </span>Back</a>
            </div>
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

                @foreach ($activityWork as $activityWorks)
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Work:</strong>
                        {{ $activityWorks->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Quantity:</strong>
                        {{ $activityWorks->quantity }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Remark:</strong>
                        {{ $activityWorks->remark }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
