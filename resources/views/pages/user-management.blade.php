@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management', 'url' => route('members')])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h6>Users</h6>
                    @if (Auth::user()->UserRoles->role_role_id == 1)
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Role</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Create Date</th>
                                    @if (Auth::user()->UserRoles->role_role_id == 1)
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="px-2">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->user_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @forelse ($user->UserRoles->roles ?? [] as $role)
                                                <p class="text-sm font-weight-bold mb-0">{{ $role->role_name }}</p>
                                            @empty
                                                <p class="text-sm text-muted mb-0">No roles</p>
                                            @endforelse
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $user->created_at }}</p>
                                        </td>
                                        @if (Auth::user()->UserRoles->role_role_id == 1)
                                            <td class="align-middle text-center text-sm">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        onclick="editUser({{ $user->user_id }})">Edit </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteUserModal">Delete</button>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user_name_edit" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_name_edit" name="user_name_edit"
                                value="{{ $user->user_name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="email_edit" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_edit" name="email_edit"
                                value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="role_id_edit" class="form-label">Role</label>
                            <select class="form-select" id="role_id_edit" name="role_id_edit" required>
                                <option value="" selected disabled hidden>Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('members.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div>
                            <label class="form-label">Role</label>
                        </div>
                        <div class="mb-3">
                            <select class="form-select" id="role_id" name="role_id" required>
                                <option value="" selected disabled hidden>Select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editUser(userId) {
            $('#editUserModal').modal('show');
            $('#user_name_edit').val();
            $('#email_edit').val();
            $('#role_id_edit').val();
            $.ajax({
                url: `/members/${userId}/show`,
                type: 'GET',
                success: function(response) {
                    $('#user_name_edit').val(response.user_name);
                    $('#email_edit').val(response.email);
                    $('#role_id_edit').val(response.role_id);
                }
            });
        }
    </script>
@endsection
