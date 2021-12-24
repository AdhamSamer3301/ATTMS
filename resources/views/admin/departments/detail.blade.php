@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Department Details</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Admin Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.departments.index') }}">List Departments</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Department Details
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @include('messages.alerts')
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title text-center">
                            Employees
                        </div>

                    </div>
                    <div class="card-body">
                        @if ($employees)
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th class="none">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $index => $employee)
                                <?php
                                    $roles = DB::select(DB::raw(
                                            "SELECT roles.name
                                            FROM `roles` JOIN `role_user` JOIN `users` JOIN `employees`
                                            ON (employees.user_id = users.id)
                                            AND (users.id = role_user.user_id)
                                            AND (role_user.role_id = roles.id)
                                            WHERE (employees.first_name = '$employee->first_name') "
                                        ));
                                        $role = $roles[0]->name;
                                ?>
                                <tr>
                                    <td>{{ $index +1 }}</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>{{ $role }}</td>
                                    <td>
                                        <a href="{{ route('admin.employees.profile', $employee->id) }}" class="btn btn-flat btn-info">
                                            View Employee</a>

                                        {{-- <a href="{{ route('admin.employees.manage', $employee->id) }}" class="btn btn-flat btn-info">
                                            Make Manager</a> --}}
                                        <button
                                        class="btn btn-flat btn-success"
                                        data-toggle="modal"
                                        data-target="#makeManager{{ $index + 1 }}"
                                        >Make Manager</button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @for ($i = 1; $i < count($employees)+1; $i++)
                                <!-- Modal -->
                                <div class="modal fade" id="makeManager{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Are you sure to make him/her a manager ?</h5>
                                                </div>
                                                <div class="card-body text-center d-flex" style="justify-content: center">

                                                    <button type="button" class="btn flat btn-secondary" data-dismiss="modal">No</button>

                                                    <form
                                                    action="{{ route('admin.employees.manage', $employee->id ) }}"
                                                    method="POST"
                                                    >
                                                    @csrf
                                                    {{-- @method('POST') --}}
                                                        <button type="submit" class="btn flat btn-danger ml-1">Yes</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>This action is irreversable</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            @endfor

                        @else
                        <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                            <h4>No Records Available</h4>
                        </div>
                        @endif

                    </div>
                </div>
                <!-- general form elements -->

            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
    <!-- /.content -->

@endsection
@section('extra-js')

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
        });
    });
</script>
@endsection
