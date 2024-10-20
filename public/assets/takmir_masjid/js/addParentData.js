const months = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

flatpickr("#inputTanggal", {
    dateFormat: "Y-m-d", // Internal format (YYYY-MM-DD)
    defaultDate: "{{ old('tgl_lahir', isset($dataInduk->tgl_lahir) ? $dataInduk->tgl_lahir : '') }}", // Set default date
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
            var date = selectedDates[0];
            var day = date.getDate();
            var month = months[date.getMonth()];
            var year = date.getFullYear();
            var formattedDate = `${day} ${month} ${year}`;
            
            // Update the visible input with human-readable format
            instance.input.value = formattedDate;

            // Store the correct format (YYYY-MM-DD) in the hidden field
            document.getElementById('hiddenDate').value = dateStr;
        }
    }
});


function onClickLocationBack(){
    window.location.href = '/dashboard/data_induk';
}