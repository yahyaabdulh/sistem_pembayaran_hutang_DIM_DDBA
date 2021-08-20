<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>
<div class="starter-template text-center py-5 px-3">
    <h1>Hai ! <?= session()->get('name'); ?></h1>
    <p class="lead">Selamat Datang di Sistem Pembayaran Hutang, ini merupakan tugas tambahan Matkul Data and Information Management</p>
</div>
<?= $this->endSection() ?>