<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>@yield("title", "Employee Task Management")</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FontAwesome CSS -->
        <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" />

        <!-- Custom styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>

    <body>
        @yield("content")

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Custom scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
