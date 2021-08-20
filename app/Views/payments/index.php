<?= $this->extend('./layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Pembayaran Hutang</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a class="btn btn-primary" href="<?= base_url(); ?>/pembayaran/tambah"> Tambah</a>
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
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($payments as $row) {
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $row->code; ?></td>
                    <td><?= date("d-m-Y", strtotime($row->date)); ?></td>
                    <td><?= $row->supplier_name; ?></td>
                    <td><?= ($row->status === '1') ? 'Pembayaran' : '' ?></td>
                    <td><?= number_format($row->paid_amount, 2); ?></td>
                    <td>
                        <a title="Delete" href="<?= base_url("pembayaran/hapus/$row->id") ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?= $pager->links('payments', 'bootstrap_pagination'); ?>
</div>
<?= $this->endSection() ?>