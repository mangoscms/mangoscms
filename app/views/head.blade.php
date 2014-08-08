<head>
    <meta charset="UTF-8">
    <meta name="robots" content="{{ Config::get('mangoscms.head.robots') }}">
    <meta name="keywords" content="{{ Config::get('mangoscms.head.keywords') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Config::get('mangoscms.head.title') }}</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    @if (Config::get('mangoscms.site.customcss') == 1)
        {{ HTML::style('css/custom.css') }}
    @endif
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdn.ckeditor.com/4.4.2/standard/ckeditor.js"></script>
</head>