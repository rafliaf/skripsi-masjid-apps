function processQueue(items) {
    let itemsLength = items.length;
    
    // proses antrian 
    for (let i = 0; i < itemsLength; i++) {
        let num = items.shift(); // mengambil elemen dari antrian

        // Jika ganjil, kalikan dengan 2 dan masukkan kembali ke antrian
        if (num % 2 !== 0) {
            items.push(num * 2);
        } 
        // Jika genap, bagi dengan 2 dan masukkan kembali ke antrian
        else {
            items.push(num / 2);
        }
    }
    return items;
}

// Hasil:
console.log('Output ke-1', processQueue([1, 2, 3, 4, 5]));
console.log('Output ke-2', processQueue([10, 20, 30, 40, 50])); 
