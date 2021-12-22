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
                                    <th class="none">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $index => $employee)
                                <tr>
                                    <td>{{ $index +1 }}</td>
                                    <td>{{ $employee->first_name }}</td>
                                    <td>
                                        <a href="{{ route('admin.employees.profile', $employee->id) }}" class="btn btn-flat btn-info">View Employee</a>
                                        <button
                                        class="btn btn-flat btn-success"
                                        data-toggle="modal"
                                        data-target="#makeManager"
                                        >Make Manager</button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>


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
