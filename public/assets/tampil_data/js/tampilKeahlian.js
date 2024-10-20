// onDetailClicked
function onDetailClicked(id) {
    window.location.href = '/dashboard/tampil_data_keahlian/read/' + id;
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
    var statusMukim = document.getElementById('inputMukim').value;
    var keahlian = document.getElementById('inputBaca').value;
    var sertifikat = document.getElementById('inputRemaja').value;

    // Initialize the query string
    var query = '?';

    // Append filters only if they have a value (not empty)
    if (statusMukim !== '') {
        query += 'status_mukim=' + statusMukim + '&';
    }
    if (keahlian !== '') {
        query += 'keahlian=' + keahlian + '&';
    }
    if (sertifikat !== '') {
        query += 'sertifikat=' + sertifikat + '&';
    }

    // Remove trailing '&' or '?' from the query string
    query = query.slice(0, -1);

    // Redirect to the URL with query parameters
    window.location.href = '/dashboard/tampil_data_keahlian' + query;
}
