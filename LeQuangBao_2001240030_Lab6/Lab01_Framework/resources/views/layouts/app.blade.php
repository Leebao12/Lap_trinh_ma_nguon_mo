<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>
        @yield('title', 'Lab 01')
    </title>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th,td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background: #f3f4f6;
            text-align: left;
        }
        .adult {
            font-weight: 600;
        }
        nav {
            margin-bottom: 10px;
        }
        nav a {
            text-decoration: none;
        }
        main {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    {{-- Header được tách thành partial --}}
    @include('partials.header')
    <main>
        @yield('content')
    </main>
    <footer>
        <hr>
        <small>
            &copy; HUIT – Khoa CNTT
        </small>
    </footer>
</body>
</html>