    </main>

    <footer class="text-white text-center py-3 small mt-auto" style="background-color: #5c1030;">
        <p class="mb-0">&copy; 2026 Sistem Peminjaman Alat Musik Studio &mdash; Jobsheet 10</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $base; ?>assets/js/app.js"></script>
    <?php if (!empty($extra_scripts)): foreach ($extra_scripts as $src): ?>
    <script src="<?php echo $src; ?>"></script>
    <?php endforeach;
    endif; ?>
</body>
</html>