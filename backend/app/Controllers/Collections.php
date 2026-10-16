<?php
namespace App\Controllers;
class Collections extends BaseController
{
    public function index() { return view('shop/collections', ['pageTitle' => 'Collections']); }
    public function show($id) { return view('shop/products', ['pageTitle' => 'Collection ' . $id, 'collectionTitle' => 'Collection ' . $id]); }
}
