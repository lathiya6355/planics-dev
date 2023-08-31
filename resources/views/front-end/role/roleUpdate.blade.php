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
            <div>
                <h3 id="role-update-success" class="text-success"></h3>
            </div>
            <form method="POST" id="hero_update">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Name</label>
                    <input type="text" class="form-control" id="updatename" placeholder="Enter name" name="title">
                    <span class="text-danger role-update-error" id="nameUpdateError"></span>
                </div>
                <div class="selectBoxId_data" id="">
                    <label><input type="checkbox" name="permission_id[]" value="" class="selectall"/>Hero Section</label><br/>
                    {{-- <label><input type="checkbox" name="permission_id[]" value="1" class=" selectBoxId"/>create</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="2" class=" selectBoxId"/>update</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="3" class=" selectBoxId"/>delete</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="4" class=" selectBoxId"/>show</label><br /> --}}
                </div>
                <img src="" alt="" id="image_preview_container" >
                <button type="button" class="btn btn-primary my-3" onclick="update()">Update</button>
            </form>
        </section>
        {{-- <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/role.js') }}"></script>
        
        <!-- /.content-wrapper -->
    @endsection
