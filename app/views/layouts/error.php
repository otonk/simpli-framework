<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($data['title'] ?? 'Error') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background: #e9ecef; /* Background error */
            color: #495057;
            text-align: center;
            padding: 3rem 1rem;
            line-height: 1.6;
            display: flex;
            flex-direction: column; /* Susun vertikal */
            justify-content: center; /* Pusatkan vertikal */
            align-items: center; /* Pusatkan horizontal */
            min-height: calc(100vh - 6rem); /* Tinggi minimal body dikurangi padding */
            margin: 0;
        }
        /* Hapus style .error-container */

        .error-code {
            font-size: 6rem;
            font-weight: 300;
            color: #dc3545;
            margin: 0;
            line-height: 1;
        }
        .error-message {
             font-size: 1.5rem;
             font-weight: 300;
             margin-top: 1rem;
             margin-bottom: 1.5rem;
             color: #343a40;
        }
        .error-details { /* Detail error 500 tetap pakai box */
            background: #fff; /* Background putih untuk detail */
            border: 1px solid #dee2e6;
            padding: 1.5rem; /* Padding lebih besar */
            border-radius: 8px; /* Sudut lebih bulat */
            margin-top: 2rem;
            text-align: left;
            font-family: monospace;
            font-size: 0.85rem;
            line-height: 1.4;
            word-break: break-all;
            max-height: 400px; /* Batasi tinggi */
            overflow-y: auto;
            max-width: 800px; /* Batasi lebar detail error */
            width: 90%; /* Lebar relatif */
            box-shadow: 0 2px 4px rgba(0,0,0,0.05); /* Shadow halus */
        }
        .error-details h3 {
            margin-top: 0;
            font-size: 1rem;
            color: #212529;
            margin-bottom: 1rem; /* Jarak bawah heading detail */
        }
        .error-details p {
            margin-bottom: 0.75rem; /* Jarak antar paragraf detail */
            font-size: 0.9rem;
        }
         .error-details pre {
             background: #f1f3f5; /* Background pre lebih terang */
             padding: 15px; /* Padding lebih besar */
             border-radius: 4px;
             overflow-x: auto;
             white-space: pre-wrap;
             word-wrap: break-word;
             border: 1px solid #dee2e6; /* Border halus di pre */
         }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: 400; /* Sedikit tebalkan link */
        }
        a:hover {
            text-decoration: underline;
        }
        .logo-error {
             width: 80px;
             margin-bottom: 1.5rem;
             opacity: 0.8;
        }
        .back-link { /* Style untuk link kembali */
            margin-top: 2rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
     <?php if (!empty($data['show_logo'])): ?>
         <img src="<?= e(BASEURL) ?>/assets/logo.svg" alt="Simpli Logo" class="logo-error">
     <?php endif; ?>

    <?php
    // Memuat konten error spesifik (404.php atau 500.php)
    // Konten ini sekarang akan langsung di dalam body
    if (isset($viewPath) && file_exists($viewPath)) {
        require_once $viewPath;
    } else {
         echo '<h1 class="error-code">Error</h1>';
         echo '<p class="error-message">Error view file not found.</p>';
    }
    ?>

    <div class="back-link">
        <a href="<?= e(BASEURL) ?>">← Kembali ke Beranda</a>
    </div>

</body>
</html>
