@extends('layouts.Admin.app')
@section('page', 'Create Permission')
@section('content')
    {!! Form::open(['route' => 'permission.store', 'id' => 'permission', 'method' => 'POST']) !!}
    @csrf
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Create New Permission</h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Create</button>
                <a href="{{ route('permission.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Name<span class="text-danger">*</span></label>
                    <input type="text" name="customName" class="form-control" placeholder="Name" id="name"
                        onfocusout="removeSpaces()">
                </div>
                <div class="form-group col-md-4">
                    <label>List-Create-edit-Delete Permission <input type="checkbox" class="form-control"
                            name="List-Create-edit-Delete-Permission" style="height:20px" id="permissionCheckbox"></label>
                </div>
            </div>
            <div class="row permissionrow">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control plist permission" id="plist" name="permissionName[]"
                        readonly>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control pcreate permission" id="pcreate" name="permissionName[]"
                        readonly>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control pedit permission" id="pedit" name="permissionName[]"
                        readonly>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control pdelete permission" id="pdelete" name="permissionName[]"
                        readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Create</button>
            <a href="{{ route('permission.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.permission').hide();
            $('.permissionrow').hide();

            $('#permission').validate({
                errorClass: 'is-invalid',
                rules: {
                    customName: {
                        required: true,
                    },
                },
                messages: {
                    customName: {
                        required: "Please enter permission name",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $('#permissionCheckbox').change(function() {
            if ($('#permissionCheckbox').prop("checked") == true) {
                $('.permission').show();
                $('.permissionrow').show();
                originalText = $('#name').val();
                removedSpacesText = originalText.replace(/[%\/\s]/g, "-").toLowerCase();
                $('#plist').val(removedSpacesText + '-list');
                $('#pcreate').val(removedSpacesText + '-create');
                $('#pedit').val(removedSpacesText + '-edit');
                $('#pdelete').val(removedSpacesText + '-delete');
            } else {
                $('.permission').hide();
                $('.permissionrow').hide();
            }
        });


        function removeSpaces() {
            if ($('#name').val() == '') {
                $('.permission').hide();
                $('.permissionrow').hide();
            } else {
                if ($('#permissionCheckbox').prop("checked") == true) {
                    $('#permissionCheckbox').trigger('change');
                    $('.permission').show();
                    $('.permissionrow').show();
                } else {
                    originalText = $('#name').val();
                    console.log(originalText)
                    removedSpacesText = originalText.replace(/[%\/\s]/g, "-").toLowerCase();
                    $('#name').val(removedSpacesText);
                }
            }
        }
    </script>

@endsection
