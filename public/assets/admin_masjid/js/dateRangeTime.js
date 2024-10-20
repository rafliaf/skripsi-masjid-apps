function checkTimeRange(currentTime, startTime, endTime) {
    const currentTimeDate = new Date(currentTime);
    const startTimeDate = new Date(startTime);
    const endTimeDate = new Date(endTime);

    if (startTimeDate <= currentTimeDate && currentTimeDate <= endTimeDate) {
        return "Tanggal dan waktu berada dalam rentang tanggal dan waktu";
    } else {
        return "Tanggal dan waktu tidak berada dalam rentang tanggal dan waktu";
    }
}

// Pengecekan
console.log('Pengecekan pertama 2023-06-26 08:00:00', checkTimeRange("2023-06-26 10:30:00", "2023-06-26 08:00:00", "2023-06-26 12:00:00"));
console.log('Pengecekan kedua 2023-06-27 18:00:00',checkTimeRange("2023-06-26 15:45:30", "2023-06-27 18:00:00", "2023-06-27 20:00:00"));
