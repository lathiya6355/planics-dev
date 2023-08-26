$(document).ready(function () {
    $.ajax({
        url: "api/view-all",
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "bearer" + localStorage.getItem("token")
        },
        success: function (data) {
            console.log(localStorage.getItem("token"));
            console.log(data);
            $('#table_data').append(data.html);;
        },
        error: function (e) {
            console.log(e);
        }
    });
});
