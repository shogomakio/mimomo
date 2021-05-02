<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="antialiased">
    <p>hola</p>
    <div>
        <form id="frm-logout" action="{{ route('user.processDelete') }}" method="POST">
            {{ csrf_field() }}
            <p>delete this now</p>
            <button type="submit">アカウントを削除する</button>
        </form>
    </div>
</body>

</html>
