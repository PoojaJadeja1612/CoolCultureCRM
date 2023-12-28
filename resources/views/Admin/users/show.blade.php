@extends('layouts.Admin.app')
@section('page', 'User Details')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    User Details
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('users.index') }}" class="btn btn-primary font-weight-bolder">
                    </span>Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Mobile Number:</strong>
                        {{ $user->number }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Roles:</strong>
                        @if (!empty($user->getRoleNames()))
                            @foreach ($user->getRoleNames() as $v)
                                <label class="">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                        @if ($user->userStatus == '0')
                            <label class="">Inactive</label>
                        @else
                            <label class="">Active</label>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
