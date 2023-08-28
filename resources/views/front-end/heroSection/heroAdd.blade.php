@extends('front-end.layout.main')
@section('main.section')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Hero Section</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Hero Section Add</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="container">
            <form method="POST" id="hero_add">
                {{-- @csrf --}}
                <div class="mb-3">
                    <label for="title" class="form-label">Enter Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
                    <span class="text-danger hero-error" id="titleError"></span>
                </div>

                <div class="mb-3">
                    <label for="sub_title" class="form-label">Sub Title</label>
                    <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Enter Sub title">
                    <span class="text-danger hero-error" id="sub_titleError"></span>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
                    <span class="text-danger hero-error" id="descriptionError"></span>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" >
                    <span class="text-danger hero-error" id="imageError"></span>
                </div>

                <div class="mb-3">
                    <label for="action_btn" class="form-label">Action Button</label>
                    <input type="text" class="form-control" id="action_btn" name="action_btn" placeholder="Enter Action Button">
                    <span class="text-danger hero-error" id="action_btnError"></span>
                </div>

                <div class="mb-3">
                    <label for="action_link" class="form-label">Action Link</label>
                    <input type="link" class="form-control" id="action_link" name="action_link" placeholder="Enter Action Link">
                    <span class="text-danger hero-error" id="action_linkError"></span>
                </div>
                <button type="button" class="btn btn-primary my-3" onclick="create()">Create</button>
            </form>
        </section>
        {{-- <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="{{ asset('js/hero.js') }}"></script>

        <!-- /.content-wrapper -->
    @endsection
