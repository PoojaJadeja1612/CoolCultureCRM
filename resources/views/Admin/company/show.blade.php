@extends('layouts.Admin.app')
@section('page', 'Company Details')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title ">
                <h3 class="card-label font-weight-bolder text-dark">Company Details</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('company.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row form-group">
                <div class="col-md-4">
                    <label><b>Name:</b> {{ $data->companyName }}</label>
                </div>
                <div class=" col-md-4">
                    <strong>GST:</strong> {{ $data->gst }}
                </div>
                <div class=" col-md-4">
                    <strong>PAN:</strong> {{ $data->pan }}
                </div>
            </div>
            <div class="row form-group">
                <div class=" col-md-4">
                    <strong>Email:</strong> {{ $data->companyEmail }}
                </div>
                <div class=" col-md-4">
                    <strong>Phone:</strong> {{ $data->companyPhone }}
                </div>
            </div>
            <div class="row form-group">
                <div class=" col-md-12">
                    <strong>Address:</strong> {{ $data->addressLine1 }}, {{ $data->addressLine2 }}, {{ $data->country }},
                    {{ $data->state }}, {{ $data->city }}, {{ $data->pincode }}.

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <Strong>Company Small Logo: </Strong>
                    <img src="{{ asset('Logo/' . $data->companySmallLogo) }}" alt="company small logo">
                </div>
                <div class="col-md-4">
                    <strong>Logo:</strong>
                    <img src="{{ asset('Logo/' . $data->companyLogo) }}" alt="company logo" height="150" width="250">
                </div>
                <div class="col-md-4">
                    <strong>Favicon:</strong>
                    <img src="{{ asset('Logo/' . $data->companyFavicon) }}" alt="company favicon">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2">
                    <label for="example-color-input" class="col-form-label">Primary Color</label>
                    <div style="background-color: {{ $data->primaryColor }}; height:15px; width:auto;"></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="example-color-input" class="col-form-label">Primary Font</label>
                    <div style="background-color: {{ $data->primaryFont }}; height:15px; width:auto;"></div>
                </div>

                <div class="form-group col-md-2">
                    <label for="example-color-input" class="col-form-label">Secondary Color</label>
                    <div style="background-color: {{ $data->secondaryColor }}; height:15px; width:auto;"></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="example-color-input" class="col-form-label">Secondary Font</label>
                    <div style="background-color: {{ $data->secondaryFont }}; height:15px; width:auto;"></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="example-color-input" class="col-form-label">Hovor Color</label>
                    <div style="background-color: {{ $data->hovorColor }}; height:15px; width:auto;"></div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('company.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
