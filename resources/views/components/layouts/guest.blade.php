{{-- guest.blade.php (sin Livewire si no lo usás) --}}
@props(['title' => config('app.name')])

<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="h-full bg-neutral-50 text-neutral-900 antialiased">
  <div class="min-h-screen flex items-center justify-center px-4 py-8">
    {{ $slot }}
  </div>
</body>
</html>
