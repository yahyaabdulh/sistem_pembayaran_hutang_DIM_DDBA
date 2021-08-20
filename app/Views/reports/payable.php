<?= $this->extend('./layout/template') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Laporan Pembayaran Hutang</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    </div>
</div>

<div class="starter-template py-2 px-2">
    <form method="GET" action="<?= base_url('laporan_hutang/export') ?>">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="col-8">
                <?php if (!empty(session()->getFlashdata('message'))) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('message'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h3>Filter Export</h3>
                    </div>
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h4>Periksa Entrian Form</h4>
                                </hr />
                                <?php echo session()->getFlashdata('error'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="date">Tanggal</label>
                                    <div class="input-group mb-2">
                                        <input name="date_1" id="date_1" class="form-control datepicker" type="text" value="<?= old('date_1'); ?>">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">s/d</div>
                                        </div>
                                        <input name="date_2" id="date_2" class="form-control datepicker" type="text" value="<?= old('date_2'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="supplier">Supplier</label>
                                    <select name="supplier_id" id="supplier_id" class="form-control" value="<?= old('supplier_id'); ?>">
                                        <option value="">-- Pilih Supplier --</option>
                                        <?php
                                        foreach ($suppliers as $key) {
                                            echo '<option value="' . $key->id . '">' . $key->name . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Export Excel" class="btn btn-info" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>