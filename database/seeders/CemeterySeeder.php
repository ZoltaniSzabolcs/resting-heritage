<?php

namespace Database\Seeders;

use App\Models\Cemetery;
use App\Models\Grave;
use App\Models\Person;
use Illuminate\Database\Seeder;

class CemeterySeeder extends Seeder
{

    private function cemeteryhashas(int $cemeteryNr, int $graveNr, int $personNr): void
    {
        Cemetery::factory($cemeteryNr)
            ->has(Grave::factory($graveNr)
                ->has(Person::factory($personNr), 'persons'))
            ->create();
    }

    /**
     * Run the database seeds.
     */
    public
    function run(): void
    {
        $this->cemeteryhashas(10, 12, 1);
        $this->cemeteryhashas(12, 22, 2);
        $this->cemeteryhashas(4, 14, 3);
    }
}
