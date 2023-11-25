<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email</title>
    <style>
        /* Estilos */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 20px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }
        .button-preboleta {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Envío de Preboleta de {{ $data['nombre_periodo'] }}</h3>
        <p>¡Hola!</p>
        <p>{{ $data['body'] }}</p>
        <a class="button-preboleta" href="{{ $data['url'] }}">Ver preboleta</a>
    </div>
</body>
</html>