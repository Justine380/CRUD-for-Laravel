<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Custom Home Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Welcome to My Laravel Application</h1>
    </header>

    <div class="content">
        <p>This is a custom home page that replaces the default Laravel home page.</p>

    </div>

    <footer>
        <p>&copy; {{ date('Y') }} My Laravel App</p>
    </footer>
</body>
</html>

