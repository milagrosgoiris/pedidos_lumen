<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Pedido #{{ $pedido->id }} - {{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/css/app.css'])
  <style>
    /* Tamaño A4 y márgenes en impresión */
    @page { size: A4; margin: 14mm; }
    @media print {
      .no-print { display: none !important; }
      html, body { background: #fff !important; }
      table { page-break-inside: auto; }
      tr { page-break-inside: avoid; page-break-after: auto; }
      .page-break { page-break-after: always; }
    }
  </style>
</head>
<body class="bg-neutral-100 text-neutral-900">
  <div class="no-print bg-neutral-50 border-b border-neutral-200">
    <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center gap-2">
        <span class="h-8 w-8 rounded-xl bg-black text-white grid place-items-center">PL</span>
        <strong>Pedidos Lumen</strong>
      </div>
      <div class="flex items-center gap-2">
        <button onclick="window.print()" class="rounded-lg bg-black text-white px-3 py-1.5">Imprimir</button>
        <button onclick="window.close()" class="rounded-lg border px-3 py-1.5">Cerrar</button>
      </div>
    </div>
  </div>

  <div class="max-w-4xl mx-auto bg-white shadow-sm my-6 p-8">
    {{-- Encabezado --}}
    <div class="flex items-start justify-between">
      <div>
        <h1 class="text-2xl font-semibold">Pedido #{{ $pedido->id }}</h1>
        <div class="text-sm text-neutral-600">Fecha: {{ $pedido->created_at?->format('d/m/Y H:i') }}</div>
      </div>
      <div class="text-right text-sm">
        <div><span class="text-neutral-500">Tipo:</span>
          <strong>{{ $pedido->tipo==1 ? 'A proveedor' : 'Entre locales' }}</strong>
        </div>
        <div><span class="text-neutral-500">Estado:</span>
          @php
            $label = [0=>'Borrador',1=>'Solicitado',2=>'Aprobado',3=>'Preparado',4=>'Enviado',5=>'Recibido',9=>'Cancelado'][$pedido->estado] ?? '—';
          @endphp
          <strong>{{ $label }}</strong>
        </div>
      </div>
    </div>

    {{-- Datos --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6 text-sm">
      <div class="rounded-lg border p-3">
        <div class="text-neutral-500">Proveedor</div>
        <div class="font-medium">{{ $pedido->proveedor->nombre ?? '—' }}</div>
      </div>
      <div class="rounded-lg border p-3">
        <div class="text-neutral-500">Origen</div>
        <div class="font-medium">{{ $pedido->origen->nombre ?? '—' }}</div>
      </div>
      <div class="rounded-lg border p-3">
        <div class="text-neutral-500">Destino</div>
        <div class="font-medium">{{ $pedido->destino->nombre ?? '—' }}</div>
      </div>
    </div>

    {{-- Ítems --}}
    <div class="mt-8">
      <table class="w-full text-sm border border-neutral-200">
        <thead class="bg-neutral-50">
          <tr class="text-neutral-600">
            <th class="text-left px-3 py-2 border-b">Producto</th>
            <th class="text-left px-3 py-2 border-b">Unidad</th>
            <th class="text-right px-3 py-2 border-b">Cant. solicitada</th>
            <th class="text-right px-3 py-2 border-b">Precio unit.</th>
            <th class="text-right px-3 py-2 border-b">Subtotal</th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @forelse($pedido->items as $it)
            @php
              $pu = $it->precio_unitario ?? 0;
              $sub = $pu * (float)$it->cantidad_solicitada;
              $total += $sub;
            @endphp
            <tr class="border-b">
              <td class="px-3 py-2">{{ $it->producto->nombre ?? '—' }}</td>
              <td class="px-3 py-2">{{ $it->producto->unidad_base ?? '—' }}</td>
              <td class="px-3 py-2 text-right">{{ number_format($it->cantidad_solicitada,3) }}</td>
              <td class="px-3 py-2 text-right">{{ $pu ? number_format($pu,2) : '—' }}</td>
              <td class="px-3 py-2 text-right">{{ $pu ? number_format($sub,2) : '—' }}</td>
            </tr>
          @empty
            <tr><td colspan="5" class="px-3 py-6 text-center text-neutral-500">Sin ítems</td></tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="px-3 py-2 text-right font-medium">Total estimado</td>
            <td class="px-3 py-2 text-right font-semibold">{{ number_format($total,2) }}</td>
          </tr>
        </tfoot>
      </table>
    </div>

    {{-- Comentarios (compacto, opcional) --}}
    @if($pedido->comentarios->count())
      <div class="mt-8">
        <h2 class="font-medium mb-2">Comentarios</h2>
        <div class="space-y-2">
          @foreach($pedido->comentarios as $c)
            <div class="text-sm">
              <span class="text-neutral-500">{{ $c->created_at?->format('d/m H:i') }}</span>
              — <strong>{{ $c->user->name ?? 'Usuario' }}:</strong>
              <span>{{ $c->contenido }}</span>
            </div>
          @endforeach
        </div>
      </div>
    @endif
  </div>

  <script>/* opcional: auto abrir diálogo de impresión
    // window.print();
  */</script>
</body>
</html>
