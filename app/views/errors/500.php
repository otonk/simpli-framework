<?php
// Konten spesifik untuk error 500
// Variabel $data tersedia dari ErrorController
?>

<h1 class="error-code">500</h1>
<p class="error-message"><?= e($data['message'] ?? 'Terjadi kesalahan pada server.') ?></p>

<?php // Tampilkan detail hanya jika ada error dan DEBUG_MODE aktif ?>
<?php if (!empty($data['error']) && $data['error'] instanceof \Throwable): ?>
<div class="error-details">
    <h3>Detail Error:</h3>
    <p><strong>Message:</strong> <?= e($data['error']->getMessage()) ?></p>
    <p><strong>File:</strong> <?= e($data['error']->getFile()) ?> (Line: <?= e($data['error']->getLine()) ?>)</p>

    <h3>Stack Trace:</h3>
    <pre><?= e($data['error']->getTraceAsString()) ?></pre>
</div>
<?php elseif (empty($data['error']) && defined('DEBUG_MODE') && DEBUG_MODE): ?>
 <div class="error-details">
    <p><em>Detail error tidak tersedia, namun DEBUG_MODE aktif.</em></p>
 </div>
<?php endif; ?>

<p style="margin-top: 2rem; font-size: 0.9rem;">
    <a href="<?= e(BASEURL) ?>">← Kembali ke Beranda</a>
</p>