<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
</div>
</div>
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
                fetch('../logout.php')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Logout berhasil!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Setelah klik OK, redirect ke halaman login
                                window.location.href = '../../login.php';
                            });
                        }
                    });
            }
        });
    });
</script>
<script src="<?php echo $url; ?>assets/static/js/components/dark.js"></script>
<script src="<?php echo $url; ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>


<script src="<?php echo $url; ?>assets/compiled/js/app.js"></script>



<!-- Need: Apexcharts -->
<script src="<?php echo $url; ?>assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo $url; ?>assets/static/js/pages/dashboard.js"></script>

</body>

</html>