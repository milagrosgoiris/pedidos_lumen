<?php

namespace App\Livewire\Locales;

use App\Models\Local;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Locales')]
class Index extends Component
{
    use WithPagination;

    public string $q = '';

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function toggleActivo(int $id): void
    {
        if ($local = Local::find($id)) {
            $local->update(['activo' => ! (bool) $local->activo]);
        }
    }

    public function delete(int $id): void
    {
        if ($local = Local::find($id)) {
            $local->delete(); // si usás SoftDeletes y querés borrar definitivo: forceDelete()
            session()->flash('ok', 'Local eliminado.');
        }
    }

    public function render()
    {
        $rows = Local::query()
            ->when($this->q !== '', function ($query) {
                $query->where(function ($qq) {
                    $qq->where('nombre', 'like', "%{$this->q}%")
                       ->orWhere('direccion', 'like', "%{$this->q}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(10);

        return view('livewire.locales.index', compact('rows'));
    }
}
