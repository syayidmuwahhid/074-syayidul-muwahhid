const baseL = $("meta[name=baseUrl]").attr("content") + "/";

$(document).ready(function () {
    datatable();

    $(".btn-form-delete").on("click", function () {
        // Find the parent form element and retrieve its ID
        swal("confirm", "Are you sure you want to delete ?", null, () =>
            $(this).closest("form").submit()
        );
    });

    var input = document.querySelector('input[name="tags"]'),
        // init Tagify script on the above inputs
        tagify = new Tagify(input, {
            whitelist: ["Web", "Mobile", "Pictures"],
            maxTags: 10,
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false, // <- do not hide the suggestions dropdown once an item has been selected
            },
        });
});

function datatable() {
    let tb = new DataTable(".dataTable", {
        layout: {
            topStart: null,
            topEnd: null,
            bottomStart: "pageLength",
            bottomEnd: "paging",
        },
    });

    $(".dataTable-search").on("keyup", function () {
        let searchTerm = $(this).val();
        tb.search(searchTerm).draw();
    });

    $(".dataTable-filter").on("change", () => {
        let value = $(".dataTable-filter option:selected").val();
        const column = $(".dataTable-filter").data("column");

        if (value === "all") {
            value = "";
        }

        tb.column(column).search(value).draw();
    });
}

function swal(type, title, text, action = () => {}) {
    /*
     * type : success, error, info, warning, question
     */
    if (type !== "confirm") {
        return Swal.fire({
            title,
            text,
            icon: type,
            timer: 3000, // 3 seconds
        });
    }

    return Swal.fire({
        title,
        text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Successed!",
                text: "",
                icon: "success",
                timer: 3000, // 3 seconds
            });

            action();
        }
    });
}
