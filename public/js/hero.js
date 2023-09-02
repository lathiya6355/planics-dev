var url = $('#site_url').val();

$(document).ready(function () {
    view();
    const hash = window.location.pathname.split("/")[2];
    if (hash != undefined) {
        edit_data(hash);
    }
});

function edit_data(hash) {
    $.ajax({
        url: `${url}/api/view/${hash}`,
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            console.log(response);
            $("#updateTitle").val(response.data.title);
            $("#updateSub_title").val(response.data.sub_title);
            $("#updateDescription").val(response.data.description);
            $("#updateImage").attr('src', response.data.image);
            $("#updateAction_btn").val(response.data.action_btn);
            $("#updateAction_link").val(response.data.action_link);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function view() {
    $('#table_data').empty();
    $.ajax({
        url: `${url}/api/view-all`,
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (data) {
            $('#table_data').append(data.html);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function create() {
    var file = $('#image').prop("files")[0];
    console.log(file);
    let formdata = new FormData();
    formdata.append("title", $('#title').val());
    formdata.append("sub_title", $('#sub_title').val());
    formdata.append("description", $('#description').val());
    if (file == undefined) {
        formdata.append('image', '');
    } else {
        formdata.append("image", file);
    }
    formdata.append("action_btn", $('#action_btn').val());
    formdata.append("action_link", $('#action_link').val());
    $.ajax({
        url: `${url}/api/store`,
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            window.location.href = `${url}/heroSection`
        },
        error: function (e) {
            $('.hero-error').html('');
            Object.keys(e.responseJSON.error).forEach(element => {
                e.responseJSON.error[element];
                $(`#${element}Error`).html(e.responseJSON.error[element]);
            });
        }
    });
}

function delete_data(id) {
    $.ajax({
        url: `${url}/api/delete/${id}`,
        type: "DELETE",
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            view();
        },
        error: function(e) {
            $("#emp_error").html(e.responseJSON.message);
        }
    });
}

function update() {
    // alert('hello');
    const id = window.location.pathname.split("/")[2];
    var file = $('#updateImage').prop("files")[0];
    // console.log(file);
    let formdata = new FormData();
    formdata.append("title", $('#updateTitle').val());
    formdata.append("sub_title", $('#updateSub_title').val());
    formdata.append("description", $('#updateDescription').val());
    if (file == undefined) {
        formdata.append('image', '');
    } else {
        formdata.append("image", file);
    }
    formdata.append("action_btn", $('#updateAction_btn').val());
    formdata.append("action_link", $('#updateAction_link').val());
    console.log(formdata);
    $.ajax({
        url: `${url}/api/update/${id}`,
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
        error: function (e) {
            // e.responseJSON.message;
            $('.hero-update-error').html('');
            Object.keys(e.responseJSON.error).forEach(element => {
                e.responseJSON.error[element];
                $(`#${element}UpdateError`).html(e.responseJSON.error[element]);
            });
        }
    });
}


