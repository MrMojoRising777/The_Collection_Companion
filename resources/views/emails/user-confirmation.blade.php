<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactformulier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contactformulier</h1>
        {{ $data['name'] }}
        <p><strong>Bericht:</strong> {{ $data['message'] }}</p>
        <hr>
        <p>Dankje voor je bericht. We hopen je zo snel mogelijk terug te sturen.</p>
    </div>
</body>
</html>
