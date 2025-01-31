@props(['data' => []])

@push('meta')
    <title>{{ $data['title'] }} - {{ config('app.name') }}</title>
    <meta name="description" content="{{ $data['description'] }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $data['title'] }}">
    <meta property="og:description" content="{{ $data['description'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $data['image'] }}">

    <meta name="twitter:title" content="{{ $data['title'] }}">
    <meta name="twitter:description" content="{{ $data['description'] }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ $data['image'] }}">
@endpush
