// onDetailClicked
function onDetailClicked(id){
    window.location.href = '/dashboard/tampil_data_pendidikan/read/' + id;
}

let table = new DataTable('#myTable', {
    responsive: true
});
 
// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// FILTERS
// FILTER
function onFilter() {
    var rt = document.getElementById('inputRT').value;
    var pendidikan = document.getElementById('inputPendidikan').value;
    var nama = document.getElementById('inputNama').value;

    // Initialize the query string
    var query = '?';

    // Append filters only if they have a value (not empty)
    if (rt !== '') {
        query += 'rt=' + rt + '&';
    }
    if (pendidikan !== '') {
        query += 'pendidikan=' + pendidikan + '&';
    }
    if (nama !== '') {
        query += 'nama=' + nama + '&';
    }

    // Remove trailing '&' or '?' from the query string
    query = query.slice(0, -1);

    // Redirect to the URL with query parameters
    window.location.href = '/dashboard/tampil_data_pendidikan' + query;
}
