var url = $('#site_url').val();

$(document).ready(function () {
    view();
    const hash = window.location.pathname.split("/")[2];
    if (hash != undefined) {
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
                Object.keys(response.data.role).forEach(element => {
                    // console.log(response.data.role[element].name);
                    $("#role_id").val(response.data.role[element].name);
                });
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
});

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
    var formdata = $('#permission_add').serializeArray();
    $.ajax({
        url: "api/permission-create",
        type: "post",
        data: formdata,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
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
        url: `api/permission-delete/${id}`,
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
    formdata.append("role_id", $('#role_id').val());
    formdata.append("permission_id", $('#permission_id').val());
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
            window.location.href = `${url}/heroSection`
        },
    });
}
