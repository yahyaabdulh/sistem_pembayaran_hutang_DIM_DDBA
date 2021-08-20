<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="starter-template py-5 px-2">
    <form method="post" action="<?= base_url('pembayaran/simpan') ?>">
        <?= csrf_field(); ?>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Pembayaran Hutang</h3>
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
                                    <select name="supplier_id" id="supplier_id" class="form-control">
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
                        <h3>Detail Pembayaran</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dynamic_field">
                                    <tr>
                                        <th width="20%">Pembelian</th>
                                        <th width="20%">Tagihan</th>
                                        <th width="20%">Dibayarkan</th>
                                        <th width="20%">Sisa</th>
                                        <th width="20%">Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <tr id="row-0" class="dynamic-added">
                                        <td>
                                            <select name="purchase_id[]" id="purchase_id-0" class="form-control purchase_id" onchange="setPurchase(0)">
                                                <option value="">-- Pilih Pembelian --</option>
                                                <?php
                                                $purchase_amount = '';
                                                foreach ($purchases as $key) {
                                                    echo '<option value="' . $key->id . '">' . $key->code . '</option>';
                                                    $purchase_amount .='<input type="hidden" id="purchase_amount-0-'.$key->id.'" value="' . $key->grand_total . '">';
                                                }
                                                echo $purchase_amount;
                                                ?>
                                            </select>
                                        </td>
                                        <td><input type="number" name="bill[]" readonly class="form-control bill" id="bill-0" required="" value="0" /></td>
                                        <td><input type="number" name="bill_payment[]" onkeyup="Htg(0)" class="form-control bill_payment" id="bill_payment-0" required="" value="0" /></td>
                                        <td><input type="number" name="bill_remain[]" readonly onchange="Sum()" class="form-control bill_remain" id="bill_remain-0" required="" value="0" /></td>
                                        <td><input type="text" name="note_detail[]" class="form-control note_detail" id="note_detail-0" required="" /></td>
                                        <td></td>
                                    </tr>
                                </table>
                                <table width="100%" id="total">
                                    <tr height="50px;">
                                        <td><button type="button" name="add" id="add" class="btn btn-success">Tambah Pembayaran</button></td>
                                        <td width="50%" style="text-align: right;"><b>Total Tagihan :</b> &nbsp;</td>
                                        <td width="25%"><input type="number" name="bill_amount" readonly class="form-control" id="bill_amount" required="" value="0" /></td>
                                    </tr>
                                    <tr height="50px;">
                                        <td colspan="2" width="75%" style="text-align: right;"><b>Total Pembayaran :</b> &nbsp;</td>
                                        <td><input type="number" name="paid_amount" readonly class="form-control" id="paid_amount" required="" value="0" /></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="form-group card-footer">
                            <input type="submit" value="Simpan" class="btn btn-info" />
                            <a class="btn btn-danger" href="<?= base_url(); ?>/pembayaran"> Kembali </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    function setPurchase(id) {
        var purchase_id = $('#purchase_id-' + id).val();
        var amount = parseFloat($('#purchase_amount-'+ id+'-'+purchase_id).val());
        $('#bill-' + id).val(amount);
        Htg(id)
        Sum();
    }

    function Htg(id) {
        var bill = $('#bill-' + id).val();
        var bill_payment = $('#bill_payment-' + id).val();
        var bill_remain = parseFloat(bill) - parseFloat(bill_payment);
        $('#bill_remain-' + id).val(bill_remain).trigger('change');
    }

    function Sum() {
        var sum_d = 0;
        $(".bill").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum_d += parseFloat(this.value);
            }
        });
        $("input#bill_amount").val(sum_d);

        var sum_t = 0;
        $(".bill_payment").each(function() {
            if (!isNaN(this.value) && this.value.length != 0) {
                sum_t += parseFloat(this.value);
            }
        });
        $("input#paid_amount").val(sum_t);
    }

    $(document).ready(function() {
        var i = 1;

        $('#add').click(function() {
            i++;
            $('#dynamic_field').append(`<tr id="row-${i}" class="dynamic-added">
            <td>
                <select name="purchase_id[]" id="purchase_id-${i}" class="form-control purchase_id" onchange="setPurchase(${i})">
                    <option value="">-- Pilih Pembelian --</option>
                    <?php
                    $purchase_amount = '';
                    foreach ($purchases as $key) {
                        echo '<option value="' . $key->id . '">' . $key->code . '</option>';
                        $purchase_amount .='<input type="hidden" id="purchase_amount-${i}-'.$key->id.'" value="' . $key->grand_total . '">';
                    }
                    echo $purchase_amount;
                    ?>
                </select>
            </td>
            <td><input type="number" name="bill[]" readonly class="form-control bill" id="bill-${i}" required="" value="0" /></td>
            <td><input type="number" name="bill_payment[]" onkeyup="Htg(${i})" class="form-control bill_payment" id="bill_payment-${i}" required="" value="0" /></td>
            <td><input type="number" name="bill_remain[]" readonly onchange="Sum()" class="form-control bill_remain" id="bill_remain-${i}" required="" value="0" /></td>
            <td><input type="text" name="note_detail[]" class="form-control note_detail" id="note_detail-${i}" required="" /></td>
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