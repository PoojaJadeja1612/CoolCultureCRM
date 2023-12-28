@extends('layouts.Admin.app')
@section('page', 'Role Details')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Role Details
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('roles.index') }}" class="btn btn-primary font-weight-bolder">
                    </span>Back</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group col-md-12">
                        @php
                            $prevData = null;
                        @endphp

                        @foreach ($rolePermissions as $index => $data)
                            @if ($index === 0 || explode('-', $data->name)[0] !== $prevData)
                                @if ($index !== 0)
                    </div>
                </div>
                @endif

                <?php
                $array = explode('-', $data->name);
                $length = count($array);
                
                if ($length <= 1) {
                    echo implode(' ', $array);
                } else {
                    $exceptLast = implode(' ', array_slice($array, 0, -1));
                }
                
                $className = str_replace(' ', '', $exceptLast);
                ?>

                <div class="checkbox-group">
                    <label><strong>{{ ucfirst($exceptLast) }} module</strong></label>

                    <div class="row mb-3">
                        @endif

                        <div class="col-md-3 border">
                            <label class="mb-0 p-2">
                                {{ $data->name }}
                            </label>
                        </div>

                        @php
                            $prevData = explode('-', $data->name)[0];
                        @endphp
                        @endforeach

                        @if (!empty($rolePermissions))
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection
