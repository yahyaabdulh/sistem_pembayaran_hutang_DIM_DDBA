<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="starter-template py-5 px-2">
    <form method="post" action="<?= base_url('pembelian/simpan') ?>">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Pembelian Hutang</h3>
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
                                    <label for="code">Kode</label>
                                    <input type="text" class="form-control" id="code" name="code" value="<?= old('code'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="date">Tanggal</label>
                                    <input name="date" id="date" class="form-control datepicker" type="text" value="<?= old('date'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-10">
                                <div class="form-group">
                                    <label for="supplier">Supplier</label>
                                    <select name="supplier_id" id="role_id" class="form-control">
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

                        <div class="form-group">
                            <label for="note">Catatan</label>
                            <textarea class="form-control" name="note" id="note"><?= old('note') ?></textarea>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Detail Item</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <th width="30%">Item</th>
                                        <th width="7%">Qty</th>
                                        <th width="20%">Harga</th>
                                        <th width="20%">Diskon</th>
                                        <th width="20%">Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr id="row-0" class="dynamic-added">
                                        <td><input type="text" name="item_name[]" class="form-control name_list" required="" /></td>
                                        <td><input type="number" name="qty[]" onkeyup="Htg(0)" class="form-control qty" id="qty-0" required="" value="0" /></td>
                                        <td><input type="number" name="price[]" onkeyup="Htg(0)" class="form-control price" id="price-0" required="" value="0" /></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-4">
                                                    <input type="number" name="disc_percent_d[]" onkeyup="Disc(0, 0)" class="form-control disc_p" id="disc_p-0" required="" value="0" />
                                                </div>
                                                <div class="col-8">
                                                    <input type="number" name="disc_amount_d[]" onkeyup="Disc(0, 1)" class="form-control disc_t" id="disc_t-0" required="" value="0" />
                                                </div>
                                            </div>
                                        </td>
                                        <td><input type="number" name="total_price[]" readonly onchange="Sum()" class="form-control total_price" id="total_price-0" required="" value="0" /></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <table width="100%" id="total">
                                    <tr height="50px;">
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Item</button></td>
                                        <td width="50%" style="text-align: right;"><b>Sub Total :</b> &nbsp;</td>
                                        <td width="25%"><input type="number" name="sub_total" readonly class="form-control" id="sub_total" required="" value="0" /></td>
                                    </tr>
                                    <tr height="50px;">
                                        <td colspan="2" width="75%" style="text-align: right;"><b>Diskon : </b> &nbsp;</td>
                                        <td>
                                            <input type="number" name="disc_amount" readonly class="form-control" id="disc_amount" required="" value="0" />
                                            <input type="hidden" name="disc_percent" class="form-control" id="disc_percent" required="" value="0" />
                                        </td>
                                    </tr>
                                    <tr height="50px;">
                                        <td colspan="2" width="75%" style="text-align: right;"><b>Grand Total :</b> &nbsp;</td>
                                        <td><input type="number" name="grand_total" readonly class="form-control" id="grand_total" required="" value="0" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="form-group card-footer">
                            <input type="submit" value="Simpan" class="btn btn-info" />
                            <a class="btn btn-danger" href="<?= base_url(); ?>/pembelian"> Kembali </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function Htg(id) {
        var qty = $('#qty-' + id).val();
        var price = $('#price-' + id).val();
        var disc_p = $('#disc_p-' + id).val();
        var disc_t = $('#disc_t-' + id).val();
        var total_price = (parseFloat(qty) * parseFloat(price)) - parseFloat(disc_t);
        $('#total_price-' + id).val(total_price).trigger('change');
    }

    function Disc(id, i) {
        var qty = $('#qty-' + id).val();
        var price = $('#price-' + id).val();
        var sub_t = parseFloat(qty) * parseFloat(price);
        if (i) {
            var disc_t = parseFloat($('#disc_t-' + id).val());
            $('#disc_p-' + id).val(disc_t / sub_t * 100);
        } else {
            var disc_p = parseFloat($('#disc_p-' + id).val());
            $('#disc_t-' + id).val(sub_t * disc_p / 100);
        }

        Htg(id);
    }

    function Sum() {
        var sum_d = 0;
        $(".disc_t").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum_d += parseFloat(this.value);
            }
        });
        $("input#disc_amount").val(sum_d);

        var sum_t = 0;
        $(".total_price").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum_t += parseFloat(this.value);
            }
        });
        $("input#grand_total").val(sum_t);
        $("input#sub_total").val(sum_t + sum_d);
        $("input#disc_percent").val(sum_d / (sum_t + sum_d) * 100);
    }

    $(document).ready(function() {
        var i = 1;

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append(`<tr id="row-${i}" class="dynamic-added">
            <td><input type="text" name="item_name[]" class="form-control name_list" required="" /></td>
            <td><input type="number" name="qty[]" onkeyup="Htg(${i})" class="form-control qty" id="qty-${i}" required="" value="0" /></td>
            <td><input type="number" name="price[]" onkeyup="Htg(${i})" class="form-control price" id="price-${i}" required="" value="0" /></td>
            <td>
            <div class="row">
                <div class="col-4">
                    <input type="number" name="disc_percent_d[]" onkeyup="Disc(${i}, 0)" class="form-control disc_p" id="disc_p-${i}" required="" value="0" />
                </div>
                <div class="col-8">
                    <input type="number" name="disc_amount_d[]" onkeyup="Disc(${i}, 1)" class="form-control disc_t" id="disc_t-${i}" required="" value="0" />
                </div>
            </div>
            </td>
            <td><input type="number" name="total_price[]" readonly onchange="Sum()" class="form-control total_price" id="total_price-${i}" required="" value="0" /></td>
            <td>
                <button type="button" name="remove" id="${i}" class="btn btn-danger btn_remove">x</button>
            </td>
            </tr>`);
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row-' + button_id + '').remove();
            Sum();
        });
    });
</script>

<?= $this->endSection('content'); ?>