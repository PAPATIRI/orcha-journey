<?php

use App\Models\TravelPackage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;
use Mary\Traits\Toast;

new #[Layout('components.layouts.admin')] #[Title('Admin | Create Bundling')]  class extends Component {
    use Toast;

    #[Rule('required|string|max:255')]
    public $name;
    #[Rule('required|numeric')]
    public $price;
    #[Rule('required|numeric')]
    public $originalPrice;
    #[Rule('required|numeric')]
    public $discountPercentage;
    #[Rule('required|boolean')]
    public $isBestChoice = false;
    #[Rule('required|array')]
    public $destinationList = [];

    public function save()
    {
        $this->validate();
        try {
            TravelPackage::create([
                'name' => $this->name,
                'price' => $this->price,
                'original_price' => $this->originalPrice,
                'discount_percentage' => $this->discountPercentage,
                'is_best_choice' => $this->isBestChoice,
                'destination_list' => $this->destinationList
            ]);
            $this->success('berhasil menambah data bundling harga', redirectTo: '/admin/travel-package');
        } catch (Exception $e) {
            $this->error('gagal menambah data bundling harga');
        }
    }
}; ?>

<div class="mt-10">
    <x-mary-header title="Tambah Bundling Harga" no-separator progress-indicator>
        <x-slot:actions>
            <x-mary-button label="Kembali" link="/admin/travel-package" responsive icon="o-arrow-left" class="btn-sm btn-soft btn-primary"></x-button>
        </x-slot:actions>
    </x-mary-header>
    <div class="grid gap-5 lg:grid-cols-2">
        <div>
            <x-mary-form wire:submit="save" no-separator>
                <x-mary-input label="Nama" wire:model="name" />
                <x-mary-input label="Harga" wire:model="price" prefix="Rp" locale="id-ID" money />
                <x-mary-input label="Harga Asli" wire:model="originalPrice" prefix="Rp" locale="id-ID" money />
                <x-mary-input label="Persentase Diskon" wire:model="discountPercentage" />
                <x-mary-tags label="Daftar Destinasi" wire:model="destinationList" hint="tekan enter" clearable />
                <x-mary-toggle label="Best Choice Bundling" wire:model="isBestChoice" />

                <x-slot:actions no-separator>
                    <x-mary-button label="Tambah Data" type="submit" spinner="save" class="btn-primary" />
                </x-slot:actions>
            </x-mary-form>
        </div>
        <div></div>
    </div>
</div>