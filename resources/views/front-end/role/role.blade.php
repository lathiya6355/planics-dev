@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Role</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section>
            <div class="d-flex align-items-center justify-content-end">
                <div class="me-3 mb-4">
                    <a href="{{url('/role-add')}}">
                        <button class="btn btn-info">Create</button>
                    </a>
                    <a href="{{ url('/role-assign') }}">
                        <button class="btn btn-success">Assign</button>
                    </a>
                    <a href="{{ url('/roleUpdate-Permission') }}">
                        <button class="btn btn-warning">Update</button>
                    </a>
                </div>
            </div>
        </section>

        <div class="container">
            <div id="table_data">

            </div>
        </div>
        <div>
            {{-- <select name="" id="">
                <option value="">1</option>
                <option value="">2</option>
                <option value="">3</option>
            </select> --}}
        </div>
        <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/role.js') }}"></script>

        <!-- /.content-wrapper -->
    @endsection
