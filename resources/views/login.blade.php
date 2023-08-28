<!doctype html>
<html lang="en">

<head>
    <title>login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-4" style="margin-left: 500px !important">
        <span class="text-danger" id="authError"></span>
    </div>
    <div class="container d-flex align-items-center justify-content-center">
        <form method="POST" class="mt-4" id="login_user">
            {{-- @csrf --}}
            <div class="mt-3">
                <h2>Login here</h2>
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control " id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email" placeholder="Enter Your Email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <span class="text-danger loginError" id="emailError"></span>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control " id="exampleInputPassword1" name="password"
                    placeholder="Enter Your Password">
                <span class="text-danger loginError" id="passwordError"></span>
            </div>
            <a href="{{url('/register')}}">New user register</a>
            <button type="button" class="btn btn-primary" onclick="login()">Login</button>
        </form>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="{{ url('frontend/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/register.js') }}"></script>

</body>

</html>
