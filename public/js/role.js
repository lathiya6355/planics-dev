var url = $('#site_url').val();
console.log(url);
$(document).ready(function () {
    view();
});

function view() {
    $("#table_data").empty();
    $.ajax({
        url: "api/role-all",
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (data) {
            $('#table_data').append(data.html);;
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function create() {
    var formdata = $('#role_add').serializeArray();
    $.ajax({
        url: "api/role-create",
        type: "post",
        data: formdata,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            window.location.href = "role"
        },
        error: function (e) {
            $('#nameError').html('');
            Object.keys(e.responseJSON.error).forEach(element => {
                e.responseJSON.error[element];
                $(`#${element}Error`).html(e.responseJSON.error[element]);
            });
        }
    });
}

function delete_data(id) {
    $.ajax({
        url: `api/role-delete/${id}`,
        type: "DELETE",
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            view();
        },
    });
}


