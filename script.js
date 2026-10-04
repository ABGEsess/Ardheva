const slides = ["Gambar 1", "Gambar 2", "Gambar 3"];
let i = 0;

function ganti(n) {
    i = (i + n + slides.length) % slides.length;
    document.getElementById("slide").textContent = slides[i]
}