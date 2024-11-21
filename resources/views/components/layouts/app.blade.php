<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Page Title' }} - {{ config('app.name', 'Laravel') }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>
<body>
    <div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
        @isset($topbar)
        <div id="top-bar" class="flex justify-between items-center px-4 mt-[60px]">
            {{ $topbar }}
        </div>
        @endisset
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @isset($script)
    {{ $script }}
    @endisset
    @livewireScripts
</body>
</html>
