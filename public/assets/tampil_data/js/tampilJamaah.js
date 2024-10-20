// onDetailClicked
function onDetailClicked(id) {
    window.location.href = '/dashboard/tampil_data_jamaah/read/' + id;
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
    var statusMukim = document.getElementById('inputRT').value;
    var remajaMasjid = document.getElementById('inputBaca').value;
    var jamaahPengajian = document.getElementById('inputRemaja').value;

    // Initialize the query string
    var query = '?';

    // Append filters only if they have a value
    if (statusMukim !== '') {
        query += 'status_mukim=' + statusMukim + '&';
    }
    if (remajaMasjid !== '') {
        query += 'remaja_masjid=' + remajaMasjid + '&';
    }
    if (jamaahPengajian !== '') {
        query += 'jamaah_pengajian=' + jamaahPengajian + '&';
    }

    // Remove trailing '&' or '?' from the query string
    query = query.slice(0, -1);

    // Redirect to the URL with query parameters
    window.location.href = '/dashboard/tampil_data_jamaah' + query;
}
