<div class="error-container">
    <?php if ($data['show_logo']): ?>
    <img src="<?= BASEURL ?>/assets/logo.svg" alt="Simpli Logo" width="80" style="margin-bottom: 20px;">
    <?php endif; ?>
    <h1>404</h1>
    <p><?= $data['message'] ?></p>
    <a href="<?= BASEURL ?>" style="color: #4361ee; text-decoration: none;">← Kembali ke Beranda</a>
</div>