@extends('layouts.Admin.app')
@section('page', 'Create Activity')
@section('content')
    {!! Form::open(['route' => 'activity.store', 'method' => 'POST', 'id' => 'user']) !!}
    @csrf
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Create New Activity</h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Create</button>
                <a href="{{ route('activity.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- <div class="form-group col-md-4">
                    <label for="customer_name">Customer Name</label>
                    <select id="name" name="name" class="form-control customername">
                        <option value="" selected disabled>Select Customer</option>
                        @foreach ($customer as $customers)
                            <option value="{{ $customers->id }}">{{ $customers->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group col-md-4">
                    <label for="customer_name">Customer Name</label>
                    <select id="name" name="name" class="form-control customername">
                        <option value="" selected disabled>Select Customer</option>
                        @foreach ($customer as $customers)
                            <option value="{{ $customers->id }}">{{ $customers->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label>Address</label>
                    <input type="text" name="Address" placeholder="Address" readonly class="form-control address">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Technician Name</label>
                    <select id="technician" name="technician" class="form-control technician">
                        <option value="" selected disabled>Select Technician</option>
                        @foreach ($technician as $technicians)
                            <option value="{{ $technicians->id }}">{{ $technicians->technician_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Date</label>
                    {!! Form::date('date', null, [
                        'placeholder' => 'date',
                        'class' => 'form-control',
                        'max' => now()->format('Y-m-d'),
                    ]) !!}
                </div>
                <div class="form-group col-md-4">
                    <label>Status</label>
                    {!! Form::select('status', ['1' => 'Active', '0' => 'InActive'], null, [
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5">
                    <label>Work Done</label>
                    <select id="work" name="work[]" class="form-control work">
                        <option value="" selected disabled>Select Work Done</option>
                        @foreach ($work as $works)
                            <option value="{{ $works->id }}">{{ $works->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Remark</label>
                    {!! Form::text('remark[]', null, ['placeholder' => 'Remark', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group col-md-1">
                    <label></label>
                    <button type="addfield" class="btn btn-success form-control mt-2 addfield">+</button>
                </div>
            </div>
            <div class="appendfield">

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Create</button>
            <a href="{{ route('activity.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('script')

    <script type="text/javascript">
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#user').validate({
                errorClass: 'is-invalid',
                rules: {
                    name: {
                        required: true,
                    },
                    address1: {
                        required: true,

                    },
                },
                messages: {
                    name: {
                        required: "Please enter name  ",
                    },
                    address1: {
                        required: "Please enter Address1  ",

                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            })
        });
    </script> --}}

    <script type="text/javascript">
        jQuery('.customername').change(function() {
            $('.address').empty();
            var customername = this.value;

            $.ajax({
                url: '{{ url('Admin/getaddress') }}',
                type: "GET",
                data: {
                    customername: customername
                },
                success: function(response) {
                    console.log(response);
                    $('.address').val(response.address1 + ', ' + response.address2 + ', ' + response.city + ', ' + response.state + ', ' + response.contry + ', ' + response.pincode);
                },
                error: function(error) {
                    console.error("Error:", error);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var max_fields = 10; // maximum input boxes allowed
            var wrapper = $(".appendfield"); // Fields wrapper
            var add_button = $(".addfield"); // Add button ID

            var x = 1; // initial text box count
            $(add_button).click(function(e) { // on add input button click
                e.preventDefault();
                if (x < max_fields) { // max input box allowed
                    x++; // text box increment
                    var options =
                        '@foreach ($work as $works) <option value="{{ $works->id }}">{{ $works->name }}</option> @endforeach';
                    var newField = `
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label>Work Done</label>
                            <select id="work${x}" name="work[]" class="form-control work">
                                <option value="" selected disabled>Select Work Done</option>
                                ${options}
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Remark</label>
                            {!! Form::text('remark[]', null, ['placeholder' => 'Remark', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-md-1">
                            <label></label>
                            <button type="button" class="btn btn-danger form-control mt-2 removefield">-</button>
                        </div>
                    </div>`;
                    $(wrapper).append(newField); // add input box

                    $(`#work${x}`).select2({
                        width: '100%', // Adjust the width as needed
                        placeholder: 'Search for a work',
                        allowClear: true // Option to clear the selected value
                    });
                }
            });

            $(wrapper).on("click", ".removefield", function(e) { // user click on remove text
                e.preventDefault();
                $(this).closest('.row').remove();
                x--;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.customername').select2({
                width: '100%', // Adjust the width as needed
                placeholder: 'Search for a customer',
                allowClear: true // Option to clear the selected value
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.technician').select2({
                width: '100%', // Adjust the width as needed
                placeholder: 'Search for a technician',
                allowClear: true // Option to clear the selected value
            });
        });
    </script>

    <script>
    $(document).ready(function () {
        $('.work').select2({
            width: '100%', // Adjust the width as needed
            placeholder: 'Search for a work',
            allowClear: true // Option to clear the selected value
        });
    });
</script>


@endsection