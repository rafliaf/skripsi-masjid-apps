// onDetailClicked
function onDetailClicked(id){
    window.location.href = '/dashboard/tampil_data_kemampuan/read/' + id;
}

// click back
function onClickLocationBack(){
    window.history.back()
}

let table = new DataTable('#myTable', {
    responsive: true,
    
});

// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// FILTER
function onFilter() {
    var bacaQuran = document.getElementById('inputBacaQuran').value;
    var bacaIqro = document.getElementById('inputBacaIqro').value;
    var bacaHijaiyah = document.getElementById('inputBacaHijaiyah').value;

    // Initialize the query string
    var query = '?';

    // Append filters only if they have a value
    if (bacaQuran !== '') {
        query += 'baca_quran=' + bacaQuran + '&';
    }
    if (bacaIqro !== '') {
        query += 'baca_iqro=' + bacaIqro + '&';
    }
    if (bacaHijaiyah !== '') {
        query += 'baca_hijaiyah=' + bacaHijaiyah + '&';
    }

    // Remove trailing '&' or '?' from the query string
    query = query.slice(0, -1);

    // Redirect to the URL with query parameters
    window.location.href = '/dashboard/tampil_data_kemampuan' + query;
}
