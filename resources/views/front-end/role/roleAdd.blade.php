@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <style>
        .select2-selection.select2-selection--multiple {
            width: 500px !important;
        }

        .select2-results {
            width: 500px !important;
        }

        .select2-dropdown.select2-dropdown--below {
            width: 500px !important;
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Role</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Role Add</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="container">
            <div>
                <h4 id="create-message" class="text-success"></h4>
            </div>
            <form method="POST" id="role_add">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Role Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                    <span class="text-danger" id="nameError"></span>
                </div>
                {{-- <div class="mb-3">
                    <label for="select_box" class="form-label">Assign Permission</label>
                    <select id="selectBoxId" class="js-example-basic-single" name="permission_id[]" multiple="multiple">
                        <option value="" disabled></option>
                    </select>
                </div> --}}
                <div class="selectBoxId" id="selectBoxId">
                    <label><input type="checkbox" name="permission_id[]" value="" class="selectall"/>Hero Section</label><br/>
                    {{-- <label><input type="checkbox" name="permission_id[]" value="1" class=" selectBoxId"/>create</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="2" class=" selectBoxId"/>update</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="3" class=" selectBoxId"/>delete</label><br />
                    <label><input type="checkbox" name="permission_id[]" value="4" class=" selectBoxId"/>show</label><br /> --}}
                </div>
                <button type="button" class="btn btn-primary my-3" onclick="create()">Create</button>
            </form>
        </section>
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
            // $('.selectall').click(function() {
            //     if ($(this).is(':checked')) {
            //         $('div input').attr('checked', true);
            //     } else {
            //         $('div input').attr('checked', false);
            //     }
            // });
        </script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    @endsection
