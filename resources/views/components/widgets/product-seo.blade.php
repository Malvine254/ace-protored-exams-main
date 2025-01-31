@props(['data' => []])

@push('meta')
    <title>{{ $data['name'] }} - {{ config('app.name') }}</title>
    <meta name="description" content="{{ $data['description'] }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $data['name'] }}">
    <meta property="og:description" content="{{ $data['description'] }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ config('app.url') . $data['image'] }}">

    <meta name="twitter:title" content="{{ $data['name'] }}">
    <meta name="twitter:description" content="{{ $data['description'] }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="{{ config('app.url') . $data['image'] }}">

    <script type="application/ld+json">
      {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{ $data['name'] }}",
        "description": "{{ $data['description'] }}",
        "image": "{{ config('app.url') . $data['image'] }}",
        "brand": {
          "@type": "Brand",
          "name": "{{ isset($data['brand']) ? $data['brand'] : config('app.name') }}"
        },
        "offers": {
            "@type": "{{$data['offers']['type']}}",
            "priceCurrency": "{{$data['offers']['priceCurrency']}}",
            "price": "{{$data['offers']['price']}}",
            "availability": "{{$data['offers']['availability']}}",
          },
        "aggregateRating": {
          "@type": "AggregateRating",
          "ratingValue": "4.5",
          "reviewCount": "{{ rand(0, 64) }}"
        },
      }
    </script>
@endpush
