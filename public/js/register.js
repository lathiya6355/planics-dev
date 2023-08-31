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
            $('.registerError').html('');
            Object.keys(e.responseJSON.error).forEach(element => {
                e.responseJSON.error[element];
                console.log(e.responseJSON.error[element]);
                $(`#${element}Error`).html(e.responseJSON.error[element]);
            });
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
            $('.loginError').html('');
            Object.keys(e.responseJSON.error).forEach(element => {
                e.responseJSON.error[element];
                $(`#${element}Error`).html(e.responseJSON.error[element]);
            });
        }
    });
}

function logout() {
    alert('hello');
    $.ajax({
        url: 'api/logout',
        type: "post",
        headers:{
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        success : function(response) {
            localStorage.removeItem("token");
            window.location.href = "/";
        }
    });
}

