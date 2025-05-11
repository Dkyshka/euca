<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">

    <meta name="description" content="{{ $page->description ?? '' }}">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="">
    <meta property="og:title" content="{{ $page->name ?? ''}}">
    <meta property="og:description" content="{{ $page->description ?? '' }}">
    <meta property="og:image" content="{{ asset('assets/og-image.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ asset('assets/og-image.png') }}">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
    <link rel="shortcut-icon" href="{{ asset('assets/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('assets/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/safari-pinned-tab.svg') }}" color="#0B1117">
    <meta name="msapplication-TileColor" content="#0B1117">
    <meta name="theme-color" content="#0B1117">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $page->name }}</title>

    <link rel="preload" href="{{ asset('assets/fonts/Inter-Bold.woff') }}" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-Bold.woff') }}" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-Bold.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-BoldItalic.woff') }}" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-BoldItalic.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-Medium.woff') }}" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-Medium.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-MediumItalic.woff') }}" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-MediumItalic.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-Regular.woff') }}" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-Regular.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-SemiBold.woff') }}" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-SemiBold.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/fonts/Inter-SemiBoldItalic.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('assets/css/main.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('assets/css/main.min.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<x-main.assets-svg/>