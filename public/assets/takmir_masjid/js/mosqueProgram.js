let table = new DataTable('#myTable', {
    responsive: true
});

// tooltip
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});


// addprogram
function onAddProgramClicked(){
    window.location.href = window.location.href + '/create_jenis_program';
}

// adddata
function onAddDataClicked(){
    window.location.href = window.location.href + '/create';
}


// Fungsi untuk edit
function onEditClicked(id) {
    window.location.href = `/dashboard/program_takmir/edit/${id}`;
}

// Fungsi untuk detail
function onDetailClicked(id) {
    window.location.href = `/dashboard/program_takmir/detail/${id}`;
}

// Fungsi untuk delete program
function onDeleteClicked(id) {
    // Set action URL pada form delete
    document.getElementById('formDeleteProgram').action = `/dashboard/program_takmir/delete/${id}`;
    
    // Tampilkan modal delete
    $('#modalDelete').modal('show');
}

function onCloseModalDelete(){
    $('#modalDelete').modal('hide');
}

// Array nama bulan dalam bahasa Indonesia
const months = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Function to format the date in Indonesian
function formatIndonesianDate(date) {
    var day = date.getDate();
    var month = months[date.getMonth()];
    var year = date.getFullYear();
    var hours = date.getHours().toString().padStart(2, '0');
    var minutes = date.getMinutes().toString().padStart(2, '0');
    return `${day} ${month} ${year} ${hours}:${minutes} WIB`;
}

// Tanggal Mulai
flatpickr("#inputTanggalMulai", {
    dateFormat: "Y-m-d H:i", // Format MySQL-friendly
    enableTime: true,
    time_24hr: true, // Format 24 jam
    defaultDate: "{{ old('tgl_mulai') }}", // Handle old value if present
    onReady: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            // If there's an existing value (old input), show it in the Indonesian format
            var formattedDateDisplay = formatIndonesianDate(selectedDates[0]);
            instance.input.value = formattedDateDisplay;
        }
    },
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            var formattedDateDisplay = formatIndonesianDate(selectedDates[0]);
            instance.input.value = formattedDateDisplay;

            // Simpan format MySQL di hidden input
            document.getElementById('hiddenInputTanggalMulai').value = dateStr; // dateStr is already 'Y-m-d H:i'
        }
    }
});

// Tanggal Selesai
flatpickr("#inputTanggalSelesai", {
    dateFormat: "Y-m-d H:i", // Format MySQL-friendly
    enableTime: true,
    time_24hr: true, // Format 24 jam
    defaultDate: "{{ old('tgl_selesai') }}", // Handle old value if present
    onReady: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            // If there's an existing value (old input), show it in the Indonesian format
            var formattedDateDisplay = formatIndonesianDate(selectedDates[0]);
            instance.input.value = formattedDateDisplay;
        }
    },
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            var formattedDateDisplay = formatIndonesianDate(selectedDates[0]);
            instance.input.value = formattedDateDisplay;

            // Simpan format MySQL di hidden input
            document.getElementById('hiddenInputTanggalSelesai').value = dateStr; // dateStr is already 'Y-m-d H:i'
        }
    }
});



function onClickLocationBack(){
    window.location.href = '/dashboard/program_takmir';
}