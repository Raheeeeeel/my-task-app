<!DOCTYPE html>
<html>
<head>
    <title>My First Blade Page</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-align: center;
            padding-top: 100px;
        }
        h1 { font-size: 48px; }
        p { font-size: 24px; }
    </style>
</head>
<body>
    <h1> Hello from Blade!</h1>
    <p>My name is {{ $name }}</p>
    <p>I'm learning Laravel!</p>
</body>
</html>