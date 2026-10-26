document.addEventListener('DOMContentLoaded', function () {
    
    // Fungsi Generik untuk Membuat Slider Berfungsi
    function setupSlider(prevBtnId, nextBtnId, containerId, dotsContainerId) {
        const prevBtn = document.getElementById(prevBtnId);
        const nextBtn = document.getElementById(nextBtnId);
        const container = document.getElementById(containerId);
        const dotsContainer = document.getElementById(dotsContainerId);

        if (!container) return;

        const dots = dotsContainer ? dotsContainer.querySelectorAll('.dot') : [];

        // 1. Tombol Next (Geser ke Kanan)
        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                const scrollAmount = container.clientWidth; // Geser sejauh lebar container
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        }

        // 2. Tombol Prev (Geser ke Kiri)
        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                const scrollAmount = container.clientWidth;
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });
        }

        // 3. Update Dots Aktif Saat Di-scroll
        if (dots.length > 0) {
            container.addEventListener('scroll', function () {
                const scrollPosition = container.scrollLeft;
                const totalWidth = container.scrollWidth - container.clientWidth;
                
                if (totalWidth <= 0) return;

                // Hitung indeks dot berdasarkan posisi scroll
                const activeIndex = Math.round((scrollPosition / totalWidth) * (dots.length - 1));

                dots.forEach((dot, index) => {
                    if (index === activeIndex) {
                        dot.classList.add('active');
                    } else {
                        dot.classList.remove('active');
                    }
                });
            });

            // Klik Dot untuk langsung menuju slide tertentu
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function () {
                    const targetScroll = (container.scrollWidth / dots.length) * index;
                    container.scrollTo({
                        left: targetScroll,
                        behavior: 'smooth'
                    });
                });
            });
        }
    }

    // Jalankan slider untuk Section MENU
    setupSlider('menu-prev', 'menu-next', 'menu-slider-container', 'menu-dots');

    // Jalankan slider untuk Section TESTIMONI
    setupSlider('testi-prev', 'testi-next', 'testi-grid', 'testi-dots');
});

document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('testi-track');
    const prevBtn = document.getElementById('testi-prev');
    const nextBtn = document.getElementById('testi-next');
    const dotsContainer = document.getElementById('testi-dots');

    if (!track) return;

    const cards = track.querySelectorAll('.testimoni-card');
    
    // Generate dots secara otomatis sesuai jumlah kartu testimoni
    if (dotsContainer) {
        dotsContainer.innerHTML = '';
        cards.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => {
                scrollToCard(index);
            });
            dotsContainer.appendChild(dot);
        });
    }

    const dots = dotsContainer ? dotsContainer.querySelectorAll('.dot') : [];

    // Fungsi untuk mendeteksi kartu yang berada di tengah viewport
    function updateCenterCard() {
        const viewportRect = track.parentElement.getBoundingClientRect();
        const viewportCenter = viewportRect.left + viewportRect.width / 2;

        let closestCard = null;
        let minDistance = Infinity;
        let closestIndex = 0;

        cards.forEach((card, index) => {
            const cardRect = card.getBoundingClientRect();
            const cardCenter = cardRect.left + cardRect.width / 2;
            const distance = Math.abs(viewportCenter - cardCenter);

            if (distance < minDistance) {
                minDistance = distance;
                closestCard = card;
                closestIndex = index;
            }

            card.classList.remove('is-center');
        });

        if (closestCard) {
            closestCard.classList.add('is-center');
        }

        // Sinkronisasi status aktif pada dots indikator
        dots.forEach((dot, index) => {
            if (index === closestIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    // Fungsi navigasi geser ke kartu tertentu berdasarkan indeks dot
    function scrollToCard(index) {
        const targetCard = cards[index];
        if (targetCard) {
            const scrollLeftTarget = targetCard.offsetLeft - (track.clientWidth / 2) + (targetCard.clientWidth / 2);
            track.scrollTo({
                left: scrollLeftTarget,
                behavior: 'smooth'
            });
        }
    }

    // Tombol Panah Next & Prev
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            track.scrollBy({ left: 280, behavior: 'smooth' });
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            track.scrollBy({ left: -280, behavior: 'smooth' });
        });
    }

    // Update posisi fokus setiap kali slider digeser (scroll / swipe / drag)
    track.addEventListener('scroll', () => {
        window.requestAnimationFrame(updateCenterCard);
    });

    // Posisikan kartu tengah sebagai fokus awal saat halaman dibuka
    window.addEventListener('load', () => {
        scrollToCard(Math.floor(cards.length / 2));
    });
    setTimeout(updateCenterCard, 150);
});