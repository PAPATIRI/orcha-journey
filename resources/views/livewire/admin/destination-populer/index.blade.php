<?php

use App\Models\DestinationPopuler;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] #[Title('Admin | destination')]  class extends Component {
    use Toast, WithFileUploads;

    public $showModal = false;
    public $showDeleteModal = false;
    public $isEdit = false;
    public $destinationId = null;

    #[Rule('required|string|max:191')]
    public string $destinationName = '';
    #[Rule('nullable|image|max:2048')]
    public $destinationPhoto;
    #[Rule('required')]
    public $totalVisitor = 0;

    public $existingPhoto = null;

    public function openModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
        $this->isEdit = false;
    }
    public function edit(DestinationPopuler $destination): void
    {
        $this->resetForm();
        $this->isEdit = true;
        $this->destinationName = $destination->destination_name;
        $this->totalVisitor = $destination->total_visitor;
        $this->existingPhoto = $destination->foto;
        $this->destinationId = $destination->id;
        $this->showModal = true;
    }
    public function openDeleteModal(DestinationPopuler $destination): void
    {
        $this->resetForm();
        $this->showDeleteModal = true;
        $this->destinationName = $destination->destination_name;
        $this->destinationId = $destination->id;
    }
    public function closeModal(): void
    {
        $this->resetForm();
        $this->showModal = false;
        $this->showDeleteModal = false;
    }
    public function resetForm()
    {
        $this->destinationName = '';
        $this->destinationPhoto = null;
        $this->totalVisitor = 0;
        $this->existingPhoto = null;
        $this->destinationId = null;
    }

    public function delete(DestinationPopuler $destination): void
    {
        try {
            if ($destination->foto) {
                $path = str_replace('/storage/', '', $destination->foto);
                Storage::disk('public')->delete($path);
            }
            $destination->delete();
            $this->warning("$destination->destination_name berhasil dihapus", position: 'toast-bottom');
            $this->closeModal();
        } catch (Exception $e) {
            dump($e->getMessage());
            $this->error('gagal menghapus data destinasi populer');
        }
    }
    public function save(): void
    {
        $this->validate();
        try {
            if ($this->isEdit) {
                $destinationData = DestinationPopuler::findOrFail($this->destinationId);
                if ($this->destinationPhoto) {
                    if ($destinationData->foto) {
                        $oldPath = str_replace('/storage/', '', $destinationData->foto);
                        Storage::disk('public')->delete($oldPath);
                    }
                    $url = $this->destinationPhoto->store('destinasi_populer', 'public');
                    $this->destinationPhoto = "/storage/$url";
                }
                $destinationData->update([
                    'destination_name' => $this->destinationName,
                    'total_visitor' => $this->totalVisitor,
                    'foto' => $this->destinationPhoto,
                ]);
                $this->success('berhasil edit data destinasi');
                $this->closeModal();
            } else {
                if ($this->destinationPhoto) {
                    $url = $this->destinationPhoto->store('destinasi_populer', 'public');
                    $this->destinationPhoto = "/storage/$url";
                }
                DestinationPopuler::create([
                    'destination_name' => $this->destinationName,
                    'total_visitor' => $this->totalVisitor,
                    'foto' => $this->destinationPhoto
                ]);
                $this->success('berhasil tambah destinasi');
                $this->closeModal();
            }
        } catch (Exception $e) {
            dump($e->getMessage());
            $this->error('gagal menambah destinasi');
        }
    }

    public function headers(): array
    {
        return [
            ['key' => 'destination_name', 'label' => 'Nama Tempat', 'class' => 'w-1'],
            ['key' => 'total_visitor', 'label' => 'Total Pengunjung', 'class' => 'w-1'],
            ['key' => 'foto', 'label' => 'Foto', 'class' => 'w-1'],
        ];
    }

    public function with(): array
    {
        return [
            'destinations' => DestinationPopuler::all(),
            'headers' => $this->headers()
        ];
    }
}; ?>

<div class="mt-10">
    <x-mary-header title="Destinasi Populer" no-separator progress-indicator>
        <x-slot:actions>
            <x-mary-button spinner="openModal" label="Tambah Destinasi" wire:click="openModal" responsive icon="o-plus"
                class="btn-primary"></x-button>
        </x-slot:actions>
    </x-mary-header>
    <x-mary-card shadow>
        <x-mary-table :headers="$headers" :rows="$destinations">
            @scope('cell_foto', $destination)
            @if($destination->foto)
            <x-mary-avatar image="{{ $destination->foto }}" />
            @else
            <x-heroicon-o-user-circle class="text-slate-700 h-7 w-7" />
            @endif
            @endscope

            @scope('actions', $destination)
            <x-mary-button icon="o-pencil-square" wire:click="edit({{ $destination['id'] }})" spinner="edit({{$destination['id']}})"
                class="btn-ghost btn-sm text-slate-700" />
            <x-mary-button icon="o-trash" wire:click="openDeleteModal({{ $destination['id'] }})" spinner="openDeleteModal({{$destination->id}})"
                class="btn-ghost btn-sm text-error" />
            @endscope

            <x-slot:empty>
                <div class="text-center">
                    <x-mary-icon name="o-archive-box-x-mark" />
                    <p>data destinasi populer kosong</p>
                </div>
            </x-slot:empty>
        </x-mary-table>
    </x-mary-card>
    <!-- modal -->
    <x-mary-modal wire:model="showModal" title="{{ $isEdit ? 'Edit Data' : 'Tambah Data' }}">
        <x-mary-form no-separator wire:submit="save">
            <x-mary-input label="Name" wire:model="destinationName" placeholder="nama tempat destinasi" />
            <x-mary-input label="Total Pengunjung" wire:model="totalVisitor" placeholder="0" />
            <x-mary-file label="Logo Partner" wire:model="destinationPhoto" accept="image/png, image/jpg, image/jpeg">
            </x-mary-file>
            @if ($destinationPhoto instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
            {{-- Preview file yang baru diupload --}}
            <img class="h-36 rounded-lg shadow-sm" src="{{ $destinationPhoto->temporaryUrl() }}" alt="">
            @elseif ($destinationPhoto)
            {{-- Preview file lama dari database --}}
            <img class="h-36 rounded-lg shadow-sm" src="{{ asset($destinationPhoto) }}" alt="">
            @elseif ($existingPhoto)
            <img class="h-36 rounded-lg shadow-sm" src="{{ $existingPhoto }}" alt="">
            @else
            <x-heroicon-o-user-circle class="text-slate-700 h-24 w-24" />
            @endif

            <x-slot:actions>
                <x-mary-button label="Batal" @click="$wire.closeModal()" spinner="closeModal" />
                <x-mary-button label="{{ $isEdit ? 'Simpan Perubahan' : 'Simpan Data' }}" type="submit"
                    class="btn-primary" spinner="save" />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

    <!-- modal confirm delete -->
    <x-mary-modal wire:model='showDeleteModal' title="Hapus Data">
        <p>yakin ingin menghapus data destinasi <strong>{{ $destinationName }}</strong></p>

        <x-slot:actions>
            <x-mary-button label="Batal" @click="$wire.closeModal()" spinner="closeModal" />
            <x-mary-button label="Ya Hapus" wire:click="delete({{$destinationId}})" class="btn-primary"
                spinner="delete({{$destinationId}})" />
        </x-slot:actions>
    </x-mary-modal>
</div>