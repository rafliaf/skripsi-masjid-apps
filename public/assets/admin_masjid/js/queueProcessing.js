function processQueue(items) {
    let itemsLength = items.length;
    
    for (let i = 0; i < itemsLength; i++) {
        let num = items.shift();

        if (num % 2 !== 0) {
            items.push(num * 2);
        } 
        else {
            items.push(num / 2);
        }
    }
    return items;
}

// Hasil:
console.log('Output ke-1', processQueue([1, 2, 3, 4, 5]));
console.log('Output ke-2', processQueue([10, 20, 30, 40, 50])); 
