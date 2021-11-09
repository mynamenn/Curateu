<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Curators</title>

    <!-- Fonts -->
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
    <x-navbar></x-navbar>
    <x-introduction></x-introduction>
    <x-categories :categories="$categories"></x-categories>
    <x-collections :collections="$collections"></x-collections>
</body>

</html>
