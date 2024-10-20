let table = new DataTable('#myTable', {
    responsive: true
});

// Array nama bulan dalam bahasa Indonesia
const months = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Function to format date to Indonesian format
function formatToIndonesianDate(date) {
    return date.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    }) + ' WIB';
}

// Tanggal Mulai
flatpickr("#inputTanggalMulai", {
    dateFormat: "Y-m-d H:i", // MySQL format for the hidden input
    enableTime: true,
    time_24hr: true,
    defaultDate: document.getElementById('hiddenInputTanggalMulai').value, // Set the default date from the hidden input
    onReady: function(selectedDates, dateStr, instance) {
        if (selectedDates.length) {
            const formattedDate = formatToIndonesianDate(selectedDates[0]);
            instance.input.value = formattedDate;  // Update the visible input on load
        }
    },
    onChange: function(selectedDates, dateStr, instance) {
        // Update hidden input with MySQL format
        document.getElementById('hiddenInputTanggalMulai').value = dateStr;

        // Format the visible input date to Indonesian format
        const formattedDate = formatToIndonesianDate(selectedDates[0]);
        instance.input.value = formattedDate;  // Update the visible input
    }
});

// Tanggal Selesai
flatpickr("#inputTanggalSelesai", {
    dateFormat: "Y-m-d H:i", // MySQL format for the hidden input
    enableTime: true,
    time_24hr: true,
    defaultDate: document.getElementById('hiddenInputTanggalSelesai').value, // Set the default date from the hidden input
    onReady: function(selectedDates, dateStr, instance) {
        if (selectedDates.length) {
            const formattedDate = formatToIndonesianDate(selectedDates[0]);
            instance.input.value = formattedDate;  // Update the visible input on load
        }
    },
    onChange: function(selectedDates, dateStr, instance) {
        // Update hidden input with MySQL format
        document.getElementById('hiddenInputTanggalSelesai').value = dateStr;

        // Format the visible input date to Indonesian format
        const formattedDate = formatToIndonesianDate(selectedDates[0]);
        instance.input.value = formattedDate;  // Update the visible input
    }
});



function onClickLocationBack(){
    window.history.back();
}