$(document).ready(function () {
    $("#status-changer").change(function () {
        $(".form-change-status").submit();
    });

    $("input[name=avatar]").on("change", function (e) {
        let oldValue = $("input[id=avatar_old").val();
        let file = e.target.files[0];

        if (file) {
            $("#image-input-show").attr("src", URL.createObjectURL(file));
        } else {
            $("#image-input-show").attr("src", baseL + oldValue);
        }
    });
});
