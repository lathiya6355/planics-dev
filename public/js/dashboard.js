var url = $('#site_url').val();
$(document).ready(function() {
    $.ajax({
        url: '/api/count',
        type: "GET",
        processData: false,
        contentType: false,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token")
        },
        success: function (response) {
            $(".totle_section").html(response.data);
        },
        error: function (e) {
            console.log(e);
        }
    });
});
