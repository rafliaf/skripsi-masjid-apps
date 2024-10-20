// onDetailClicked
function onDetailClicked(id) {
    // Construct the URL based on the id and redirect
    window.location.href = window.location.origin + '/dashboard/tampil_data_kk/read/' + id;
}

// Initialize DataTable with responsive settings
let table = new DataTable('#myTable', {
    responsive: true
});

// Initialize tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});


// FILTER
function onFilter() {
    var rt = document.getElementById('inputRT').value;
    var jumlahAnggota = document.getElementById('inputJumlahAnggota').value;
    var levelEkonomi = document.getElementById('inputLevelEkonomi').value;

    // Initialize the query string
    var query = '?';

    // Append filters only if they have a value
    if (rt !== '') {
        query += 'rt=' + rt + '&';
    }
    if (jumlahAnggota !== '') {
        query += 'jumlah_anggota=' + jumlahAnggota + '&';
    }
    if (levelEkonomi !== '') {
        query += 'level_ekonomi=' + levelEkonomi + '&';
    }

    // Remove trailing '&' or '?' from the query string
    query = query.slice(0, -1);

    // Redirect to the URL with query parameters
    window.location.href = '/dashboard/tampil_data_kk' + query;
}
