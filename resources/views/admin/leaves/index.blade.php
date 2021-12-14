@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Leaves</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Admin Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            List Leaves
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
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <!-- general form elements -->
                    @include('messages.alerts')
                    @error('status')
                        <div class="alert alert-danger">
                            Choose a valid status option
                        </div>
                    @enderror
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List of leaves</h3>
                        </div>
                        <div class="card-body">
                            @if ($leaves->count())
                            <table class="table table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Applied on</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Designation</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th class="none">Half Day</th>
                                        <th class="none">Start Date</th>
                                        <th class="none">End Date</th>
                                        <th class="none">Description</th>
                                        <td class="none">Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $leave->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $leave->employee->first_name.' '.$leave->employee->last_name }}</td>
                                        <td>{{ $leave->employee->department }}</td>
                                        <td>{{ $leave->employee->desg }}</td>
                                        <td>{{ $leave->reason }}</td>
                                        <td>
                                            <h5>
                                                <span 
                                                @if ($leave->status == 'pending')
                                                    class="badge badge-pill badge-warning"
                                                @elseif($leave->status == 'declined')
                                                    class="badge badge-pill badge-danger"
                                                @elseif($leave->status == 'approved')
                                                    class="badge badge-pill badge-success"
                                                @endif
                                                >
                                                    {{ ucfirst($leave->status) }}
                                                </span> 
                                            </h5>
                                        </td>
                                        <td>{{ ucfirst($leave->half_day) }}</td>
                                        <td>{{ $leave->start_date->format('d-m-Y')}}</td>
                                        @if($leave->end_date) 
                                        <td>{{ $leave->end_date->format('d-m-Y') }}</td>
                                        @else
                                        <td>Single Day</td>
                                        @endif
                                        <td>{{ $leave->description }}</td>
                                        <td>
                                            <button 
                                            class="btn btn-flat btn-info"
                                            data-toggle="modal"
                                            data-target="#deleteModalCenter{{ $index + 1 }}"
                                            >
                                            Change Status
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @for ($i = 1; $i < $leaves->count()+1; $i++)
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Update Leave Status</h5>
                                                </div>
                                                <form 
                                                    action="{{ route('admin.leaves.update', $leaves->get($i-1)->id) }}"
                                                    method="POST"
                                                >
                                                <div class="card-body">
                                                    @csrf
                                                    @method('PUT')
                                                        <div class="form-group text-center">
                                                            <label for="">Select status</label>
                                                            <select name="status" class="form-control text-center mx-auto" style="width:50%">
                                                                <option hidden disabled selected value> ---- </option>
                                                                <option value="pending">Pending</option>
                                                                <option value="approved">Approve</option>
                                                                <option value="declined">Decline</option>
                                                            </select>
                                                        </div>
                                                        
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button type="submit" class="btn flat btn-info">Update</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            @endfor
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>No records available</h4>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('extra-js')

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
        trigger: 'focus'
    });
    $('#dataTable').DataTable({
        responsive:true,
        autoWidth: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 200000000000, targets: -1 }
        ]
    });
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
});
</script>
@endsection