@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Permission Assign</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">update Permission Assign</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="container">
            <div>
                <h4 id="assign-message" class="text-success"></h4>
            </div>
            <form method="POST" id="permission_assign">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role ID</label>
                    <input type="text" class="form-control" id="roles" placeholder="Enter Role ID" name="role">
                    <span class="text-danger permission-update-error" id="roleError"></span>
                </div>

                <div class="mb-3">
                    <label for="permission" class="form-label">Permission ID</label>
                    <input type="text" class="form-control" id="permission" placeholder="Enter Permission ID" name="permission">
                    <span class="text-danger permission-update-error" id="permissionError"></span>
                </div>
                <button type="button" class="btn btn-primary my-3" onclick="updateRole()">Update</button>
            </form>
        </section>
        {{-- <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/permission.js') }}"></script>

        <!-- /.content-wrapper -->
    @endsection
