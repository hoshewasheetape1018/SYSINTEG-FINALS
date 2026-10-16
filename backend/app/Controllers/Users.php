<?php
namespace App\Controllers;
class Users extends BaseController
{
    public function index() { return view('user/landing_page', ['pageTitle' => 'Blumies — Small joys, thoughtfully made']); }
    public function about() { return view('pages/content', ['pageTitle' => 'About Blumies', 'eyebrow' => 'Our story', 'title' => 'Playful things for ordinary days', 'copy' => 'Blumies is a small, joy-led shop built around colorful keepsakes, wearable pieces, and gifts worth holding on to.']); }
    public function contact() { return view('pages/contact', ['pageTitle' => 'Contact Blumies']); }
    public function support() { return view('pages/content', ['pageTitle' => 'Support', 'eyebrow' => 'Need a hand?', 'title' => 'We’re here to help', 'copy' => 'Send us a message about an order, a product, or anything else and our team will get back to you.']); }
    public function terms() { return view('pages/content', ['pageTitle' => 'Terms of Service', 'eyebrow' => 'Legal', 'title' => 'Terms of Service', 'copy' => 'This page is ready for the final terms and conditions.']); }
    public function privacy() { return view('pages/content', ['pageTitle' => 'Privacy Policy', 'eyebrow' => 'Legal', 'title' => 'Privacy Policy', 'copy' => 'This page is ready for the final privacy policy.']); }
}
