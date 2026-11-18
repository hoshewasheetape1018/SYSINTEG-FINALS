<?php
namespace App\Controllers;

use App\Libraries\JotformCatalogService;
use App\Libraries\ProductCatalog;
use Throwable;

class AdminProducts extends BaseController
{
    private function guard() { return session()->get('isLoggedIn') && session()->get('type') === 'admin' ? null : redirect()->to('/')->with('error', 'You do not have access to that page.'); }
    public function index()
    {
        if ($r=$this->guard()) return $r;
        $products = (new ProductCatalog())->all(false);
        return view('admin/products', [
            'pageTitle' => 'Manage Products',
            'products' => $products,
            'totalProducts' => count($products),
            'activeProducts' => count(array_filter($products, static fn(array $product): bool => !empty($product['active']))),
        ]);
    }
    public function sync()
    {
        if ($r=$this->guard()) return $r;
        try {
            $result = (new JotformCatalogService())->sync();
            return redirect()->to('/admin/products')->with('success', sprintf(
                'Synchronized %d categories and %d products from Jotform.',
                $result['categories'],
                $result['products']
            ));
        } catch (Throwable $exception) {
            log_message('error', 'Jotform catalog sync failed: {message}', ['message' => $exception->getMessage()]);
            return redirect()->to('/admin/products')->with('error', $exception->getMessage());
        }
    }
    public function create() { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function store() { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function edit($id) { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function update($id) { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }
    public function delete($id) { if ($r=$this->guard()) return $r; return $this->manageInJotform(); }

    private function manageInJotform()
    {
        return redirect()->to('/admin/products')->with('error', 'Products are managed in Jotform. Edit the Product List there, then run Sync from Jotform.');
    }
}
