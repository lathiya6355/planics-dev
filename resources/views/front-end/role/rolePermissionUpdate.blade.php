@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Role Assign</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update Role Assign</li>
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
                    <label for="role" class="form-label">Role </label>
                    <select id="selectBoxId_role" class="form-select" name="role">
                        <option value=""  disabled></option>
                    </select>
                    {{-- <input type="text" class="form-control" id="roles" placeholder="Enter Role ID" name="roles"> --}}
                    <span class="text-danger role-update-error" id="roleError"></span>
                </div>

                <div class="mb-3">
                    <label for="permission" class="form-label">Permission</label>
                    <select id="selectBoxId_permission" class="form-select js-example-basic-single" name="permission[]" multiple="multiple">
                        <option value=""  disabled></option>
                    </select>
                    {{-- <input type="text" class="form-control" id="permission" placeholder="Enter Permission ID" name="permission"> --}}
                    <span class="text-danger role-update-error" id="permissionError"></span>
                </div>
                <button type="button" class="btn btn-primary my-3" onclick="updatePermission()">Update</button>
            </form>
        </section>
        {{-- <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/role.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.js-example-basic-single').select2({
                    theme: "classic",
                    placeholder: "Select a Permission",
                });
            });
            $(document).ready(function() {
                $('#selectBoxId_role').select2({
                    theme: "classic",
                    placeholder: "Select a Role",
                });
            });
            </script>
        <!-- /.content-wrapper -->
    @endsection
