var url = $('#site_url').val();
$(document).ready(function() {
    count();
    roles();
});
function count() {
    $.ajax({
        url: '/api/count',
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            $(".total_section").html(response.data);
        },
        error: function (e) {
            console.log(e);

        }
    });
}
function roles() {
    $.ajax({
        url: '/api/role',
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            $(".total_role").html(response.data);
        },
        error: function (e) {
            console.log(e);

        }
    });
}
