<?php
require __DIR__ . "/admin/config/db.php";

/* ================= SAFETY CHECK ================= */
if (!isset($services)) {
    die("Services collection not available");
}

/* ================= FETCH SERVICES ================= */
$data = $services->find(
    [],
    [
        "sort"  => ["created_at" => -1],
        "limit" => 8
    ]
);
?>
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

    <div class="hero-section">
        <div class="swiper swiper-hero">
            <div class="swiper-wrapper">
                <div class="swiper-slide hero-slide" style="background-image: url('images/slide1.jpg')">
                    <!-- <div class="hero-content"><h2>High Speed Laser Printers</h2></div> -->
                </div>
                <div class="swiper-slide hero-slide" style="background-image: url('images/slide2.jpg')">
                    <!-- <div class="hero-content"><h2>Affordable Rental Plans</h2></div> -->
                </div>
                 <div class="swiper-slide hero-slide" style="background-image: url('images/slide3.jpg')"></div>
                  <div class="swiper-slide hero-slide" style="background-image: url('images/slide4.jpg')"></div>
            </div>
        </div>

        <div class="search-overlay">
            <h1>Shri Ganga Ram Enterprises</h1>
            <p>Check available printers, scanners or spare parts for rent</p>
            <div class="search-box">
                <input type="text" placeholder="Search for printers (e.g. HP, Canon)...">
                <button><i class="fas fa-search"></i> Search</button>
            </div>
        </div>
    </div>
<section class="about-section" id="about-us">
    <div class="about-image-container">
        <img src="images/about.jpg" alt="Shri Ganga Ram Enterprises Office">
        <div class="exp-badge">
            <h3 style="font-size: 2rem;">10+</h3>
            <p style="font-size: 0.8rem;">Years of <br> Excellence</p>
        </div>
    </div>

    <div class="about-content">
        <span class="sub-tag"> Shri Ganga Ram Enterprises</span>
        <h2>Who We Are <br> <span style="color: var(--primary);">(Printer Vala)</span></h2>
        
        <p>Welcome to <b>Shri Ganga Ram Enterprises</b>, your premier destination for high-quality printing and scanning solutions. Known as <b>Printer Vala</b>, we specialize in flexible rental services tailored for businesses, home offices, and individuals.</p>
        
        <p>We provide state-of-the-art technology without the heavy investment, ensuring your workflow remains uninterrupted with our diverse fleet of printers and scanners.</p>

        <ul class="trust-points">
            <li><i class="fas fa-check-circle"></i> Flexible Rental Plans</li>
            <li><i class="fas fa-check-circle"></i> 100% Document Confidentiality</li>
            <li><i class="fas fa-check-circle"></i> On-demand Spare Parts & Ink Support</li>
        </ul>

        <div class="about-stats">
            <div class="stat-box">
                <h3>500+</h3>
                <span>Happy Clients</span>
            </div>
            <div class="stat-box">
                <h3>50+</h3>
                <span>Modern Models</span>
            </div>
            <div class="stat-box">
                <h3>24/7</h3>
                <span>Tech Support</span>
            </div>
        </div>

        <a href="#" class="about_btn">Read More</a>
    </div>
</section>
    <section class="printer-section">
        <h2 class="section-title">Rent Featured Printers</h2>
        <div class="swiper swiper-printers">
            <div class="swiper-wrapper">
				
				<?php foreach ($data as $row): ?>
    <div class="swiper-slide">
        <div class="printer-card">
            <img src="images/uploads/<?= htmlspecialchars($row["image"]) ?>" alt="Printer">
            <div class="card-info">
                <h3><?= htmlspecialchars($row["title"]) ?></h3>
                <h5><?= htmlspecialchars($row["subtitle"]) ?></h5>
                <p><?= htmlspecialchars($row["description"] ?? "") ?></p>
                <span class="rent-price">
                    ₹ <?= htmlspecialchars($row["pricing"]) ?> / Day
                </span>
				<div style="display: grid; column-gap: 10px; grid-template-columns: auto auto auto;">
                <a href="https://wa.me/<?= htmlspecialchars($row["whatsapp"]) ?>" target="_blank" class="contact-btn wa-btn" style="text-decoration: none; font-size: 2em;">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="tel:<?= htmlspecialchars($row["phone"]) ?>" class="contact-btn call-btn" style="text-decoration: none;">
                    <i class="fas fa-phone-alt"></i> Call
                </a>
					<a href="tel:<?= htmlspecialchars($row["phone"]) ?>" class="contact-btn call-btn" style="text-decoration: none;">
                     Detail
                </a>
					</div>
            </div>
        </div>
    </div>
				
<!--
				    <div class="modal-overlay" id="contactModal" onclick="closeModalOutside(event)">
        <div class="modal">
            <div class="modal-header">
                <h3>Contact for Rent</h3>
                <span style="position:absolute; right:20px; top:20px; cursor:pointer" onclick="closeModal()"><i class="fas fa-times"></i></span>
            </div>
            <div class="modal-body">
                <a href="https://wa.me/<?//= htmlspecialchars($row["whatsapp"]) ?>" target="_blank" class="contact-btn wa-btn">
                    <i class="fab fa-whatsapp"></i> Chat on WhatsApp
                </a>
                <a href="tel:<?//= htmlspecialchars($row["phone"]) ?>" class="contact-btn call-btn">
                    <i class="fas fa-phone-alt"></i> Call: +91 <?//= htmlspecialchars($row["phone"]) ?>
                </a>
            </div>
        </div>
    </div>
-->
<?php endforeach; ?>
				
				

            </div>
<!--            <div class="swiper-pagination"></div>-->
        </div>
         <a href="#" class="service-btn" >More Products</a>
    </section>


    
    <section class="services-wrapper">
    <div class="services-header">
        <h2>Our Specialized Services</h2>
        <p>Welcome to <span style="color: #fff">Shri Ganga Ram Enterprises</span>, your premier destination for high-quality printing and scanning solutions. Known in the market as Printer Vala, we specialize in providing flexible and affordable rental services tailored to meet the needs of businesses, home offices, and individuals.</p>
    </div>

    <div class="services-container">
        <div class="service-box">
            <div class="icon-circle"><i class="fas fa-print"></i></div>
            <h3>Printer Rentals</h3>
            <p>We provide a wide range of high-performance printers on a flexible rental basis, perfect for offices, events, or home use.</p>
        </div>

        <div class="service-box">
            <div class="icon-circle"><i class="fas fa-file-invoice"></i></div>
            <h3>Scanner Solutions</h3>
            <p>From high-speed document feeders to flatbed scanners, we offer top-tier scanning equipment to digitize your paperwork efficiently.</p>
        </div>

        <div class="service-box">
            <div class="icon-circle"><i class="fas fa-microchip"></i></div>
            <h3>Parts & Refills</h3>
            <p>Already have a printer? We provide rental spare parts, ink cartridges, and toners to ensure your work never stops due to hardware failure.</p>
        </div>

        <div class="service-box">
            <div class="icon-circle"><i class="fas fa-user-lock"></i></div>
            <h3>Confidential Printing</h3>
            <p>Visit our office for high-quality printing. We guarantee 100% document privacy and confidentiality for all your sensitive data.</p>
            <div class="privacy-badge"><i class="fas fa-shield-alt"></i> SECURE & PRIVATE</div>
        </div>
    </div>
    <a href="#" class="service-btn">View Detail</a>
</section>
<section class="contact-section" id="contact">
    <div class="contact-wrapper">
        <div class="contact-details">
            <h2>Reach Out to Us</h2>
            
            <div class="detail-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h4>Registered Office</h4>
                    <p>Shri Ganga Ram Enterprises,<br>Mustafabad, Maghar Pura, Haryana 133103</p>
                </div>
            </div>

            <div class="detail-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <h4>Contact Numbers</h4>
                    <p>+91 98765 43210 (Sales)<br>+91 11 2345 6789 (Support)</p>
                </div>
            </div>

            <div class="detail-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h4>Email Support</h4>
                    <p>rentals@printervala.com<br>info@shrigangaram.com</p>
                </div>
            </div>

            <div class="map-box">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13753.535975608677!2d77.141671!3d30.1986451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390eb5007deef91b%3A0x284cb26a74759e2b!2sShri%20Ganga%20Enterprises!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" 
                    allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>

        <div class="enquiry-card">
            <h3>Send an Enquiry</h3>
            <form action="#">
                <div class="input-field">
                    <label>Your Full Name</label>
                    <input type="text" placeholder="Enter your name" required>
                </div>
                <div class="input-field">
                    <label>Phone Number</label>
                    <input type="tel" placeholder="Enter mobile number" required>
                </div>
                <div class="input-field">
                    <label>I'm Interested In</label>
                    <select>
                        <option>Printer Rental</option>
                        <option>Scanner Rental</option>
                        <option>Spare Parts / Ink</option>
                        <option>Confidential Printing Service</option>
                        <option>General Inquiry</option>
                    </select>
                </div>
                <div class="input-field">
                    <label>Your Message (Optional)</label>
                    <textarea rows="4" placeholder="Tell us more about your requirement..."></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message <i class="fas fa-paper-plane" style="margin-left: 10px;"></i></button>
            </form>
        </div>
    </div>
</section>
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
			autoplay: { delay: 3000 },
			loop:true,
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