<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background: #f8f9fa;
            color: #343a40;
            text-align: center;
            padding: 2rem;
            line-height: 1.6;
        }
        .error-container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            font-size: 3rem;
            font-weight: 300;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .error-code {
            font-size: 5rem;
            color: #6c757d;
            opacity: 0.5;
        }
        .error-details {
            background: #fff;
            padding: 1rem;
            border-radius: 5px;
            margin-top: 2rem;
            text-align: left;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <?php 
        $viewPath = '../app/views/errors/' . $view . '.php';
        require_once $viewPath;
        ?>
    </div>
</body>
</html>