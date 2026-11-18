<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['pageTitle' => $pageTitle ?? 'Blumies Admin']) ?>
<body class="admin-body">
<?= view('components/header') ?>
<main class="container-fluid p-0">
    <div class="row g-0 admin-shell">
        <?= view('components/admin_sidebar') ?>
        <section class="col admin-content">
