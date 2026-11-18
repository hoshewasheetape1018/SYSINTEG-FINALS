<?php
namespace App\Controllers;
use App\Libraries\ProductCatalog;
class Collections extends BaseController
{
    public function index()
    {
        return view('shop/collections', [
            'pageTitle' => 'Collections',
            'collections' => (new ProductCatalog())->categories(),
        ]);
    }

    public function show($id)
    {
        $catalog = new ProductCatalog();
        $category = null;
        foreach ($catalog->categories() as $candidate) {
            if ((int) $candidate['id'] === (int) $id) $category = $candidate;
        }
        if (!$category) return redirect()->to('/collections')->with('error', 'Collection not found.');

        return view('shop/products', [
            'pageTitle' => $category['name'],
            'collectionTitle' => $category['name'],
            'products' => $catalog->byCategory((int) $id),
        ]);
    }
}
