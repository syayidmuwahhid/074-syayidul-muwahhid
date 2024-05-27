$(document).ready(function () {
    $(".copy_txt_btn").click(function () {
        let copyText = $(this).data("link");
        navigator.clipboard.writeText(copyText)
            ? swal("success", "Link Copied Succesfully, paste into your apps!")
            : swal(
                  "danger",
                  "Copying failed, consider upgrading your browser."
              );
    });

    $("#btn_add_file").click(() => {
        $("#card_form_files").removeAttr("style");
    });
});
