function delete_post(profileId, subId) {
    $.ajax({
        url: "/administration/blog/api/call_ajax.php",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            action: "delete_post",
            profileId: profileId,
            subId: subId
        }),
        success: function (response) {
            // console.log(JSON.parse(response).data);
            $("#table_body").text(JSON.parse(response).data + " $");
        },
        error: function (error) {
            console.log(error);
        },
    });
}