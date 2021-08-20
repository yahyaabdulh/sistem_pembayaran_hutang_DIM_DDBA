<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="starter-template py-5 px-2">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h3>Update Data Pengguna</h3>
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
                    <form method="post" action="<?= base_url('pengguna/update/' . $users->username) ?>">
                        <?= csrf_field(); ?>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" disabled name="username" value="<?= $users->username; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="<?= old('password'); ?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="password_conf">Confirm Password</label>
                            <input type="password" class="form-control" id="password_conf" name="password_conf" value="<?= old('password_conf'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=  $users->name; ?>">
                        </div>

                        <div class="form-group">
                            <label for="tlp">No Telp</label>
                            <input type="text" class="form-control" id="tlp" name="tlp" value="<?=  $users->tlp; ?>" />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?=  $users->email; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea class="form-control" name="address" id="address"><?= $users->address; ?></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Update" class="btn btn-info" />
                            <a class="btn btn-danger" href="<?= base_url(); ?>/pengguna"> Kembali </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content'); ?>