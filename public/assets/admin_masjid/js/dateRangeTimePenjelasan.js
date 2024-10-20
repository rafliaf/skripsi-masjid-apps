function cekRentangWaktu(tanggalWaktu, mulaiRentang, selesaiRentang) {
    // Konversi string ke objek Date
    const tanggalWaktuDate = new Date(tanggalWaktu);
    const mulaiRentangDate = new Date(mulaiRentang);
    const selesaiRentangDate = new Date(selesaiRentang);

    // Pengecekan apakah tanggal dan waktu berada dalam rentang
    if (mulaiRentangDate <= tanggalWaktuDate && tanggalWaktuDate <= selesaiRentangDate) {
        return "Tanggal dan waktu berada dalam rentang tanggal dan waktu";
    } else {
        return "Tanggal dan waktu tidak berada dalam rentang tanggal dan waktu";
    }
}

// Contoh Penggunaan:
console.log('Pengecekan pertama 2023-06-26 08:00:00', checkTimeRange("2023-06-26 10:30:00", "2023-06-26 08:00:00", "2023-06-26 12:00:00"));
console.log('Pengecekan kedua 2023-06-27 18:00:00',checkTimeRange("2023-06-26 15:45:30", "2023-06-27 18:00:00", "2023-06-27 20:00:00"));