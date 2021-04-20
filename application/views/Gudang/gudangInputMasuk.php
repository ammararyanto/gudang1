<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">Form Input Barang Masuk </h4>
                </div><!-- /.col -->

            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- /.card -->
                    <form action=<?= base_url('gudang/inputBarangMasuk') ?> method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $this->session->flashdata('message'); ?>
                                <!-- <a href="<?= base_url('Gudang/barangMasuk') ?>" class="btn btn-secondary mr-2 float-left"> <i class="fas fa-arrow-circle-left"></i> Kembali</a> -->
                                <!-- USERS LIST -->
                            </div>

                            <div class="col-lg-4 col-12">

                                <div class="card">
                                    <div class="card-header bg-success ui-sortable-handle">
                                        <h6 class="m-0 card-title">
                                            Informasi
                                        </h6>
                                        <div class="card-tools">
                                            <!--<span class="badge badge-danger">8 New Members</span>-->
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="diskon">Tanggal</label>
                                                    <input type="text" class="form-control form-control-sm diskon" value="<?= $tgl_today ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="diskon">Supplier</label>

                                                    <select style="width: 100%;" class='form-control form-control-sm' id='supplier' name='supplier'>
                                                        <?php foreach ($cust_all as $ca) { ?>
                                                            <option value="<?= $ca['cust_id'] ?>"><?= $ca['cust_nama'] ?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label class="col-form-label-sm" for="diskon">Nomor Dokumen</label>
                                                    <input type="text" class="form-control form-control-sm diskon" id="no_dok" name="no_dok" placeholder="contoh SJ12345">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-12">
                                <div class="card">
                                    <div class="card-header bg-success ui-sortable-handle">
                                        <h6 class="m-0 text-weight-bold card-title">
                                            Daftar Barang
                                        </h6>
                                        <div class="card-tools">
                                            <!--<span class="badge badge-danger">8 New Members</span>-->
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <input id="nomor" type="text" value="1" hidden>
                                            <div class="col-lg-12 col-12">
                                                <table class="table table-bordered" id="formTable">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nama Barang</th>
                                                            <th scope="col">Qty</th>
                                                            <th scope="col">Satuan</th>
                                                            <th scope="col">Harga</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbBarangIn">
                                                        <tr class="records" id="row1">
                                                            <td style="width: 45%;">
                                                                <select style="width: 100%;" class='form-control form-control-sm' id='barang1' name='barang[]' onchange="pilihBarang(1)">
                                                                    <option>Pilih Barang</option>
                                                                    <?php foreach ($barang_all as $ba) { ?>
                                                                        <option value="<?= $ba['br_id'] ?>" data-satuan="<?= $ba['br_id'] ?>"><?= $ba['br_id'] . ' - ' . $ba['br_nama'] ?></option>
                                                                    <?php } ?>
                                                                    <?php ?>

                                                                </select>
                                                            </td>

                                                            <td style="width: 15%;">
                                                                <input class="form-control  form-control-sm" type="text" id="qty" name="qty[]" autocomplete="off">
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <input class="form-control  form-control-sm" type="text" id="satuan" name="satuan[]" autocomplete="off" disabled>
                                                            </td>
                                                            <td style="width: 15%;">
                                                                <input class="form-control  form-control-sm" type="text" id="harga" name="harga[]" autocomplete="off">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <button type="button" class="btn btn-warning btn-sm" onclick="addRow()">
                                                    <i class="fas fa-plus"> </i> Tambah Form
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                                        <button type="button" class="btn btn-outline-secondary float-right mr-3" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </div>



                            <!--/.card -->

                            <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.row -->
                    <!-- /.card -->
                </div>
            </div>
        </div>




    </section>
    <!-- /.content -->
</div>

<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Laziz</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> <?php echo date('M'); ?>
    </div>
</footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/moment.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.min.js'; ?>"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/jquery.price_format.min.js' ?>"></script>
<script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
        });
    });

    $(function() {
        $('#ms_biaya').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });
    });
</script>
<script>
    $('.konfirmasi-hapus').on('click', function(e) {
        // alert('terpencet');
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Hapus ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
</script>

<script>
    $(function() {
        $('#ms_biaya_e').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
</script>

<script>
    $('#barang1').select2();
    $('#supplier').select2();


    function addRow() {
        var nomor = document.getElementById('nomor').value;
        var urutan = parseInt(nomor) + 1;

        $.ajax({
            url: "<?= base_url(); ?>gudang/addRowBarangMasuk",
            method: "POST",
            data: {
                urutan: urutan
            },
            success: function(data) {
                $('#tbBarangIn').append(data);
                $('#nomor').val(urutan);
            }
        });
    }

    function pilihBarang(urutan) {

        var $rows = $('#row' + urutan);
        var $id_barang = document.getElementById('barang' + urutan).value;

        $.ajax({
            url: "<?= base_url(); ?>gudang/getSatuanBarang/" + $id_barang,
            method: "POST",
            data: {

            },
            success: function(data) {
                $($rows).find('#satuan').val(data);
            }
        });

        // alert(id_barang);

    }

    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("formTable").deleteRow(i);
    }

    function viewDetail(id) {
        $('#modal-detail').modal('show');
        // alert(id);
        $('#form-detail').load("<?= base_url() ?>gudang/fetchDetailBarangMasuk/" + id);
    }
</script>