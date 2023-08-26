$(document).ready(function() {
    $.ajax({
        url: "api/role-all",
        type: "GET",
        processData: false,
        contentType: false,
        success: function(data) {
            $('#table_data').append(data.html);;
        },
        error: function(e) {
            console.log(e);
        }
    });
});
