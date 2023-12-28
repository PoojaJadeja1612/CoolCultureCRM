@extends('layouts.Admin.app')
@section('page', 'Edit Activity')
@section('content')
    {!! Form::model($activity, ['method' => 'PATCH', 'id' => 'user', 'route' => ['activity.update', $activity->id]]) !!}
    @csrf
    {{-- {{ dd($activity); }} --}}
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">Edit Activity</h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-primary mr-2">Update</button>
                <a href="{{ route('activity.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="customer_name">Customer Name</label>
                    <select id="name" name="name" class="form-control customername">
                        <option value="" selected disabled>Select Customer</option>
                        @foreach ($customer as $customers)
                            <option value="{{ $customers->id }}" {{ $customers->id == $activity->name ? 'selected' : '' }}>
                                {{ $customers->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-8">
                    <label>Address</label>
                    <input type="text" name="Address" placeholder="Address" readonly value="{{ $activity->Address }}"
                        class="form-control address">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Technician Name</label>
                    <select id="technician" name="technician" class="form-control technician">
                        <option value="" selected disabled>Select Technician</option>
                        @foreach ($technician as $technicians)
                            <option value="{{ $technicians->id }}"
                                {{ $technicians->id == $activity->technician ? 'selected' : '' }}>
                                {{ $technicians->technician_name }}</option>
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
                    <select id="work" name="work[0]" class="form-control work">
                        <option value="" selected disabled>Select Work Done</option>
                        @foreach ($work as $works)
                            <option value="{{ $works->id }}" {{ $works->id == $activityWork[0]->work ? 'selected' : '' }}>{{ $works->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label>Remark</label>
                    <input type="text" name="remark[0]" placeholder="Remark" class="form-control" value="{{ $activityWork[0]->remark }}">
                </div>
                {{-- <div class="form-group col-md-1">
                    <label></label>
                    <button type="addfield" class="btn btn-success form-control mt-2 addfield">+</button>
                </div> --}}
            </div>
            <div class="appendfield">

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">Update</button>
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
                    email: {
                        required: true,
                        email: true,

                    },
                    // number: {
                    //     required: true,
                    // },
                    roles: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter name  ",
                    },
                    email: {
                        required: "Please enter email  ",
                        email: "Please enter valid email"

                    },
                    // number: {
                    //     required: "Please enter number  ",
                    // },
                    roles: {
                        required: "Please select role ",
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
                    $('.address').val(response.address1);
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
                        <select id="work" name="work[]" class="form-control work">
                            <option value="" selected disabled>Select Work Done</option>
                            ${options}
                        </select>
                    </div>
                    <div class="form-group col-md-7">
                        <label>Remark</label>
                        {!! Form::text('remark[]', null, ['placeholder' => 'Remark', 'class' => 'form-control']) !!}
                    </div>
                </div>`;
                    $(wrapper).append(newField); // add input box
                }
            });

            $(wrapper).on("click", ".removefield", function(e) { // user click on remove text
                e.preventDefault();
                $(this).closest('.row').remove();
                x--;
            });
        });
    </script>

    {{-- <script>
    $(document).ready(function() {
        var getrecord = "{{ $jsonActivityWork }}";
        console.log(getrecord)
    });
</script> --}}

    <script>
        $(document).ready(function() {
            var getrecord = {!! $jsonActivityWork !!};
            // console.log(getrecord);

            var max_fields = 10; // maximum input boxes allowed
            var wrapper = $(".appendfield"); // Fields wrapper
            var add_button = $(".addfield"); // Add button ID

            var x = 1; // initial text box count
           console.log(getrecord)
            for (var i = 1; i < getrecord.length; i++) {
                console.log(getrecord[i].work);
                var options = '';
                @foreach ($work as $works)
        var selected = {{ $works->id }} == getrecord[i].work ? 'selected' : '';
        options += '<option value="{{ $works->id }}" ' + selected + '>{{ $works->name }}</option>';
    @endforeach
                $(wrapper).append(
                    '<div class="row"><div class="form-group col-md-5"><label>Work Done</label><select id="work${i}" name="work[]" class="form-control work"><option value="" selected disabled>Select Work Done</option>"'+ options +'"</select></div><div class="form-group col-md-7"><label>Remark</label><input type="text" name="remark[]" placeholder="Remark" class="form-control" value="' +
                        getrecord[i].remark +
                        '"></div></div>'
                );
                $(`#work${i}`).select2({
        width: '100%',
        placeholder: 'Search for a work',
        allowClear: true
    });
            }
        });
    </script>

<script>
    $(document).ready(function () {
        $('.customername').select2({
            width: '100%', // Adjust the width as needed
            placeholder: 'Search for a customer',
            allowClear: true // Option to clear the selected value
        });
    });
</script>

<script>
    $(document).ready(function () {
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
