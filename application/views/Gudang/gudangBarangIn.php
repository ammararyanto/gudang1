<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Barang Masuk </h1>
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
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <button type="button" class="btn btn-primary mb-3" onclick="tampilFormTambah()">
                                <i class="fas fa-plus"> </i> Input Barang Masuk
                            </button> -->
                            <a href="<?= base_url('Gudang/inBarangMasuk') ?>" class="btn btn-primary mb-3"> <i class="fas fa-plus"></i> Input Barang Masuk</a>

                            <?= $this->session->flashdata('message'); ?>
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header bg-success ui-sortable-handle">
                                    <!-- <button type="button" class="btn btn-warning" onclick="tampil()">
                                        Tambah Barang
                                    </button> -->

                                    <div class="card-tools">
                                        <!--<span class="badge badge-danger">8 New Members</span>-->
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="overflow-auto" style="overflow-x:auto;">

                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th class="text-right">Biaya</th>
                                                    <th>Supplier</th>
                                                    <th>Petugas</th>
                                                    <th class="text-center">Action</th>


                                                </tr>
                                            </thead>
                                            <?php
                                            $no = 0;
                                            foreach ($barang as $b) {
                                                $no = $no + 1;
                                                $ts_create = strtotime($b['in_tgl_create']);
                                                $dt_create = date('Y-m-d', $ts_create);
                                                $tgl_create = date_indo($dt_create);
                                                $jam_create = date('H:i', $ts_create);

                                                $ymdNow = date('Y-m-d', time());
                                                if ($dt_create == $ymdNow) {
                                                    $action_hidden = '';
                                                } else {
                                                    $action_hidden = ' hidden';
                                                }
                                            ?>
                                                <tr>
                                                    <td> <?= $no ?></td>
                                                    <td> <?= $tgl_create ?></td>
                                                    <td class="text-right"> <?= money($b['in_total_harga'])  ?></td>
                                                    <td> <?= $b['cust_nama'] ?></td>
                                                    <td> <?= $b['user_nama'] ?></td>
                                                    <td class="text-center">
                                                        <a onclick="viewDetail('<?= $b['in_id'] ?>')" class="btn btn-secondary btn-sm" href="#" data-toggle="tooltip" title="Bayar"><i class="fas fa-eye"></i></i></a>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>

                                    <div class="modal fade" id="modal-tambah">

                                        <form action=<?= base_url('gudang/inputBarangMasuk') ?> method="POST">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Tambah Data Barang Baru</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4 col-4">
                                                                <div class="form-group">
                                                                    <label class="col-form-label-sm" for="diskon">Tanggal</label>
                                                                    <input type="text" class="form-control form-control-sm diskon" value="<?= $tgl_today ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-4">
                                                                <div class="form-group">
                                                                    <label class="col-form-label-sm" for="diskon">Supplier</label>

                                                                    <select style="width: 100%;" class='form-control form-control-sm' id='supplier' name='supplier'>
                                                                        <option value="1">Satu</option>
                                                                        <option value="2">Dua</option>
                                                                        <option value="3">Tiga</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-4">
                                                                <div class="form-group">
                                                                    <label class="col-form-label-sm" for="diskon">Nomor Dokumen</label>
                                                                    <input type="text" class="form-control form-control-sm diskon" id="no_dok" name="no_dok" placeholder="contoh SJ12345">
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                        </form>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </div>
                            </div>
                            <!--/.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- /.card -->
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-ubah">

            <form action=<?= base_url('gudang/ubahBarangMasuk') ?> method="POST">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail Barang Masuk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="form-ubah">

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            </form>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-detail">


            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Barang Masuk</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="form-detail">


                    </div>
                    <div class=" modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>

            <!-- /.modal-dialog -->
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
    function tampilFormEdit(id) {
        $('#modal-ubah').modal('show');

        $('#form-ubah').load("<?= base_url() ?>gudang/tampilDetailBarangMasuk/" + id);
        $("#vnama-fitur").html('Awewe');
        $("#vnama-stok").html('Olala');
    }

    function tampilFormTambah() {
        $('#modal-tambah').modal('show');
    }

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

<script>
    $('#barang1').select2();

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