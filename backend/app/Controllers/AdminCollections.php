<?php
namespace App\Controllers;
class AdminCollections extends BaseController
{
    private function guard() { return session()->get('isLoggedIn') && session()->get('type') === 'admin' ? null : redirect()->to('/')->with('error', 'You do not have access to that page.'); }
    public function index() { if ($r=$this->guard()) return $r; return view('admin/collections', ['pageTitle' => 'Manage Collections']); }
    public function create() { if ($r=$this->guard()) return $r; return view('admin/collection_form', ['pageTitle' => 'Create Collection', 'formTitle' => 'Create collection']); }
    public function store() { if ($r=$this->guard()) return $r; return redirect()->to('/admin/collections')->with('success', 'Collection created.'); }
    public function edit($id) { if ($r=$this->guard()) return $r; return view('admin/collection_form', ['pageTitle' => 'Edit Collection', 'formTitle' => 'Edit collection', 'itemId' => $id]); }
    public function update($id) { if ($r=$this->guard()) return $r; return redirect()->to('/admin/collections')->with('success', 'Collection updated.'); }
    public function delete($id) { if ($r=$this->guard()) return $r; return redirect()->to('/admin/collections')->with('success', 'Collection deleted.'); }
}
