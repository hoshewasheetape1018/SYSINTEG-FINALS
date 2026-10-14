<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetModel;

class Adopt extends BaseController
{
    public function index()
    {
        $session = session();
        $userId = $session->get('user_id'); // already set at login

        if (!$userId) {
            // redirect to login if not logged in
            $session->setFlashdata('error', 'You must be logged in to adopt a pet.');
            return redirect()->to('/login');
        }

        return view('user/adopt_form');
    }

    /**
     * Handles the adopt POST request
     */
    public function adoptRequest()
    {
        $session = session();
        $request = service('request');
        $petModel = new PetModel();

        // get current user id directly from session
        $userId = $session->get('user_id');
        if (!$userId) {
            $session->setFlashdata('error', 'You must be logged in to adopt a pet.');
            return redirect()->to('/login');
        }

        $species = $request->getPost('species');
        $name = $request->getPost('name');

        // check current pets
        $petCount = $petModel->where('user_id', $userId)->countAllResults();
        if ($petCount >= 3) {
            $session->setFlashdata('error', 'You already have 3 pets!');
            return redirect()->to('/adopt');
        }

        // species-based defaults
        $speciesStats = [
            'bunny' => [
                'image' => 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab1.png',
                'base_affection' => 90,
                'base_energy' => 70,
                'base_maintenance' => 30,
            ],
            'goat' => [
                'image' => 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab2.png',
                'base_affection' => 40,
                'base_energy' => 30,
                'base_maintenance' => 90,
            ],
            'fish' => [
                'image' => 'https://file.garden/ZrIPgCGn9kADc89z/Genopals/ab3.png',
                'base_affection' => 70,
                'base_energy' => 95,
                'base_maintenance' => 50,
            ],
        ];

        if (!array_key_exists($species, $speciesStats)) {
            $session->setFlashdata('error', 'Invalid species type.');
            return redirect()->to('/adopt');
        }

        // insert new pet
        $data = array_merge(
            ['user_id' => $userId, 'name' => $name, 'species' => $species],
            $speciesStats[$species]
        );

        $petModel->insert($data);

        $session->setFlashdata('success', 'Pet adopted successfully!');
        return redirect()->to('/profile'); // redirect to profile to see new pet
    }
}
