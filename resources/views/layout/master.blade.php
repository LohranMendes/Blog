<!DOCTYPE html>
<html>
    <head>
        @include('layout.head')
        <title>@yield('titulo')</title>
        @stack('script-js')
    </head>

    <body>
        @include('layout.header')

        @yield('conteudo')

        @include('layout.footer')

        @stack('modal_um')

        @stack('scripts')
    </body>
</html>

