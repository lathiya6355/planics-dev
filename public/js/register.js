function register() {
    var form = $('#register_user').serializeArray();
    $.ajax({
        url: 'api/register',
        type: 'POST',
        data: form,
        success: function(response) {
            localStorage.setItem('token',response.data.token);
            window.location.href = "dashboard"
        },
        error: function(e) {
            console.log(e.responseJSON.error);
            $('#nameError').html('');
            $('#emailError').html('');
            $('#passwordError').html('');
            $('#confirm').html('');
            $('#nameError').html(e.responseJSON.error.name);
            $('#emailError').html(e.responseJSON.error.email);
            $('#passwordError').html(e.responseJSON.error.password);
            $('#confirmError').html(e.responseJSON.error.password_confirmation);
        }
    });
}

function login() {
    var form = $('#login_user').serializeArray();
    $.ajax({
        url: 'api/login',
        type: 'POST',
        data: form,
        success: function(response) {
            localStorage.setItem('token',response.data.token);
            window.location.href = "dashboard"
        },
        error: function(e) {
            console.log(e);
            $('#authError').html('');
            $('#emailError').html('');
            $('#passwordError').html('');
            $('#authError').html(e.responseJSON.message);
            $('#emailError').html(e.responseJSON.error.email);
            $('#passwordError').html(e.responseJSON.error.password);
        }
    });
}

