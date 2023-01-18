var dt = $('#basic-dt').DataTable({
    "language": {
        "paginate": {
            "previous": "<i class='las la-angle-left'></i>",
            "next": "<i class='las la-angle-right'></i>"
        }
    },
    "lengthMenu": [5, 10, 15, 20],
    "pageLength": 5
});
$('#dropdown-dt').DataTable({
    "language": {
        "paginate": {
            "previous": "<i class='las la-angle-left'></i>",
            "next": "<i class='las la-angle-right'></i>"
        }
    },
    "lengthMenu": [5, 10, 15, 20],
    "pageLength": 5
});
$('#last-page-dt').DataTable({
    "pagingType": "full_numbers",
    "language": {
        "paginate": {
            "first": "<i class='las la-angle-double-left'></i>",
            "previous": "<i class='las la-angle-left'></i>",
            "next": "<i class='las la-angle-right'></i>",
            "last": "<i class='las la-angle-double-right'></i>"
        }
    },
    "lengthMenu": [3, 6, 9, 12],
    "pageLength": 3
});
$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = parseInt($('#min').val(), 10);
        var max = parseInt($('#max').val(), 10);
        var age = parseFloat(data[3]) || 0; // use data for the age column
        if ((isNaN(min) && isNaN(max)) ||
            (isNaN(min) && age <= max) ||
            (min <= age && isNaN(max)) ||
            (min <= age && age <= max)) {
            return true;
        }
        return false;
    }
);
var table = $('#range-dt').DataTable({
    "language": {
        "paginate": {
            "previous": "<i class='las la-angle-left'></i>",
            "next": "<i class='las la-angle-right'></i>"
        }
    },
    "lengthMenu": [5, 10, 15, 20],
    "pageLength": 5
});
$('#min, #max').keyup(function() {
    table.draw();
});
$('#export-dt').DataTable({
    dom: '<"row"<"col-md-6"B><"col-md-6"f> ><""rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>>',
    buttons: {
        buttons: [{
                extend: 'copy',
                className: 'btn btn-primary'
            },
            {
                extend: 'csv',
                className: 'btn btn-primary'
            },
            {
                extend: 'excel',
                className: 'btn btn-primary'
            },
            {
                extend: 'pdf',
                className: 'btn btn-primary'
            },
            {
                extend: 'print',
                className: 'btn btn-primary'
            }
        ]
    },
    "language": {
        "paginate": {
            "previous": "<i class='las la-angle-left'></i>",
            "next": "<i class='las la-angle-right'></i>"
        }
    },
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 7
});
// Add text input to the footer
$('#single-column-search tfoot th').each(function() {
    var title = $(this).text();
    $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
});
// Generate Datatable
var table = $('#single-column-search').DataTable({
    "language": {
        "paginate": {
            "previous": "<i class='las la-angle-left'></i>",
            "next": "<i class='las la-angle-right'></i>"
        }
    },
    "lengthMenu": [5, 10, 15, 20],
    "pageLength": 5
});
// Search
table.columns().every(function() {
    var that = this;
    $('input', this.footer()).on('keyup change', function() {
        if (that.search() !== this.value) {
            that
                .search(this.value)
                .draw();
        }
    });
});
var table = $('#toggle-column').DataTable({
    "language": {
        "paginate": {
            "previous": "<i class='las la-angle-left'></i>",
            "next": "<i class='las la-angle-right'></i>"
        }
    },
    "lengthMenu": [5, 10, 15, 20],
    "pageLength": 5
});
$('a.toggle-btn').on('click', function(e) {
    e.preventDefault();
    // Get the column API object
    var column = table.column($(this).attr('data-column'));
    // Toggle the visibility
    column.visible(!column.visible());
    $(this).toggleClass("toggle-clicked");
});