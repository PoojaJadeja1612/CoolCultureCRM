@extends('layouts.Admin.app')
@section('page', 'Technician Reports')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <form id="searchForm" action="{{ route('technicianSearch') }}" method="get">
                    @csrf
                    <div class="card card-custom" style="width: 120%;">
                        <div class="card-header py-3">
                            <div class="card-title">
                                <h3 class="card-label font-weight-bolder text-dark">Technician Report</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Technician Name</label>
                                    <select id="name" name="name" class="form-control technician">
                                        <option value="" selected disabled>Select Technician</option>
                                        @foreach ($techActivity as $tech)
                                            <option value="{{ $tech->id }}">{{ $tech->technician_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>From Date</label>
                                    {!! Form::date('fromdate', null, [
                                        'placeholder' => 'date',
                                        'class' => 'form-control',
                                        'max' => now()->format('Y-m-d'),
                                    ]) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label>To Date</label>
                                    {!! Form::date('todate', null, [
                                        'placeholder' => 'date',
                                        'class' => 'form-control',
                                        'max' => now()->format('Y-m-d'),
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="searchButton" class="btn btn-primary mr-2">Search</button>
                            <button type="button" id="exportButton" class="btn btn-secondary mr-2">Download</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="example">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>Technician Name</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Work</th>
                        <th>Remark</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $reports)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $reports->technician_name }}</td>
                            <td>{{ $reports->name }}</td>
                            <td>{{ $reports->Address }}</td>
                            <td>{{ $reports->work_name }}</td>
                            <td>{{ $reports->remark }}</td>
                            <td>{{ $reports->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#searchButton').on('click', function() {
                $('#searchForm').submit();
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

<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script>
   $(document).ready(function() {
       var table = $('#example').DataTable({
           "columnDefs": [
               { "orderable": false, "targets": -1 } // Disable sorting for the last column (Actions)
           ],
           // Your other DataTable options go here
           "order": [[ 1, "asc" ]] // Example: Sorting by the second column in ascending order
       });

       // Export to Excel function
       $('#exportButton').on('click', function() {
           var filteredData = table.rows({ search: 'applied' }).data().toArray();
           var headers = ['Sr No', 'Technician Name', 'Customer Name', 'Address', 'Work', 'Remark', 'Quantity']; // Define selected headers
           exportToExcel(filteredData, headers);
       });

       function exportToExcel(data, headers) {
           // Create a CSV content string with headers
           var csvContent = headers.map(function(header) {
               return `"${header}"`;
           }).join(",") + "\r\n";

           // Convert data to CSV format
           data.forEach(function(rowArray) {
               var rowData = rowArray.map(function(value) {
                   // Trim each value to remove extra spaces and replace multiple spaces with a single space
                   return value.trim().replace(/\s+/g, ' ');
               });

               for (var i = 0; i < rowData.length; i++) {
                   // Check if the value contains a comma
                   if (rowData[i].includes(',')) {
                       // Enclose the value within double quotes and escape existing double quotes
                       rowData[i] = '"' + rowData[i].replace(/"/g, '""') + '"';
                   }
               }

               var row = rowData.join(",");
               csvContent += row + "\r\n";
           });

           // Create a Blob object
           var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8' });

           // Create a temporary anchor element
           var link = document.createElement('a');
           link.href = window.URL.createObjectURL(blob);
           link.setAttribute('download', 'Technician_Reports.csv');

           // Append the anchor element to the body
           document.body.appendChild(link);

           // Trigger the click event to initiate download
           link.click();
       }
   });
</script>
@endsection
