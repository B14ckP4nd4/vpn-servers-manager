<!doctype html>
<html {{ str_replace('_', '-', app()->getLocale()) }}>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }}</title>
    <!-- CSS files -->
    <link href="{{asset('/css/dashboard/dashboard.css')}}" rel="stylesheet"/>
</head>
<body class="antialiased border-top-wide border-primary d-flex flex-column">
<div class="page page-center">
    {{$slot}}
</div>
<script src="{{asset('js/dashboard/app.js')}}"></script>
</body>
</html>
