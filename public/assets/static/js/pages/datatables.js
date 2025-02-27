let jquery_datatable = $("#table1").DataTable({
    responsive: true,
    dom:
        "<'row'<'col-6'l><'col-6 d-flex justify-content-end'f>>" +
        "<'row dt-row'<'col-sm-12'tr>>" +
        "<'row'<'col-6'i><'col-6'p>>",
    language: {
        // info: "Halaman _PAGE_ dari _PAGES_",
        lengthMenu: "Per Halaman _MENU_ ",
        search: "",
        searchPlaceholder: "Cari..",
    },
});
let customized_datatable = $("#table2").DataTable({
    responsive: true,
    pagingType: "simple",
    dom:
        "<'row'<'col-3'l><'col-9 d-flex justify-content-end'f>>" +
        "<'row dt-row'<'col-sm-12'tr>>" +
        "<'row'<'col-4'i><'col-8 d-flex justify-content-end'p>>",
    language: {
        info: "Halaman _PAGE_ dari _PAGES_",
        lengthMenu: "Per Halaman _MENU_ ",
        search: "",
        searchPlaceholder: "Cari..",
    },
});

const setTableColor = () => {
    document
        .querySelectorAll(".dataTables_paginate .pagination")
        .forEach((dt) => {
            dt.classList.add("pagination-primary");
        });
};
setTableColor();
jquery_datatable.on("draw", setTableColor);
