<?php
namespace App\Controllers;

use App\Libraries\ProductCatalog;

class AdminCollections extends BaseController
{
    private function guard() { return session()->get('isLoggedIn') && session()->get('type') === 'admin' ? null : redirect()->to('/')->with('error', 'You do not have access to that page.'); }
    public function index()
    {
        if ($r=$this->guard()) return $r;
        $catalog = new ProductCatalog();
        $collections = $catalog->categories(false);
        $products = $catalog->all(false);
        foreach ($collections as &$collection) {
            $collection['product_count'] = count(array_filter($products, static fn(array $product): bool => (int)($product['category_id'] ?? 0) === (int)$collection['id']));
        }
        unset($collection);
        return view('admin/collections', ['pageTitle' => 'Manage Collections', 'collections' => $collections]);
    }
    public function create() { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function store() { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function edit($id) { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function update($id) { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function delete($id) { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }

    private function manageInJotform()
    {
        return redirect()->to('/admin/collections')->with('error', 'Collections are managed as Product List categories in Jotform. Edit them there, then sync the catalog.');
    }
}
