<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetModel;

class UserPetController extends BaseController
{
    public function __construct()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->send();
        }
    }

    // Show edit form
    public function edit($id)
    {
        $petModel = new PetModel();
        $pet = $petModel->find($id);

        // Use entity property (NOT array)
        if (!$pet || $pet->user_id !== session()->get('user_id')) {
            return redirect()->to('/profile')->with('error', 'Pet not found or not yours.');
        }

        return view('user/edit_pet', ['pet' => $pet]);
    }

    // Update name only
    public function update($id)
    {
        $petModel = new PetModel();
        $pet = $petModel->find($id);

        // Use entity property (NOT array)
        if (!$pet || $pet->user_id !== session()->get('user_id')) {
            return redirect()->to('/profile')->with('error', 'Pet not found or not yours.');
        }

        $newName = trim($this->request->getPost('name'));

        if ($newName === "") {
            return redirect()->back()->with('error', 'Name cannot be empty.');
        }

        $petModel->update($id, [
            'name' => $newName,
        ]);

        return redirect()->to('/profile')->with('success', 'Pet name updated!');
    }

    public function delete($id)
{
    $petModel = new PetModel();
    $pet = $petModel->find($id);

    if (!$pet || $pet->user_id !== session()->get('user_id')) {
        return redirect()->to('/profile')->with('error', 'Pet not found or not yours.');
    }

    // Perform soft delete
    $petModel->delete($id);

    return redirect()->to('/profile')->with('success', 'Pet has been deleted.');
}

}
