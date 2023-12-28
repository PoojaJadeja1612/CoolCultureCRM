@extends('layouts.Admin.app')
@section('page', 'Work Details')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Work Details
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('work.index') }}" class="btn btn-primary font-weight-bolder">
                    </span>Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $work->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
