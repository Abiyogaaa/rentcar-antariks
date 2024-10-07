</div>
<footer class="rental-footer">
    <div class="footer-content">
        <div class="footer-section mx-5">
            <h3>About Us</h3>
            <p>Nikmati kemewahan dan kenyamanan dengan layanan penyewaan mobil premium kami. Dari sedan yang ramping hingga SUV yang luas, kami siap melayani perjalanan Anda.</p>
        </div>
        <div class="footer-section mx-2">
            <h3>Our Services</h3>
            <ul>
                <li><a href="#">Premium Fleet</a></li>
                <li><a href="#">Corporate Rentals</a></li>
                <li><a href="#">Wedding Packages</a></li>
                <li><a href="#">Airport Transfers</a></li>
                <li><a href="#">Long-term Leasing</a></li>
            </ul>
        </div>
        <div class="footer-section mx-2">
            <h3>Contact Us</h3>
            <p><i class="fas fa-envelope"></i> auliarentcar@gmail.com</p>
            <p><i class="fas fa-phone"></i> (555) 123-4567</p>
            <p><i class="fas fa-map-marker-alt"></i> Banjarbaru, Kalimantan Selatan</p>
        </div>
        <div class="footer-section mx-2">
            <h3>Follow Us</h3>
            <div class="social-icons">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 AULIA.RENTCAR All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </div>
</footer>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Roboto:wght@300;400&display=swap');

    .rental-footer {
        background: linear-gradient(135deg, #add8e6, #f0f0f0, #add8e6);

        color: black;
        font-family: 'Roboto', sans-serif;
        position: relative;
        padding: 100px 0 20px;
    }

    .footer-divider {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }

    .footer-divider svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 80px;
    }

    .footer-divider .shape-fill {
        fill: black;
    }

    .footer-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-section {
        flex: 1;
        min-width: 200px;
        margin-bottom: 30px;
    }

    .footer-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-section h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background: #fdbb2d;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
    }

    .footer-section ul li {
        margin-bottom: 12px;
    }

    .footer-section a {
        color: black;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-section a:hover {
        color: #fdbb2d;
        padding-left: 5px;
    }

    .social-icons {
        display: flex;
        gap: 15px;
    }

    .social-icon {
        background: rgba(255, 255, 255, 0.1);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .social-icon:hover {
        background: #fdbb2d;
        transform: translateY(-3px);
    }

    .footer-bottom {
        text-align: center;
        padding-top: 20px;
        margin-top: 40px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-bottom a {
        color: #fdbb2d;
        text-decoration: none;
    }

    .footer-bottom a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .footer-section {
            flex-basis: 100%;
            text-align: center;
        }

        .footer-section h3::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .social-icons {
            justify-content: center;
        }
    }
</style>
<script>
    document.getElementById('logoutButton').addEventListener('click', function(e) {
        e.preventDefault(); // Mencegah link berjalan secara default

        Swal.fire({
            title: 'Apakah Anda yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ajax untuk melakukan logout
                fetch('admin/logout.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Logout berhasil!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Setelah klik OK, redirect ke halaman login
                                window.location.href = 'index.php';
                            });
                        }
                    });
            }
        });
    });
</script>
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>