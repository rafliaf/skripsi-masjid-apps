let table = new DataTable('#myTable', {
    responsive: true
});


// Array nama bulan dalam bahasa Indonesia
const months = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Tanggal Mulai
flatpickr("#inputTanggalMulai", {
    dateFormat: "Y-m-d H:i", // Format MySQL-friendly
    enableTime: true,
    time_24hr: true, // Format 24 jam
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            var date = selectedDates[0];
            var day = date.getDate();
            var month = months[date.getMonth()];
            var year = date.getFullYear();
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');

            // Tampilkan format Indonesia untuk user
            var formattedDateDisplay = `${day} ${month} ${year} ${hours}:${minutes} WIB`;
            instance.input.value = formattedDateDisplay;

            // Simpan format MySQL di hidden input
            document.getElementById('hiddenInputTanggalMulai').value = dateStr; // dateStr is already 'Y-m-d H:i'
        }
    },
});

// Tanggal Selesai
flatpickr("#inputTanggalSelesai", {
    dateFormat: "Y-m-d H:i", // Format MySQL-friendly
    enableTime: true,
    time_24hr: true, // Format 24 jam
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            var date = selectedDates[0];
            var day = date.getDate();
            var month = months[date.getMonth()];
            var year = date.getFullYear();
            var hours = date.getHours().toString().padStart(2, '0');
            var minutes = date.getMinutes().toString().padStart(2, '0');

            // Tampilkan format Indonesia untuk user
            var formattedDateDisplay = `${day} ${month} ${year} ${hours}:${minutes} WIB`;
            instance.input.value = formattedDateDisplay;

            // Simpan format MySQL di hidden input
            document.getElementById('hiddenInputTanggalSelesai').value = dateStr; // dateStr is already 'Y-m-d H:i'
        }
    },
});

// inputTanggalMulaiTrigger

function onClickLocationBack(){
    window.location.href = '/dashboard/pogram_remaja_masjid';
}