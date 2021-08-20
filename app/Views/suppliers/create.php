<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="starter-template py-5 px-2">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Data Supplier</h3>
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
                    <form method="post" action="<?= base_url('supplier/simpan') ?>">
                        <?= csrf_field(); ?>

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="code">Kode</label>
                                    <input type="text" class="form-control" id="code" name="code" value="<?= old('code'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" name="address" id="address"><?= old('address') ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tlp">Telephone</label>
                                    <input type="text" class="form-control" id="tlp" name="tlp" value="<?= old('tlp'); ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tlp2">Telephone 2</label>
                                    <input type="text" class="form-control" id="tlp2" name="tlp2" value="<?= old('tlp2'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="fax">Fax</label>
                                    <input type="text" class="form-control" id="fax" name="fax" value="<?= old('fax') ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= old('email') ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">Catatan</label>
                            <textarea class="form-control" name="note" id="note"><?= old('note') ?></textarea>
                        </div>

                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active">Aktif</label>
                        </div>
                 

                        <div class="form-group">
                            <input type="submit" value="Simpan" class="btn btn-info" />
                            <a class="btn btn-danger" href="<?= base_url(); ?>/supplier"> Kembali </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>