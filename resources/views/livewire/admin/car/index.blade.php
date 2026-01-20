<?php

use App\Models\Car;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] #[Title('Admin | Mobil')] class extends Component
{
    use Toast, WithFileUploads, WithPagination;

    public $search = '';

    public $sortBy = ['column' => 'created_at', 'direction' => 'desc'];

    public $showModal = false;

    public $showDeleteModal = false;

    public $isEdit = false;

    public $carId = null;

    // Property Data Mobil
    #[Rule('required|string|max:100')]
    public string $name = '';

    #[Rule('required|string|max:50')]
    public string $brand = '';

    #[Rule('nullable|string|max:20')]
    public string $nopol = '';

    #[Rule('required|numeric|min:0')]
    public $price_per_day;

    #[Rule('required|in:Manual,Matic')]
    public string $transmission = 'Manual';

    #[Rule('required|numeric|min:1')]
    public int $capacity = 4;

    #[Rule('boolean')]
    public bool $isAvailable = true;

    #[Rule('nullable|image|max:2048')] // Max 2MB
    public $photo;

    public $existingPhoto = null;

    // Opsi untuk Dropdown Transmisi
    public function getTransmissionOptions()
    {
        return [
            ['id' => 'Manual', 'name' => 'Manual'],
            ['id' => 'Matic', 'name' => 'Matic'],
        ];
    }

    // --- Method CRUD ---

    public function save(): void
    {
        $this->validate();

        try {
            if ($this->isEdit) {
                $car = Car::findOrFail($this->carId);

                // Handle Upload Gambar
                if ($this->photo) {
                    if ($car->image) {
                        $oldPath = str_replace('/storage/', '', $car->image);
                        Storage::disk('public')->delete($oldPath);
                    }
                    $url = $this->photo->store('cars', 'public');
                    $this->photo = "/storage/$url";
                } else {
                    // Jika tidak upload baru, pakai yang lama untuk disimpan di variabel (agar tidak null saat update)
                    $this->photo = $car->image;
                }

                $car->update([
                    'name' => $this->name,
                    'brand' => $this->brand,
                    'nopol' => $this->nopol,
                    'price_per_day' => $this->price_per_day,
                    'transmission' => $this->transmission,
                    'capacity' => $this->capacity,
                    'is_available' => $this->isAvailable,
                    'image' => $this->photo,
                ]);

                $this->success('Berhasil update data mobil');
            } else {
                $imageUrl = null;
                if ($this->photo) {
                    $url = $this->photo->store('cars', 'public');
                    $imageUrl = "/storage/$url";
                }

                Car::create([
                    'name' => $this->name,
                    'brand' => $this->brand,
                    'nopol' => $this->nopol,
                    'price_per_day' => $this->price_per_day,
                    'transmission' => $this->transmission,
                    'capacity' => $this->capacity,
                    'is_available' => $this->isAvailable,
                    'image' => $imageUrl,
                ]);

                $this->success('Berhasil tambah mobil baru');
            }

            $this->closeModal();
        } catch (\Exception $e) {
            // dump($e->getMessage()); // Uncomment untuk debugging
            $this->error('Terjadi kesalahan saat menyimpan data');
        }
    }

    public function edit(Car $car): void
    {
        $this->resetForm();
        $this->isEdit = true;
        $this->carId = $car->id;

        $this->name = $car->name;
        $this->brand = $car->brand;
        $this->nopol = $car->nopol ?? '';
        $this->price_per_day = $car->price_per_day;
        $this->transmission = $car->transmission;
        $this->capacity = $car->capacity;
        $this->isAvailable = $car->is_available;
        $this->existingPhoto = $car->image;

        $this->showModal = true;
    }

    public function delete(Car $car): void
    {
        try {
            if ($car->image) {
                $path = str_replace('/storage/', '', $car->image);
                Storage::disk('public')->delete($path);
            }
            $car->delete();
            $this->warning("Data $car->name berhasil dihapus", position: 'toast-bottom');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->error('Gagal menghapus data');
        }
    }

    // --- Helper Methods ---

    public function openModal()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function openDeleteModal(Car $car)
    {
        $this->showDeleteModal = true;
        $this->name = $car->name; // Untuk tampilan konfirmasi
        $this->carId = $car->id;
    }

    public function closeModal(): void
    {
        $this->resetForm();
        $this->showModal = false;
        $this->showDeleteModal = false;
    }

    public function resetForm()
    {
        $this->reset(['name', 'brand', 'nopol', 'price_per_day', 'transmission', 'capacity', 'photo', 'existingPhoto', 'carId', 'isEdit']);
        $this->isAvailable = true; // Default available
    }

    public function headers(): array
    {
        return [
            ['key' => 'image', 'label' => 'Foto', 'class' => 'w-1', 'sortable' => false],
            ['key' => 'name', 'label' => 'Nama Mobil', 'sortable' => true],
            ['key' => 'brand', 'label' => 'Merk', 'sortable' => true],
            ['key' => 'price_per_day', 'label' => 'Harga/Hari', 'sortable' => true],
            ['key' => 'transmission', 'label' => 'Transmisi'],
            ['key' => 'is_available', 'label' => 'Status', 'class' => 'text-center'],
        ];
    }

    public function cars()
    {
        return Car::query()
            ->latest()
            ->when($this->search, function (Builder $query) {
                $query->where('name', 'like', "%$this->search%")
                    ->orWhere('brand', 'like', "%$this->search%");
            })
            ->orderBy(...array_values($this->sortBy))
            ->paginate(5);
    }

    public function with(): array
    {
        return [
            'cars' => $this->cars(),
            'headers' => $this->headers(),
            'transmissions' => $this->getTransmissionOptions(),
        ];
    }
}; ?>

<div class="mt-10">
    <x-mary-header title="Data Mobil Disewakan" no-separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-mary-input placeholder="Cari mobil atau merk..." wire:model.live.debounce="search" clearable
                icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button spinner="openModal" label="Tambah Mobil" wire:click="openModal" responsive icon="o-plus"
                class="btn-primary"></x-mary-button>
        </x-slot:actions>
    </x-mary-header>

    <x-mary-card shadow>
        <x-mary-table :headers="$headers" :rows="$cars" :sort-by="$sortBy" with-pagination>

            {{-- Custom Column: Foto --}}
            @scope('cell_image', $car)
            @if($car->image)
            <div class="avatar">
                <div class="w-16 rounded">
                    <img src="{{ $car->image }}" alt="{{ $car->name }}" />
                </div>
            </div>
            @else
            <x-heroicon-o-photo class="text-slate-400 h-10 w-10" />
            @endif
            @endscope

            {{-- Custom Column: Nama Mobil (Gabung dengan Nopol kecil dibawahnya) --}}
            @scope('cell_name', $car)
            <div class="font-bold">{{ $car->name }}</div>
            <div class="text-xs text-gray-500">{{ $car->nopol ?? '-' }}</div>
            @endscope

            {{-- Custom Column: Harga (Format Rupiah) --}}
            @scope('cell_price_per_day', $car)
            Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
            @endscope

            {{-- Custom Column: Status --}}
            @scope('cell_is_available', $car)
            @if($car->is_available)
            <x-mary-badge value="Tersedia" class="badge-success" />
            @else
            <x-mary-badge value="Disewa / NA" class="badge-error" />
            @endif
            @endscope

            {{-- Actions --}}
            @scope('actions', $car)
            <x-mary-button icon="o-pencil-square" wire:click="edit({{ $car->id }})" spinner="edit({{ $car->id }})"
                class="btn-ghost btn-sm text-slate-700" />
            <x-mary-button icon="o-trash" wire:click="openDeleteModal({{ $car->id }})" spinner="openDeleteModal({{ $car->id }})"
                class="btn-ghost btn-sm text-error" />
            @endscope

            <x-slot:empty>
                <div class="text-center py-10">
                    <x-mary-icon name="o-truck" class="w-12 h-12 text-gray-400 opacity-50" />
                    <p class="text-gray-500 mt-2">Belum ada data mobil.</p>
                </div>
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>

    <x-mary-modal wire:model='showDeleteModal' title="Hapus Data">
        <p>Yakin ingin menghapus mobil <strong>{{ $name }}</strong>?</p>
        <x-slot:actions>
            <x-mary-button label="Batal" @click="$wire.closeModal()" spinner="closeModal" />
            <x-mary-button label="Ya Hapus" wire:click="delete({{$carId}})" class="btn-error"
                spinner="delete({{$carId}})" />
        </x-slot:actions>
    </x-mary-modal>

    <x-mary-modal wire:model="showModal" title="{{ $isEdit ? 'Edit Mobil' : 'Tambah Mobil Baru' }}" separator>
        <x-mary-form wire:submit="save">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-mary-input label="Nama Mobil" wire:model="name" placeholder="Contoh: Avanza Veloz" />
                <x-mary-input label="Merk (Brand)" wire:model="brand" placeholder="Contoh: Toyota" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-mary-select label="Transmisi" wire:model="transmission" :options="$transmissions" />
                <x-mary-input label="Kapasitas (Orang)" wire:model="capacity" type="number" suffix="Orang" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-mary-input label="Harga Sewa / Hari" wire:model="price_per_day" type="number" prefix="Rp" />
                <x-mary-input label="Plat Nomor (Opsional)" wire:model="nopol" placeholder="KB 1234 AB" />
            </div>

            <x-mary-toggle label="Status Tersedia" wire:model="isAvailable" hint="Matikan jika mobil sedang disewa" class="toggle-primary" />

            <x-mary-file label="Foto Mobil" wire:model="photo" accept="image/png, image/jpg, image/jpeg">
            </x-mary-file>
            @if ($photo instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            <img class="h-40 w-full rounded-lg shadow-sm object-cover" src="{{ $photo->temporaryUrl() }}" alt="Preview">
            @elseif($photo)
            <img src="{{asset($photo)}}" class="h-40 w-full rounded-lg shadow-sm" alt="foto mobil">
            @elseif($existingPhoto)
            <img class="h-40 w-full rounded-lg shadow-sm object-cover" src="{{$existingPhoto}}" alt="Existing">
            @else
            <div class="h-40 w-full bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                <span class="text-gray-400 text-sm">Preview Gambar</span>
            </div>
            @endif

            <x-slot:actions>
                <x-mary-button label="Batal" @click="$wire.closeModal()" spinner="closeModal" />
                <x-mary-button label="{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}" type="submit"
                    class="btn-primary" spinner="save" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>