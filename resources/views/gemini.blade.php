<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- Icon Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- My Style --}}
    {{-- <link rel="stylesheet" href="{{ URL::to('/') }}/css/style.css"> --}}
    <link rel="preload" href="{{ URL::to('/') }}/css/style.css" as="style" onload="this.rel='stylesheet'">

    <title>Holee Sheet | {{ $title }}</title>
    @livewireStyles
  </head>
  <body>
    <main>
        <livewire:chat-gemini/>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @livewireScripts
    {{-- <script src="{{ URL::to('/') }}/js/script.js"></script> --}}
    @stack('scripts')
  </body>
</html>