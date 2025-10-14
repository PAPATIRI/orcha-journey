<?php

use App\Models\Testimoni;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

new
    #[Layout('components.layouts.admin')]
    #[Title('Admin | Testimoni')]
    class extends Component {
        use WithPagination, Toast;
        public $search = '';
        public array $sortBy = ['column' => 'customer_name', 'direction' => 'asc'];

        public function headers(): array
        {
            return [
                ['key' => 'avatar', 'label' => 'avatar', 'class' => 'w-1', 'sortable' => false],
                ['key' => 'rating', 'label' => 'rating', 'class' => 'w-1', 'sortable' => false],
                ['key' => 'customer_name', 'label' => 'Nama Pelanggan', 'class' => 'w-1'],
                ['key' => 'testimonial', 'label' => 'Testimoni', 'class' => 'w-1', 'sortable' => false],
            ];
        }

        public function delete(Testimoni $testimoni): void
        {
            if ($testimoni->avatar) {
                $path = str_replace('/storage/', '', $testimoni->avatar);
                Storage::disk('public')->delete($path);
            }
            $testimoni->delete();

            $this->warning("$testimoni->customer_name berhasil dihapus", position: 'toast-bottom');
        }

        public function testimonials(): LengthAwarePaginator
        {
            return Testimoni::query()
                ->when($this->search, fn(Builder $query) => $query->where('customer_name', 'like', "%$this->search%"))
                ->orderBy(...array_values($this->sortBy))
                ->paginate(5);
        }

        public function with(): array
        {
            return [
                'testimonials' => $this->testimonials(),
                'headers' => $this->headers()
            ];
        }
    }; ?>

<div class="mt-10">
    <x-mary-header title="Testimoni Pelanggan" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input placeholder="cari nama customer..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button label="Tambah Testimoni" link="/admin/testimoni/create" responsive icon="o-plus" class="btn-primary"></x-button>
        </x-slot:actions>
    </x-mary-header>

    <x-mary-card shadowd>
        <x-mary-table :headers="$headers" :rows="$testimonials" :sort-by="$sortBy" with-pagination link="/admin/testimoni/{id}/edit">
            @scope('cell_avatar', $testimonial)
            <x-mary-avatar image="{{$testimonial->avatar ?? '/orca-logo.jpg'  }}" />
            @endscope

            @scope('actions', $testimonial)
            <x-mary-button icon="o-trash" wire:click="delete({{$testimonial['id']}})" wire:confirm="are you sure?" spinner class="btn-ghost btn-sm text-error" />
            @endscope
            <x-slot:empty>
                <div class="text-center">
                    <x-mary-icon name="o-archive-box-x-mark" />
                    <p>data testimoni kosong</p>
                </div>
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>
</div>