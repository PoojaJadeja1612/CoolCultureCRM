@extends('layouts.Admin.app')
@section('page', 'User Management')
@section('content')
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <h3 class="card-label font-weight-bolder text-dark">
                    Users Management
                </h3>
            </div>
            {{-- <div class="card-toolbar">
                @can('user-create')
                    <a href="{{ route('users.create') }}" class="btn btn-primary font-weight-bolder">
                        </span>Add New User</a>
                @endcan
            </div> --}}
        </div>
        {{-- {{ dd($data) }} --}}
        <div class="card-body">
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>Sr.no</th>
                        <th>ID</th>
                        @if (Auth::user()->getRoleNames()[0] == 'Super Admin')
                            <th>Company Name</th>
                        @endif
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        @if ($user->getRoleNames()[0] != 'Super Admin')
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $user->id }}</td>
                                @if (Auth::user()->getRoleNames()[0] == 'Super Admin')
                                    <th>{{ $user->companyName }}</th>
                                @endif
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $v)
                                            {{ $v }}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if ($user->userStatus == '0')
                                        Inactive
                                    @else
                                        Active
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" href="{{ route('users.show', $user->id) }}"
                                        title="Show"><i class="la la-eye"></i></a>

                                    @can('user-edit')
                                        <a class="btn btn-sm btn-clean btn-icon" href="{{ route('users.edit', $user->id) }}"
                                            title="Edit"><i class="la la-edit"></i></a>
                                    @endcan
                                    {{-- @can('password-reset')
                                        <a class="btn btn-sm btn-clean btn-icon" href="password/{{ $user->id }}"
                                            title="Change Password"><i class="la la-unlock"></i></a>
                                    @endcan --}}

                                    @can('user-delete')
                                        <a class="btn btn-sm btn-clean btn-icon" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_new_card-{{ $user->id }}" title="Delete"><button
                                                class="btn btn-sm btn-clean btn-icon"><i class="la la-trash"></i></button></a>
                                    @endcan

                                    @if (Auth::user()->getRoleNames()[0] == 'Super Admin')
                                        <a class="btn btn-sm btn-clean btn-icon" data-bs-toggle="modal"
                                            data-bs-target="#login_modal_new_card-{{ $user->id }}"
                                            title="Login"><button class="btn btn-sm btn-clean btn-icon"><i
                                                    class="la la-user-plus"></i></button></a>
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="kt_modal_new_card-{{ $user->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Confirm</h5>
                                            <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                data-bs-dismiss="modal">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                                            fill="#000000">
                                                            <rect fill="#000000" x="0" y="7" width="16" height="2"
                                                                rx="1" />
                                                            <rect fill="#000000" opacity="0.5"
                                                                transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                                                x="0" y="7" width="16" height="2" rx="1" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
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
                                            {{-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} --}}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="login_modal_new_card-{{ $user->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                Confirm</h5>
                                            <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                data-bs-dismiss="modal">
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                                            fill="#000000">
                                                            <rect fill="#000000" x="0" y="7" width="16" height="2"
                                                                rx="1" />
                                                            <rect fill="#000000" opacity="0.5"
                                                                transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                                                x="0" y="7" width="16" height="2"
                                                                rx="1" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                        <form action="{{ route('proxy.login', ['user_id' => $user->id]) }}"
                                            method="GET">
                                            @csrf
                                            <div class="modal-body">
                                                <p>Are you sure you want to proxy login of user ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
@endsection
