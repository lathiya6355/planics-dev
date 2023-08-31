var url = $('#site_url').val();
var selected_permission = [];
// console.log(url);
$(document).ready(function () {
    view();
    const hash = window.location.pathname.split("/")[2];
    if (hash != undefined) {
        edit_data(hash);
    }
    getAllPermissions();
    getAllRoles();
});

function edit_data(hash) {
    $.ajax({
        url: `${url}/api/role-view/${hash}`,
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            selected_permission = response.data.permissionsIds;
            console.log('ere',response.data.permissionsIds);
            // console.log('dcs',response.data.role[0].name);
            $("#updatename").val(response.data.name);
            var roleid= response.data.permissions[0].id;
            console.log('sfdgfg',roleid);
        },
        error: function (e) {
            console.log(e);
        }
    });
}

function view() {
    $("#table_data").empty();
    $.ajax({
        url: `${url}/api/role-all`,
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
        url: `${url}/api/role-create`,
        type: "post",
        data: formdata,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            $("#create-message").html(response.message);
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
        url: `${url}/api/role-delete/${id}`,
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
    // console.log(id);
    let permissionIds = [];
    $('input[name="permission"]:checked').each(function() {
        console.log(this.value);
        permissionIds.push(this.value);
     });
    //  console.log(permissionIds.toString());
    let formdata = new FormData();
    formdata.append("name", $('#updatename').val());
    formdata.append("permission_id", permissionIds.toString());

    $.ajax({
        url: `${url}/api/role-update/${id}`,
        type: "POST",
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $("#role-update-success").html(response.message);
            window.location.href = `${url}/role`
        }, error: function(e) {
            $('.role-update-error').html(e.responseJSON.error.name);
        }
    });
}

function assign() {
    // let formdata = new FormData();
    // formdata.append("roles", $('#selectBoxId_role').val());
    // formdata.append("permission", $('#selectBoxId .selectBox').val());
    // console.log($('#selectBoxId .selectBox').val());
    // console.log('sffdsfd',$('input[name="permission"]:checked').val());
    let permissionIds = [];
    $('input[name="permission"]:checked').each(function() {
        console.log(this.value);
        permissionIds.push(this.value);
     });
     console.log(permissionIds.toString());
    let formdata = new FormData();
    formdata.append("roles", $('#selectBoxId_role').val());
    formdata.append("permission", permissionIds.toString());
    // var formdata = $('#role_assign').serializeArray();
    // console.log(formdata);
    $.ajax({
        url: `${url}/api/assignpermission`,
        type: "POST",
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token")
        },
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response.message);
            $('#assign-message').html(response.message);
            window.location.href = `${url}/role`
        },
        error: function (e) {
            $('.role-assign-error').html('');
            $('#roleError').html(e.responseJSON.errors.roles);
            $('#permissionError').html(e.responseJSON.errors.permission);
        }
    })
}

function updatePermission() {
    let formdata = new FormData();
    formdata.append("roles", $('#selectBoxId_role').val());
    formdata.append("permission", $('#selectBoxId_permission').val());
    $.ajax({
        url: `${url}/api/update-permission`,
        type: "POST",
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token")
        },
        data: formdata,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#assign-message').html(response.message);
            window.location.href = `${url}/role`
        },
        error: function (e) {
            $('.role-update-error').html('');
            $('#roleError').html(e.responseJSON.errors.roles);
            $('#permissionError').html(e.responseJSON.errors.permission);
        }
    })
}

function getAllPermissions() {
    $.ajax({
        url: `${url}/api/permission-all-drop`,
        type: "GET",
        headers: {
            Authorization: "Bearer" + localStorage.getItem("token")
        },
        processData: false,
        contentType: false,
        success: function (response) {
            Object.keys(response.data).forEach(element => {
                var id = response.data[element]['id'];
                var html = response.data[element]['name'];
                console.log(id);
                $("#selectBoxId_permission").append(`<option value="${id}" name = "permission" >${html}</option>`);
                $("#selectBoxId").append(`<label><input type="checkbox" value="${id}" name="permission_id[]" class="selectBox"/>${html}</lable>`);
                $(".selectBoxId_data").append(`<label><input type="checkbox" value="${id}" name="permission"  class="selectBoxId" id="permission_id" ${selected_permission.includes(id) ? 'checked' : ''}/>${html}</lable>`);
            });
        }
    });
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
                $("#selectBoxId_role").append(`<option value="${id}" class="role_id" name = "roles">${html}</option>`);
            });
        }
    });
}

$('.selectall').click(function() {
    if ($(this).is(':checked')) {
        $('div input').attr('checked', true);
    } else {
        $('div input').attr('checked', false);
    }
});
