<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
    <link rel="icon" href="<?= BASEURL ?>/assets/favicon.svg" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            font-weight: 300; /* Lato Light (300 weight) */
            background: white;
            color: #222;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            line-height: 1.5;
            margin: 0;
            padding: 2rem;
            letter-spacing: 0.02em; /* Slightly more elegant spacing */
        }
        .container {
            max-width: 450px;
        }
        .logo {
            width: 180px;
            margin-bottom: 1.5rem;
            opacity: 0.9; /* Slightly softer logo */
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 300; /* Thin weight for heading too */
            margin-bottom: 0.5rem;
        }
        p {
            color: #666;
            font-size: 0.9rem;
            font-weight: 300;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?= BASEURL ?>/assets/logo.svg" alt="Simpli Logo" class="logo">
        <h1><?= $data['message'] ?? 'Anda menggunakan Simpli Framework 1.0' ?></h1>
        <p><?= $data['submessage'] ?? 'a simple PHP framework' ?></p>
    </div>
</body>
</html>