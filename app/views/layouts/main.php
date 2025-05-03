<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($data['title'] ?? 'Simpli Framework') ?></title>
    <link rel="icon" href="<?= e(BASEURL) ?>/assets/favicon.svg" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            background: #f8f9fa; /* Sedikit abu-abu */
            color: #212529; /* Warna teks lebih gelap */
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Susun vertikal */
            justify-content: center;
            align-items: center;
            text-align: center;
            line-height: 1.6; /* Sedikit lebih renggang */
            margin: 0;
            padding: 2rem;
            letter-spacing: 0.02em;
        }
        .container {
            background: white;
            padding: 2rem 3rem; /* Padding lebih besar */
            border-radius: 8px; /* Sudut lebih bulat */
            box-shadow: 0 4px 8px rgba(0,0,0,0.05); /* Shadow halus */
            max-width: 550px; /* Lebar maksimal */
            width: 100%;
        }
        .logo {
            width: 150px; /* Ukuran logo disesuaikan */
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
        h1 {
            font-size: 1.8rem; /* Lebih besar */
            font-weight: 300;
            margin-top: 0;
            margin-bottom: 0.75rem;
            color: #343a40;
        }
        p {
            color: #6c757d; /* Warna subteks */
            font-size: 1rem; /* Sedikit lebih besar */
            font-weight: 300;
            margin-bottom: 1rem;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .content {
            margin-top: 1.5rem;
        }
         footer {
            margin-top: 2rem;
            font-size: 0.85rem;
            color: #adb5bd;
         }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?= e(BASEURL) ?>/assets/logo.svg" alt="Simpli Logo" class="logo">
        <h1><?= e($data['message'] ?? 'Simpli Framework') ?></h1>
        <p><?= e($data['submessage'] ?? 'Framework PHP Sederhana') ?></p>

        <hr style="border: 0; border-top: 1px solid #e9ecef; margin: 1.5rem 0;">

        <?php
        // Memuat konten view spesifik (misal: home/index.php)
        if (isset($viewPath) && file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "<p style='color: red;'>Error: View content file not found.</p>";
        }
        ?>

    </div>
     <footer>
        Simpli Framework &copy; <?= date('Y') ?>
     </footer>
</body>
</html>