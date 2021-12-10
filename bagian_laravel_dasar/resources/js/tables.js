

$(function () {

    $("#delete_accept").on("click", () => {
        var id = $("#delete_accept").data("id");
        $("#delete_cancel").trigger("click");
        $("#delete" + id).trigger("click");
    })
})

