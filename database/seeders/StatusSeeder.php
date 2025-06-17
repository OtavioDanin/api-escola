<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(['nome' => 'Pendente']);
        Status::create(['nome' => 'Aprovado']);
        Status::create(['nome' => 'Cancelado']);
    }
}
