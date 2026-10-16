<?php
namespace App\Controllers;
class AdminProducts extends BaseController
{
    private function guard() { return session()->get('isLoggedIn') && session()->get('type') === 'admin' ? null : redirect()->to('/')->with('error', 'You do not have access to that page.'); }
    public function index() { if ($r=$this->guard()) return $r; return view('admin/products', ['pageTitle' => 'Manage Products']); }
    public function create() { if ($r=$this->guard()) return $r; return view('admin/product_form', ['pageTitle' => 'Create Product', 'formTitle' => 'Create product']); }
    public function store() { if ($r=$this->guard()) return $r; return redirect()->to('/admin/products')->with('success', 'Product created.'); }
    public function edit($id) { if ($r=$this->guard()) return $r; return view('admin/product_form', ['pageTitle' => 'Edit Product', 'formTitle' => 'Edit product', 'itemId' => $id]); }
    public function update($id) { if ($r=$this->guard()) return $r; return redirect()->to('/admin/products')->with('success', 'Product updated.'); }
    public function delete($id) { if ($r=$this->guard()) return $r; return redirect()->to('/admin/products')->with('success', 'Product deleted.'); }
}
