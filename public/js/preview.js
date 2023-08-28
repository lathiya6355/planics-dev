var url = $('#site_url').val();
$(document).ready(function () {
    const hash = window.location.pathname.split("/")[2];
    console.log(hash);
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
            $('#preview_data').append(response.html);
        }
    });
});

