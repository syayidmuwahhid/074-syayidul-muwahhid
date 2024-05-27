$(document).ready(function () {
    $("#toggle_show_password").click(function () {
        if ($("#password").attr("type") === "password") {
            $("#password").attr("type", "text");
            $("#toggle_show_password").html('<i class="bi bi-eye fs-2"></i>');
        } else {
            $("#password").attr("type", "password");
            $("#toggle_show_password").html(
                '<i class="bi bi-eye-slash fs-2"></i>'
            );
        }
    });

    $("#toggle_show_confirm_password").click(function () {
        if ($("#confirm_password").attr("type") === "password") {
            $("#confirm_password").attr("type", "text");
            $("#toggle_show_confirm_password").html(
                '<i class="bi bi-eye fs-2"></i>'
            );
        } else {
            $("#confirm_password").attr("type", "password");
            $("#toggle_show_confirm_password").html(
                '<i class="bi bi-eye-slash fs-2"></i>'
            );
        }
    });
});
