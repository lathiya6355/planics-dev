var url = $('#site_url').val();

$(document).ready(function () {
    view();
    const hash = window.location.pathname.split("/")[2];
    if (hash != undefined) {
        edit_data(hash);
    }
    getAllRoles();
});

function edit_data(hash) {
    $.ajax({
        url: `${url}/api/permission-view/${hash}`,
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            // console.log('dcs',response.data.role[0].name);
            $("#updatename").val(response.data.name);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function view() {
    $("#table_data").empty();
    $.ajax({
        url: `${url}/api/permission-all`,
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
    // var formdata = $('#permission_add').serializeArray();
    var formdata = new FormData();
    formdata.append("name", $('#name').val());
    formdata.append("role_id", $('#selectBoxId').val());

    $.ajax({
        url: `${url}/api/permission-create`,
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            $("#permission-create").html(response.message);
            window.location.href = "permission"
        },
        error: function (e) {
            $('#nameError').html('');
            Object.keys(e.responseJSON.error).forEach(element => {
                e.responseJSON.error[element];
                $(`#${element}Error`).html(e.responseJSON.error[element]);
            });
        }
    })
}

function delete_data(id) {
    $.ajax({
        url: `${url}/api/permission-delete/${id}`,
        type: "DELETE",
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            view();
        },
    });
}

function update() {
    const id = window.location.pathname.split("/")[2];
    console.log(id);
    let formdata = new FormData();
    formdata.append("name", $('#updatename').val());
    $.ajax({
        url: `${url}/api/permission-update/${id}`,
        type: "POST",
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            window.location.href = `${url}/permission`
        },
    });
}

function updateRole() {
    let formdata = new FormData();
    formdata.append("roles", $('#roles').val());
    formdata.append("permission", $('#permission').val());
    $.ajax({
        url: `${url}/api/update-role`,
        type: "POST",
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token")
        },
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#assign-message').html(response.message);
            // window.location.href = `${url}/permission`
        },
        error: function (e) {
            $('#permission-update-error').html('');
            $('#roleError').html(e.responseJSON.errors.roles);
            $('#permissionError').html(e.responseJSON.errors.permission);
        }
    })
}

function getAllRoles() {
    $.ajax({
        url: `${url}/api/role-all-drop`,
        type: "GET",
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token")
        },
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            Object.keys(response.data).forEach(element => {
                var id = response.data[element]['id'];
                var html = response.data[element]['name'];
                $("#selectBoxId").append(`<option value="${id}" class="role_id" name = "roles">${html}</option>`);
            });
        }
    });
}
