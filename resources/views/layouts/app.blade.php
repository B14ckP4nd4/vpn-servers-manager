<!doctype html>
<html {{ str_replace('_', '-', app()->getLocale()) }}>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Dashboard</title>
    <!-- CSS files -->
    <link href="{{asset('/css/dashboard/dashboard.css')}}" rel="stylesheet"/>
    @livewireStyles
</head>
<body class="antialiased">
{{$slot}}

@livewireScripts
</body>
</html>
