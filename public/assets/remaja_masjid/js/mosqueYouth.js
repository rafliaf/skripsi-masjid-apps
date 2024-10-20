
function onAddClicked(){
    window.location.href = window.location.href + '/create';
}

let table = new DataTable('#myTable', {
    responsive: true
});

// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// modal
function onEditClicked(id) {
    // Find the corresponding data by ID
    const remaja = remajaMasjidData.find(item => item.id === id);

    if (!remaja) {
        console.error('No data found for the given ID:', id);
        return;
    }

    // Access the dataInduk directly from the remaja object
    const dataInduk = remaja.data_induk; // Adjusted property name based on your response
    const namaLengkap = dataInduk?.nama_lengkap || 'N/A'; // Safely access nama_lengkap

    // Populate modal fields with the fetched data
    $('#edit_id').val(remaja.id);
    $('#editNama').val(namaLengkap); // Populate the name field
    $('#editIsRemaja').val(remaja.is_remaja_masjid);

    // Dynamically set the form action with the correct id
    $('#editRemajaForm').attr('action', `/dashboard/remaja_masjid/edit/${remaja.id}`);

    // Show modal
    const modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
    modalEdit.show();
}

function onCloseModalEdit(){
    $('#modalEdit').modal('hide');
}


function onDeleteClicked(id) {
    // Show the modal
    $('#delete_id').val(id);  // Store the id in the hidden input
    $('#hiddenDeleteUserId').val(id);  // Update the hidden input in the form
    
    // Dynamically set the form action with the correct id
    $('#deleteUserForm').attr('action', `/dashboard/remaja_masjid/delete/${id}`);
    
    $('#modalDelete').modal('show');  // Show the delete confirmation modal
}

function onCloseModalDelete() {
    $('#modalDelete').modal('hide');  // Hide the modal
}


// FILTER DATA
function onFilter() {
    var rt = document.getElementById('inputRT').value;
    var kemampuanBaca = document.getElementById('inputBaca').value;
    var remajaMasjid = document.getElementById('inputRemaja').value;

    // Initialize the query string
    var query = '?';

    // Append filters only if they have a value
    if (rt !== '') {
        query += 'rt=' + rt + '&';
    }
    if (kemampuanBaca !== '') {
        query += 'kemampuan_baca=' + kemampuanBaca + '&';
    }
    if (remajaMasjid !== '') {
        query += 'remaja_masjid=' + remajaMasjid + '&';
    }

    // Remove trailing '&' or '?' from the query string
    query = query.slice(0, -1);

    // Redirect to the URL with query parameters
    window.location.href = '/dashboard/remaja_masjid' + query;
}




// location back
function onClickLocationBack(){
    window.location.href = '/dashboard/remaja_masjid';
}