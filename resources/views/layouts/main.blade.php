@extends('layouts.app')

@section('body')
    @yield('content')

    @isset($slot)
        <main>
            {{ $slot }}
        </main>
    @endisset
@endsection
