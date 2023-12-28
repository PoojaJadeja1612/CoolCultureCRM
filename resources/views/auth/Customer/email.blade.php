@extends('layouts.Website.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form class="form" novalidate="novalidate" id="forgot_password" method="POST"
                            action="{{ route('customer.password.email') }}">
                            @csrf
                            <div class="text-center pb-8">
                                <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Forgotten Password ?
                                </h2>
                                <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password
                                </p>
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-3 px-4 rounded-lg font-size-h6 "
                                    type="email" placeholder="Email" name="email" autocomplete="email" id="email"
                                    value="{{ old('email') }}" autofocus />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                                <button type="submit"
                                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">{{ __('Send Password Reset Link') }}</button>
                                <a href="{{ route('customer.login') }}"
                                    class="btn btn-secondary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
