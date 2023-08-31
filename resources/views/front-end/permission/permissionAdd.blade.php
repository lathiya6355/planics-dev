@extends('front-end.layout.main')
@section('main.section')
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
            <div>
                <h4 id="permission-create" class="text-success"></h4>
            </div>
            <form method="POST" id="permission_add">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Enter Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                    <span class="text-danger" id="nameError"></span>
                </div>
                {{-- <div class="mb-3">
                    <label for="select_box" class="form-label">Assign Role</label>
                    <select id="selectBoxId" class="form-select js-example-basic-single" name="role_id[]" multiple="multiple">
                        <option value="" disabled></option>
                    </select> --}}
                    {{-- <label for="role_id" class="form-label">Assign Role</label>
                    <input type="text" class="form-control"  placeholder="Enter Role ID" name="role_id"> --}}
                {{-- </div> --}}
                <button type="button" class="btn btn-primary my-3" onclick="create()">Create</button>
            </form>
        </section>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/permission.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.js-example-basic-single').select2({
                    theme: "classic",
                    placeholder: "Select a Role",
                });
            });
        </script>
        <!-- /.content-wrapper -->
    @endsection
