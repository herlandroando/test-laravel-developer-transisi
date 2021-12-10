//Sidebar

$(function () {
    $("#logout").on("click", () => {
        console.log("LOGOUT");
        $("#btn_logout").trigger("click");
    })
})
