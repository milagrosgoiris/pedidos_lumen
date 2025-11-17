<!DOCTYPE html>
<html lang="es" class="h-full"
      x-data
      x-init="
        const saved = localStorage.getItem('theme') ?? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark':'light');
        document.documentElement.classList.toggle('dark', saved==='dark');
      ">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title ?? config('app.name') }}</title>

  @vite(['resources/css/app.css','resources/js/app.js'])
  @livewireStyles
</head>
<body class="min-h-screen bg-neutral-50 dark:bg-neutral-950 text-neutral-900 dark:text-neutral-100 antialiased">
  {{-- Topbar simple de ejemplo (podés dejar el tuyo) --}}
  <header class="sticky top-0 z-30 bg-white/90 dark:bg-neutral-900/80 backdrop-blur border-b border-neutral-200 dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 h-14 flex items-center justify-between">
      <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 font-semibold">
        <span class="h-8 w-8 rounded-xl bg-black text-white grid place-items-center">PL</span>
        <span>Pedidos Lumen</span>
      </a>

      <nav class="flex items-center gap-4 text-sm">
        <a href="{{ route('pedidos.index') }}" class="hover:underline">Pedidos</a>
        <a href="{{ route('productos.index') }}" class="hover:underline">Productos</a>
        <a href="{{ route('marcas.index') }}" class="hover:underline">Marcas</a>
        <a href="{{ route('proveedores.index') }}" class="hover:underline">Proveedores</a>
        <a href="{{ route('locales.index') }}" class="hover:underline">Locales</a>

       <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button class="rounded-lg bg-neutral-900 text-white px-3 py-1.5 hover:bg-neutral-800">Salir</button>
        </form>
      </nav>
    </div>
  </header>

  <main class="max-w-7xl mx-auto px-4 py-8">
    {{ $slot }}
  </main>

  @livewireScripts
</body>
</html>
