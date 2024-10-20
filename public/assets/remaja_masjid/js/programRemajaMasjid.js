// onAddClicked
function onAddClicked(){
    window.location.href = window.location.href + '/create';
}

function onEditClicked(id) {
    // Redirect to the edit page with the program ID
    window.location.href = `/dashboard/pogram_remaja_masjid/edit/${id}`;
}


// onDetailClicked
function onDetailClicked(id){
    // Redirect to the detail page, passing the program ID in the URL
    window.location.href = `/dashboard/pogram_remaja_masjid/detail/${id}`;
}


// DELETE MODAL
// Fungsi untuk delete program
function onDeleteClicked(id) {
    // Set the correct action URL on the delete form
    document.getElementById('formDeleteProgram').action = `/dashboard/program_remaja_masjid/delete/${id}`;
    
    // Show the delete confirmation modal
    $('#modalDelete').modal('show');
}


// Fungsi untuk menutup modal delete
function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}



// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

let table = new DataTable('#myTable', {
    responsive: true
});

// Array nama bulan dalam bahasa Indonesia
const months = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

flatpickr("#inputTanggal", {
    dateFormat: "d-m-Y H:i", // Format untuk penyimpanan internal
    enableTime: true,
    time_24hr: true, // Use 24-hour time format
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            var date = selectedDates[0];
            var day = date.getDate();
            var month = months[date.getMonth()];
            var year = date.getFullYear();
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');
            var formattedDate = `${day} ${month} ${year} ${hours}:${minutes} WIB`;
            instance.input.value = formattedDate;
        }
    },
});