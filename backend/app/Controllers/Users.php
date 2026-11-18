<?php
namespace App\Controllers;

use App\Libraries\ProductCatalog;

class Users extends BaseController
{
    public function index()
    {
        $catalog = new ProductCatalog();
        $products = $catalog->all();
        $categories = $catalog->categories();
        $categoryCards = [];

        foreach (array_slice($categories, 0, 3) as $category) {
            $categoryProducts = array_values(array_filter(
                $products,
                static fn (array $product): bool => (int) ($product['category_id'] ?? 0) === (int) $category['id']
            ));
            $category['product_count'] = count($categoryProducts);
            $category['image_url'] = $categoryProducts[0]['image_url'] ?? null;
            $categoryCards[] = $category;
        }

        return view('user/landing_page', [
            'pageTitle' => 'Blumies — Small joys, thoughtfully made',
            'featuredProducts' => array_slice($products, 0, 4),
            'heroProducts' => array_slice(array_values(array_filter($products, static fn (array $product): bool => !empty($product['image_url']))), 0, 3),
            'categoryCards' => $categoryCards,
            'productCount' => count($products),
        ]);
    }
    public function about() { return view('pages/content', ['pageTitle' => 'About Blumies', 'eyebrow' => 'Our story', 'title' => 'Playful things for ordinary days', 'copy' => 'Blumies is a small, joy-led shop built around colorful keepsakes, wearable pieces, and gifts worth holding on to.']); }
    public function contact() { return view('pages/contact', ['pageTitle' => 'Contact Blumies']); }
    public function support() { return view('pages/content', ['pageTitle' => 'Support', 'eyebrow' => 'Need a hand?', 'title' => 'We’re here to help', 'copy' => 'Send us a message about an order, a product, or anything else and our team will get back to you.']); }
    public function terms() { return view('pages/content', ['pageTitle' => 'Terms of Service', 'eyebrow' => 'Legal', 'title' => 'Terms of Service', 'copy' => 'This page is ready for the final terms and conditions.']); }
    public function privacy() { return view('pages/content', ['pageTitle' => 'Privacy Policy', 'eyebrow' => 'Legal', 'title' => 'Privacy Policy', 'copy' => 'This page is ready for the final privacy policy.']); }
}
