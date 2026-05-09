<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Traits\HasAlerts;
use Illuminate\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Artisan;
use App\Models\Comic;
use Database\Seeders\SuskeEnWiskeSeeder;

class SeedSuskeEnWiske extends Component
{
    use HasAlerts;

    public bool $loading = false;

    public function seed(): void
    {
        $this->loading = true;

        $comicExisting = Comic::query()
            ->where('name', 'Suske en Wiske')
            ->exists();

        if ($comicExisting) {
            $this->loading = false;

            $this->alert(
                message: 'Data already present',
                type: 'info',
            );

            return;
        }

        Artisan::call('db:seed', [
            '--class' => SuskeEnWiskeSeeder::class,
            '--force' => true,
        ]);

        $this->loading = false;

        $this->alert(message: 'Data seeded');
    }

    public function render(): View
    {
        return view('livewire.seed-suske-en-wiske');
    }
}
