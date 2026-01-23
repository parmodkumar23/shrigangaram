<!DOCTYPE html>
<html lang="hi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Printer Vala - Shri Ganga Ram Enterprises</title>
    <?php include "include/metas.php"; ?>
   
</head>
<body>

    <?php include "include/header.php"; ?>

    

<?php include "include/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Hamburger Menu Toggle
        function toggleMenu() {
            document.getElementById('navLinks').classList.toggle('active');
        }

        // Hero Slider Initialization
        const heroSwiper = new Swiper('.swiper-hero', {
            loop: true,
            autoplay: { delay: 3000 },
            effect: 'fade',
        });

        // Printer Card Breakpoint Slider
        const printerSwiper = new Swiper('.swiper-printers', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: { el: '.swiper-pagination', clickable: true },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 },
            }
        });

        // Modal Logic
        const modal = document.getElementById('contactModal');
        function openModal() { modal.style.display = 'flex'; }
        function closeModal() { modal.style.display = 'none'; }
        function closeModalOutside(e) { if(e.target === modal) closeModal(); }
    </script>
</body>
</html>