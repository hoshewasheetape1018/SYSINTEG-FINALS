<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PetsSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // Define species base stats
        $speciesStats = [
            'bunny' => ['base_affection' => 80, 'base_energy' => 60, 'base_maintenance' => 40],
            'goat'  => ['base_affection' => 50, 'base_energy' => 40, 'base_maintenance' => 80],
            'fish'  => ['base_affection' => 70, 'base_energy' => 90, 'base_maintenance' => 50],
        ];

        // Define pets using the species reference above
        $pets = [
            ['user_id' => 1, 'name' => 'Hikari', 'species' => 'bunny', 'image' => 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab1.png'],
            ['user_id' => 1, 'name' => 'Luna',  'species' => 'goat',  'image' => 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab2.png'],
            ['user_id' => 1, 'name' => 'Aqua',  'species' => 'fish',  'image' => 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab3.png'],
        ];

        // Merge stats automatically per species
        foreach ($pets as &$pet) {
            $stats = $speciesStats[$pet['species']];
            $pet = array_merge($pet, $stats, [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->db->table('pets')->insertBatch($pets);
    }
}
