<x-layouts.guest :title="__('Iniciar sesión')">
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 flex items-center justify-center px-4">
    <div class="mx-auto w-full max-w-7xl grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

      {{-- PANEL IZQUIERDO --}}
      <section class="hidden lg:flex justify-center">
        <div class="relative w-[480px] rounded-[32px] bg-white/70 backdrop-blur-xl shadow-2xl ring-1 ring-black/5 p-10">
          <div class="mb-6 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-black text-white font-bold text-lg">PL</div>
          <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Pedidos Lumen</h1>
          <p class="mt-3 text-slate-600 leading-relaxed">
            La forma más simple de gestionar pedidos entre locales y proveedores. Iniciá sesión para continuar.
          </p>

          <ul class="mt-8 space-y-4 text-slate-700">
            <li class="flex items-center gap-3 text-base"><span class="text-xl">🧾</span>Pedidos centralizados por local y proveedor</li>
            <li class="flex items-center gap-3 text-base"><span class="text-xl">📦</span>Control de stock por sucursal</li>
            <li class="flex items-center gap-3 text-base"><span class="text-xl">🔐</span>Accesos por rol (Encargado, Gerente, Administrador)</li>
          </ul>
        </div>
      </section>

      {{-- PANEL DERECHO --}}
      <section class="flex justify-center">
        <div class="w-full max-w-md">
          {{-- logo en mobile --}}
          <div class="mb-6 text-center lg:hidden">
            <div class="mx-auto mb-2 inline-flex h-10 w-10 items-center justify-center rounded-xl bg-black text-white font-bold">PL</div>
            <h2 class="text-xl font-semibold">Pedidos Lumen</h2>
            <p class="text-sm text-slate-500">Iniciá sesión para continuar</p>
          </div>

          <div class="rounded-2xl bg-white p-8 shadow-xl ring-1 ring-black/5">
            @if ($errors->any())
              <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-3 py-2 text-sm text-red-700">
                {{ $errors->first() }}
              </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5" x-data="{ show: false }">
              @csrf

              {{-- Email --}}
              <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <div class="relative">
                  <input type="email" name="email" value="{{ old('email') }}" autocomplete="username" required
                         class="w-full rounded-xl border border-slate-200 bg-white px-3 py-3 pr-10 text-base text-slate-900 outline-none transition focus:border-slate-400"
                         placeholder="tu@correo.com">
                  <span class="pointer-events-none absolute inset-y-0 right-3 grid place-items-center text-slate-400">✉️</span>
                </div>
              </div>

              {{-- Password --}}
              <div>
                <label class="mb-1 block text-sm font-medium text-slate-700">Contraseña</label>
                <div class="relative">
                  <input :type="show ? 'text' : 'password'" name="password" autocomplete="current-password" required
                         class="w-full rounded-xl border border-slate-200 bg-white px-3 py-3 pr-12 text-base text-slate-900 outline-none transition focus:border-slate-400"
                         placeholder="••••••••">
                  <button type="button" @click="show = !show"
                          class="absolute inset-y-0 right-0 px-3 text-slate-500 hover:text-slate-700"
                          aria-label="Mostrar u ocultar contraseña">
                    <span x-show="!show">👁️</span><span x-show="show" x-cloak>🙈</span>
                  </button>
                </div>
              </div>

              {{-- Remember + Forgot --}}
              <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center gap-2 text-slate-600">
                  <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300">
                  Recordarme
                </label>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="text-slate-600 hover:text-slate-800">
                    ¿Olvidaste tu contraseña?
                  </a>
                @endif
              </div>

              {{-- Botón --}}
              <button class="w-full rounded-xl bg-black px-4 py-2.5 text-white text-base font-medium hover:bg-slate-900 transition">
                Entrar
              </button>
            </form>
          </div>

          <p class="mt-6 text-center text-xs text-slate-500">
            © {{ date('Y') }} Pedidos Lumen — Todos los derechos reservados.
          </p>
        </div>
      </section>

    </div>
  </div>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</x-layouts.guest>
