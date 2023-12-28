@extends('layouts.Admin.app')
@section('page', 'Edit Role')
@section('content')
    {!! Form::model($role, ['method' => 'PATCH', 'id' => 'roleForm', 'route' => ['roles.update', $role->id]]) !!}
    @csrf
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Edit Role</h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Name<span class="text-danger">*</span></label>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <strong><label>
                            {{ Form::checkbox('check_all', null, false, ['class' => 'check-all-checkbox']) }}
                            Check All
                        </label>
                    </strong><br />
                    @php
                        $prevData = null;
                    @endphp

                    @foreach ($permission as $index => $data)
                        @if ($index === 0 || explode('-', $data->name)[0] !== $prevData)
                            @if ($index !== 0)
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
                <label><strong>{{ ucfirst($exceptLast) }}
                        module <input type="checkbox" data-id="{{ $className }}" id="{{ $className }}"
                            class="roleModule"></strong></label>

                <div class="row mb-3">
                    @endif

                    <div class="col-md-3 border">
                        <label
                            class="mb-0 p-2">{{ Form::checkbox('permission[]', $data->id, in_array($data->id, $rolePermissions) ? true : false, ['class' => 'name border-checkbox ' . $className]) }}
                            {{ $data->name }}</label>
                    </div>

                    @php
                        $prevData = explode('-', $data->name)[0];
                    @endphp
                    @endforeach

                    @if (!empty($permission))
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-2">Update</button>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancel</a>
    </div>

    </div>
    {!! Form::close() !!}
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#roleForm').validate({
                errorClass: 'is-invalid',
                rules: {
                    name: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter role name",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        const checkAllCheckbox = document.querySelector('.check-all-checkbox');
        const borderCheckboxes = document.querySelectorAll('.border-checkbox');

        checkAllCheckbox.addEventListener('change', function() {
            const isChecked = checkAllCheckbox.checked;
            borderCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        $(".roleModule").change(function() {
            var className = $(this).data('id');
            if ($('#' + className).prop("checked")) {
                $('.' + className).prop("checked", true);
            } else {
                $('.' + className).prop("checked", false);
            }
        });
    </script>

@endsection
