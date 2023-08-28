@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Permission</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Permission Add</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="container">
            <form method="POST" id="permission_add">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                    <span class="text-danger" id="nameError"></span>
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Assign Role</label>
                    <input type="text" class="form-control" id="role_id" placeholder="Enter Role ID" name="role_id">
                </div>
                <button type="button" class="btn btn-primary my-3" onclick="create()">Create</button>
            </form>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/permission.js') }}"></script>

        <!-- /.content-wrapper -->
    @endsection
