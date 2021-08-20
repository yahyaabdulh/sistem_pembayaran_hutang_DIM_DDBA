<?= $this->extend('./layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Pengguna</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a class="btn btn-primary" href="<?= base_url(); ?>/pengguna/tambah"> Tambah</a>
    </div>
</div>
<div class="starter-template py-5 px-3">
    <?php if (!empty(session()->getFlashdata('message'))) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <table class="table table-hover table-bordered">
        <thead>
            <tr class="table-primary">
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>No Telp</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $row) {
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $row->username; ?></td>
                    <td><?= $row->name; ?></td>
                    <td><?= $row->tlp; ?></td>
                    <td><?= $row->email; ?></td>
                    <td><?= $row->address; ?></td>
                    <td>
                        <a title="Edit" href="<?= base_url("pengguna/edit/$row->username"); ?>" class="btn btn-info">Edit</a>
                        <a title="Delete" href="<?= base_url("pengguna/hapus/$row->username") ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?= $pager->links('users', 'bootstrap_pagination'); ?>
</div>
<?= $this->endSection() ?>