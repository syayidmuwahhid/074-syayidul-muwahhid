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

$(document).ready(function () {
    datatable();
});
