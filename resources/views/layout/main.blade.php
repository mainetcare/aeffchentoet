<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Open+Sans:400,600,700&display=swap" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    @include('_layouts.favicons')
    @stack('styles')
    @if(app()->environment('production'))
        @include('_layouts.matomo')
    @endif
</head>
<body class="{{ $bgbody ?? 'bg-white' }} font-serif leading-normal text-gray-800 text-base">
<noscript>
    <style type="text/css">
        .pagecontainer {
            display: none;
        }
    </style>
    <div class="flex justify-center my-5">
        <div class="w-1/2 border-2 border-error-color rounded text-error-color p-2 bg-red-100">
            Hallo! Mach mal Javascript an oder wie oder was! Ist doch nicht so schwer, einmal in Deinem Leben was richtig zu machen.
        </div>
    </div>
</noscript>
<div id="app">

    @include('_layouts.pageerrors')
    @include('_layouts.toast')

{{--    --}}

    @yield('header', View::make('_layouts.header.header'))
    <div>
        @isset($template_content)
            {!! $template_content !!}
        @else
            @yield('content')
        @endisset
    </div>
    @include('_layouts.footer.footer')
</div>
@livewireScripts
<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
