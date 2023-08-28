@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Permission</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permission Update</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="container">
            <form method="POST" id="hero_update">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Name</label>
                    <input type="text" class="form-control" id="updatename" placeholder="Enter name" name="title">
                    <span class="text-danger hero-update-error" id="nameUpdateError"></span>
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Enter Role</label>
                    <input type="text" class="form-control" id="role_id" name="role" placeholder="Enter Sub title">
                    <span class="text-danger hero-update-error" id="roleUpdateError"></span>
                </div>

                <div class="mb-3">
                    <label for="permission" class="form-label">Enter Permission</label>
                    <input type="text" class="form-control" id="permission_id" name="permission" placeholder="Enter Permission">
                    <span class="text-danger hero-update-error" id="permissionUpdateError"></span>
                </div>

                <img src="" alt="" id="image_preview_container" >
                <button type="button" class="btn btn-primary my-3" onclick="update()">Update</button>
            </form>
        </section>
        {{-- <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/permission.js') }}"></script>

        <!-- /.content-wrapper -->
    @endsection
