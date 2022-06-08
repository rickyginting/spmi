// Call the dataTables jQuery plugin
$(document).ready(function() {
    // var tabel = $('#dataTable').DataTable();
    // var order = table.order([1, 'asc']).draw()

    $('#dataTable').DataTable({
        "order": [0, 'asc']
    });
});