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
            background: #e9ecef; /* Latar belakang error sedikit beda */
            color: #495057;
            text-align: center;
            padding: 3rem 1rem;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .error-container {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            max-width: 600px;
            width: 100%;
        }
        .error-code { /* Style untuk kode error seperti 404, 500 */
            font-size: 6rem;
            font-weight: 300;
            color: #dc3545; /* Merah untuk error */
            margin: 0;
            line-height: 1;
        }
        .error-message { /* Style untuk pesan utama error */
             font-size: 1.5rem;
             font-weight: 300;
             margin-top: 1rem;
             margin-bottom: 1.5rem;
             color: #343a40;
        }
        .error-details { /* Style untuk detail error 500 */
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 2rem;
            text-align: left;
            font-family: monospace;
            font-size: 0.85rem;
            line-height: 1.4;
            word-break: break-all;
            max-height: 300px; /* Batasi tinggi jika terlalu panjang */
            overflow-y: auto; /* Tambah scroll jika perlu */
        }
        .error-details h3 {
            margin-top: 0;
            font-size: 1rem;
            color: #212529;
        }
        .error-details p {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
         .error-details pre {
             background: #e9ecef;
             padding: 10px;
             border-radius: 4px;
             overflow-x: auto;
             white-space: pre-wrap;
             word-wrap: break-word;
         }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .logo-error {
             width: 80px;
             margin-bottom: 1.5rem;
             opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="error-container">
         <?php if (!empty($data['show_logo'])): ?>
             <img src="<?= e(BASEURL) ?>/assets/logo.svg" alt="Simpli Logo" class="logo-error">
         <?php endif; ?>

        <?php
        // Memuat konten error spesifik (404.php atau 500.php)
        if (isset($viewPath) && file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            // Fallback jika file view error tidak ada
             echo '<h1 class="error-code">Error</h1>';
             echo '<p class="error-message">Error view file not found.</p>';
        }
        ?>
    </div>
</body>
</html>