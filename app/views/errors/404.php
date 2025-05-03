<?php
// Konten spesifik untuk error 404
// Variabel $data tersedia dari ErrorController
?>

<h1 class="error-code">404</h1>
<p class="error-message"><?= e($data['message'] ?? 'Halaman tidak ditemukan.') ?></p>
<a href="<?= e(BASEURL) ?>" style="font-size: 0.9rem;">← Kembali ke Beranda</a>