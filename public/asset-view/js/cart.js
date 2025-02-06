// PAYMENT
const metodePembayaran = document.querySelector('#metodePembayaran');
const qrCode = document.querySelector('#qrcode');
const imagePayment = document.querySelector('#imagePayment');

metodePembayaran.addEventListener('change', function () {
    if (this.value === 'non-tunai') {
        qrCode.classList.remove('hidden');
        qrCode.classList.add('flex');
    } else {
        qrCode.classList.add('hidden');
        qrCode.classList.remove('flex');
    }
});


imagePayment.addEventListener('click', () => {
    qrCode.classList.add('hidden');
});

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