// onDetailClicked
function onDetailClicked(id) {
    window.location.href = 'tampil_data_pekerjaan/read/' + id;
}

// Initialize DataTable
let table = new DataTable('#myTable', {
    responsive: true
});

// Initialize tooltips
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// FILTER
function onFilter() {
    var rt = document.getElementById('inputRT').value;
    var pekerjaan = document.getElementById('inputPekerjaan').value;
    var nama = document.getElementById('inputNama').value;

    // Initialize the query string
    var query = '?';

    // Append filters only if they have a value (not empty)
    if (rt !== '') {
        query += 'rt=' + rt + '&';
    }
    if (pekerjaan !== '') {
        query += 'pekerjaan=' + pekerjaan + '&';
    }
    if (nama !== '') {
        query += 'nama=' + nama + '&';
    }

    // Remove trailing '&' or '?' from the query string
    query = query.slice(0, -1);

    // Redirect to the URL with query parameters
    window.location.href = '/dashboard/tampil_data_pekerjaan' + query;
}
