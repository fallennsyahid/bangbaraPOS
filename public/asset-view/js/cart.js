// PAYMENT





// metodePembayaran.addEventListener('change', function () {
//     if (this.value === 'non-tunai') {
//         qrCode.classList.remove('hidden');
//         qrCode.classList.add('flex');
//         buktiPembayaran.classList.remove('hidden');
//         buktiPembayaran.classList.add('flex')
//     } else {
//         qrCode.classList.add('hidden');
//         qrCode.classList.remove('flex');
//         buktiPembayaran.classList.add('hidden');
//         buktiPembayaran.classList.remove('flex');
//     }
// });



// metodePembayaran.addEventListener('change', function () {
//     const isNonTunai = this.value === 'non-tunai';

//     qrCode.classList.toggle('hidden', !isNonTunai);
//     qrCode.classList.toggle('flex', isNonTunai);

//     // buktiPembayaran.classList.toggle('hidden', !isNonTunai);
//     // buktiPembayaran.classList.toggle('flex', isNonTunai);

//     // buktiPembayaran.style.display = isNonTunai ? 'block' : 'none';
// });



// File Upload
function updateFileName(input) {
    const fileName = input.files[0]?.name || "Tidak ada file yang dipilih";
    document.getElementById("file-name").textContent = fileName;
}

// NOTE
const textArea = document.querySelector("#message");
const noteBook = document.querySelector("#notebook");

const toggleNoteBook = () => {
    if (textArea.value.trim() === "") {
        noteBook.classList.remove("hidden");
    } else {
        noteBook.classList.add("hidden");
    }
};

textArea.addEventListener("focus", () => {
    textArea.setAttribute("placeholder", "");
    noteBook.classList.add("hidden");
});

textArea.addEventListener("blur", () => {
    textArea.setAttribute("placeholder", "Masukkan");
    toggleNoteBook();
});

textArea.addEventListener("input", toggleNoteBook);

// ICONS
feather.replace();