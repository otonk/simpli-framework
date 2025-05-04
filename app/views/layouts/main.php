<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($data['title'] ?? 'Simpli Framework') ?></title>
    <link rel="icon" href="<?= e(BASEURL) ?>/assets/favicon.svg" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        /* Styling dasar */
        body {
            font-family: 'Lato', sans-serif;
            font-weight: 300;
            background: #f8f9fa;
            color: #212529;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 1rem;
            box-sizing: border-box;
        }

        .logo {
            width: 150px;
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }
        h1.main-greeting {
            font-size: 1.8rem;
            font-weight: 300;
            margin-top: 0;
            margin-bottom: 0.75rem;
            color: #343a40;
            text-align: center;
        }
        p.main-subgreeting {
            color: #6c757d;
            font-size: 1rem;
            font-weight: 300;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .view-content { /* Wrapper untuk konten dari view */
             width: 100%;
             max-width: 1140px;
             text-align: center; /* <<< TAMBAHKAN INI untuk rata tengah */
             margin-bottom: 2rem;
        }
         footer {
            padding-top: 1rem;
            font-size: 0.85rem;
            color: #adb5bd;
            text-align: center;
            width: 100%;
         }
         /* Styling tambahan untuk tabel */
         /* Pastikan tabelnya sendiri tidak ikut rata tengah jika tidak diinginkan */
         table.dataTable {
             width: 100% !important;
             margin: 1em auto; /* Gunakan margin auto agar tabel tetap di tengah block */
             text-align: left; /* Teks di dalam tabel tetap rata kiri */
             background-color: white;
             border: 1px solid #dee2e6;
             border-radius: 5px;
             box-shadow: 0 2px 4px rgba(0,0,0,0.05);
         }
         table.dataTable th,
         table.dataTable td {
            padding: 10px 12px;
            border-bottom: 1px solid #dee2e6;
         }
         table.dataTable thead th {
             background-color: #f8f9fa;
             border-bottom-width: 2px;
         }

    </style>
</head>
<body>
    <img src="<?= e(BASEURL) ?>/assets/logo.svg" alt="Simpli Logo" class="logo">

    <?php if (isset($data['message'])): ?>
        <h1 class="main-greeting"><?= e($data['message']) ?></h1>
    <?php endif; ?>
    <?php if (isset($data['submessage'])): ?>
        <p class="main-subgreeting"><?= e($data['submessage']) ?></p>
    <?php endif; ?>

    <div class="view-content">
        <?php
        if (isset($viewPath) && file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "<p style='color: red; text-align: center;'>Error: View content file not found.</p>";
        }
        ?>
    </div>

     <footer>
        Simpli Framework &copy; <?= date('Y') ?>
     </footer>

     <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
     <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
     <?php if (isset($data['scripts'])): ?>
         <?= $data['scripts'] ?>
     <?php endif; ?>

</body>
</html>
