$(document).ready(function () {
    $(".copy_txt_btn").click(function () {
        let copyText = $(this).data("link");
        var successful = navigator.clipboard.writeText(copyText);
        var msg = successful
            ? "Link Copied Succesfully, paste into your apps!"
            : "Copying failed, consider upgrading your browser.";
        alert(msg);
    });

    $("#btn_add_file").click(() => {
        $("#card_form_files").removeAttr("style");
    });
});
