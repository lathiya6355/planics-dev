@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Assign Role</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Role Assign</li>
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
            <form method="POST" id="role_assign">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="role" class="form-label">Role Name</label>
                    <select id="selectBoxId_role" class="js-example-basic-single form-select">
                        <option value=""  disabled></option>
                    </select>
                    {{-- <input type="text" class="form-control" id="roles" placeholder="Enter Role ID" name="roles">
                    <span class="text-danger role-assign-error" id="roleError"></span> --}}
                </div>

                <div class="mb-3">
                    {{-- <label for="select_box" class="form-label">Assign Permission</label>
                    <select id="selectBoxId" class="js-example-basic-single form-select" name="permission[]" multiple="multiple">
                        <option value=""  disabled></option>
                    </select> --}}
                    {{-- <input type="text" class="form-control" id="permission" placeholder="Enter Permission ID" name="permission">
                    <span class="text-danger hero-update-error" id="permissionError"></span> --}}
                    {{-- <span class="text-danger role-assign-error" id="permissionError"></span> --}}
                </div>
                <div class="selectBoxId" id="selectBoxId_data">
                    <label><input type="checkbox" name="permission_id[]" value="" class="selectall"/>Hero Section</label><br/>
                    {{-- <label><input type="checkbox" name="permission_id[]" value="1" class=" selectBoxId"/>create</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="2" class=" selectBoxId"/>update</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="3" class=" selectBoxId"/>delete</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="4" class=" selectBoxId"/>show</label><br /> --}}
                </div>

                <button type="button" class="btn btn-primary my-3" onclick="assign()">Assign</button>
            </form>
        </section>
        {{-- <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/role.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script type="text/javascript">
            // $(document).ready(function() {
            //     $('.js-example-basic-single').select2({
            //         theme: "classic",
            //         placeholder: "Select a Permission",
            //     });
            // });
            // $(document).ready(function() {
            //     $('#selectBoxId_role').select2({
            //         theme: "classic",
            //         placeholder: "Select a Role",
            //     });
            // });
            //  $('.selectall').click(function() {
            //     if ($(this).is(':checked')) {
            //         $('div input').attr('checked', true);
            //     } else {
            //         $('div input').attr('checked', false);
            //     }
            // });
            </script>
        <!-- /.content-wrapper -->
    @endsection
