const metodePembayaran = document.querySelector('#metodePembayaran');
const buktiPembayaran = document.getElementById('bukti-pembayaran');
const qrCode = document.querySelector('#qrcode');
const imagePayment = document.querySelector('#imagePayment');

metodePembayaran.addEventListener("change", function () {
    if (this.value === 'non-tunai') {
        qrCode.classList.remove('hidden');
        qrCode.classList.add('flex');
        buktiPembayaran.classList.remove('hidden');
        buktiPembayaran.classList.add('block');
    } else {
        qrCode.classList.add('hidden');
        qrCode.classList.remove('flex');
        buktiPembayaran.classList.add('hidden');
        buktiPembayaran.classList.remove('block');
    }
});

imagePayment.addEventListener('click', () => {
    qrCode.classList.add('hidden');
});

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