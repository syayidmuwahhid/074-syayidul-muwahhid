$(document).ready(function () {
    $("#status-changer").change(function () {
        $(".form-change-status").submit();
    });

    $("input[name=avatar]").on("change", function (e) {
        var path = $(this).val();
        var file = e.target.files[0];

        // Check if a file is selected
        if (file) {
            // FileReader API to display image
            var reader = new FileReader();

            reader.onload = function (event) {
                $("#image-input-show").attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        } else {
            // Handle case where no file is selected (optional)
            console.log("No file selected.");
        }
    });
});
