@extends('layouts.Admin.app')
@section('page', 'Activity Management')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Activity Management
                </h3>
            </div>
            <div class="card-toolbar">
                @can('customer-create')
                    <a href="{{ route('activity.create') }}" class="btn btn-primary font-weight-bolder">
                        </span>Add New Activity</a>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>Technician</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activitys as $key => $activity)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $activity->technician_name }}</td>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->Address }}</td>
                            <td>{{ $activity->date }}</td>
                            <td>
                                <a class="btn btn-sm btn-clean btn-icon" href="{{ route('activity.show', $activity->id) }}"
                                    title="Show"><i class="la la-eye"></i></a>

                                {{-- @can('user-edit') --}}
                                    <a class="btn btn-sm btn-clean btn-icon" href="{{ route('activity.edit', $activity->id) }}"
                                        title="Edit"><i class="la la-edit"></i></a>
                                {{-- @endcan --}}
                                
                                {{-- @can('user-delete') --}}
                                    <a class="btn btn-sm btn-clean btn-icon" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_new_card-{{ $activity->id }}" title="Delete"><button
                                            class="btn btn-sm btn-clean btn-icon"><i class="la la-trash"></i></button></a>
                                {{-- @endcan --}}

                            </td>
                        </tr>
                        <div class="modal fade" id="kt_modal_new_card-{{ $activity->id }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Confirm</h5>
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <span class="svg-icon svg-icon-1">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                    viewBox="0 0 24 24" version="1.1">
                                                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                                        fill="#000000">
                                                        <rect fill="#000000" x="0" y="7" width="16"
                                                            height="2" rx="1" />
                                                        <rect fill="#000000" opacity="0.5"
                                                            transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                                            x="0" y="7" width="16" height="2"
                                                            rx="1" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['activity.destroy', $activity->id], 'style' => 'display:inline']) !!}
                                    @method('DELETE')
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <p>Are you sure you want to delete
                                            this record ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
@endsection
