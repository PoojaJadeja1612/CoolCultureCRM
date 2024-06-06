@extends('layouts.Admin.app')
@section('page', 'Edit Activity')
{{-- @section('content') --}}
    <form id="editActivityForm" action="{{ route('activity.update', $activity->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="card card-custom" style="width: max-content; padding-top:60px;">
            <div class="card-header py-3">
                <div class="card-title">
                    <h3 class="card-label font-weight-bolder text-dark">Edit Activity</h3>
                </div>
                {{-- <div class="card-toolbar"> --}}
                    {{-- <button type="submit" class="btn btn-primary mr-2">Update</button> --}}
                    {{-- <a href="{{ route('activity.index') }}" class="btn btn-secondary">Cancel</a> --}}
                {{-- </div> --}}
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
                        <input type="text" name="Address" placeholder="Address" readonly value="{{ $activity->Address }}" class="form-control address">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Technician Name</label>
                        <select id="technician" name="technician" class="form-control technician">
                            <option value="" selected disabled>Select Technician</option>
                            @foreach ($technician as $technicians)
                                <option value="{{ $technicians->id }}" {{ $technicians->id == $activity->technician ? 'selected' : '' }}>
                                    {{ $technicians->technician_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Date</label>
                        <input type="date" placeholder="date" name="date" value="{{$activity->date}}" class="form-control" max="now()->format('Y-m-d')">
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
                    <div class="form-group col-md-2">
                        <label>Quantity</label>
                        <input type="text" name="quantity[0]" placeholder="Quantity" class="form-control" value="{{ $activityWork[0]->quantity }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Remark</label>
                        <input type="text" name="remark[0]" placeholder="Remark" class="form-control" value="{{ $activityWork[0]->remark }}">
                    </div>
                    <div class="form-group col-md-1">
                        <label></label>
                        <button type="button" class="btn btn-success form-control mt-2 addfield">+</button>
                    </div>
                </div>
                <div class="appendfield">
                    @foreach ($activityWork as $index => $workDone)
                        @if ($index > 0)
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label>Work Done</label>
                                    <select id="work{{ $index }}" name="work[{{ $index }}]" class="form-control work">
                                        <option value="" selected disabled>Select Work Done</option>
                                        @foreach ($work as $works)
                                            <option value="{{ $works->id }}" {{ $works->id == $workDone->work ? 'selected' : '' }}>{{ $works->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity[{{ $index }}]" placeholder="Quantity" class="form-control" value="{{ $workDone->quantity }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Remark</label>
                                    <input type="text" name="remark[{{ $index }}]" placeholder="Remark" class="form-control" value="{{ $workDone->remark }}">
                                </div>
                                <div class="form-group col-md-1">
                                    <label></label>
                                    <button type="button" class="btn btn-danger form-control mt-2 removefield">-</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="card-footer">
                    <button type="submit" id="updateActivityBtn" class="btn btn-primary mr-2">Update</button>
                    {{-- <a href="{{ route('activity.index') }}" class="btn btn-secondary">Cancel</a> --}}
                </div>
            </div>
        </div>
    </form>
{{-- @endsection --}}

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

        var x = {{ count($activityWork) }}; // initial text box count
        $(add_button).click(function(e) { // on add input button click
            e.preventDefault();
            if (x < max_fields) { // max input box allowed
                x++; // text box increment
                var options = '@foreach ($work as $works) <option value="{{ $works->id }}">{{ $works->name }}</option> @endforeach';
                var newField = `
                <div class="row">
                    <div class="form-group col-md-5">
                        <label>Work Done</label>
                        <select id="work${x}" name="work[]" class="form-control work">
                            <option value="" selected disabled>Select Work Done</option>
                            ${options}
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Quantity</label>
                        <input type="text" name="quantity[]" placeholder="Quantity" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Remark</label>
                        <input type="text" name="remark[]" placeholder="Remark" class="form-control">
                    </div>
                    <div class="form-group col-md-1">
                        <label></label>
                        <button type="button" class="btn btn-danger form-control mt-2 removefield">-</button>
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

<script>
    $(document).ready(function() {
        $('#updateActivityBtn').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: $('#editActivityForm').attr('action'),
                type: 'POST',
                data: $('#editActivityForm').serialize(),
                success: function(response) {
                },
                error: function(xhr) {
                    // Handle error response
                    console.log(xhr.responseText);
                    // For example, you can display validation errors or show a generic error message
                }
            });
        });
    });
</script>


@endsection
