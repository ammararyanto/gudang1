<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Laporan Transaksi </h1>
                </div><!-- /.col -->

            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->session->flashdata('message'); ?>
                    <!-- /.card -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header bg-info ui-sortable-handle">
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
                                    <div class="row">
                                        <div class="col-lg-12">

                                        </div>
                                    </div>

                                    <div class="overflow-auto" style="overflow-x:auto;">

                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th hidden>No</th>
                                                    <th>No</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Detail Transaksi</th>
                                                    <th>Panjang</th>
                                                    <th>Lebar</th>
                                                    <th>Qty</th>
                                                    <th>Harga Satuan </th>
                                                    <th>Harga Total </th>
                                                    <th>Total Awal </th>
                                                    <th>Diskon </th>
                                                    <th>Total Akhir </th>
                                                </tr>
                                            </thead>

                                            <?php
                                            $no = 0;
                                            foreach ($data_lt as $lt) {
                                                $no = $no + 1;

                                                if ($lt['tr_total']) {
                                                    $total = money($lt['tr_total']);
                                                } else {
                                                    $total = $lt['tr_total'];
                                                }

                                                if ($lt['tr_diskon']) {
                                                    $diskon = money($lt['tr_diskon']);
                                                } else {
                                                    $diskon = $lt['tr_diskon'];
                                                }

                                                if ($lt['g_total']) {
                                                    $g_total = money($lt['g_total']);
                                                } else {
                                                    $g_total = $lt['g_total'];
                                                }
                                                // if(){

                                                // }else{

                                                // }
                                                // if(){

                                                // }else{

                                                // }
                                                // if(){

                                                // }else{

                                                // }
                                                // if(){

                                                // }else{

                                                // }
                                            ?>


                                                <tr>
                                                    <td hidden> <?= $no ?> </td>
                                                    <td> <?= $lt['tr_no'] ?> </td>
                                                    <td> <?= $lt['p_nama'] ?> </td>
                                                    <td> <?= $lt['barang_nama'] ?> </td>
                                                    <td class="text-center"> <?= $lt['dtr_panjang'] ?> </td>
                                                    <td class="text-center"> <?= $lt['dtr_lebar'] ?> </td>
                                                    <td class="text-center"> <?= $lt['dtr_jumlah'] ?> </td>
                                                    <td class="text-right"> <?= money($lt['dtr_harga'])   ?> </td>
                                                    <td class="text-right"> <?= money($lt['dtr_total'])  ?> </td>
                                                    <td class="text-right"> <?= $total  ?> </td>
                                                    <td class="text-right"> <?= $diskon ?> </td>
                                                    <td class="text-right"> <?= $total  ?> </td>
                                                </tr>
                                            <?php  } ?>



                                        </table>
                                    </div>

                                    <div class="modal fade" id="modal-tambah">

                                        <form action=<?= base_url('gudang/inputPengeluaran') ?> method="POST">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Tambah Data Pengeluaran</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-12">
                                                                <div class="form-group">
                                                                    <label for="nabar">Nama / Jenis Pengeluaran</label>
                                                                    <input class="form-control form-control-sm" type="text" placeholder="- misal bayar listrik bulanan -" id="pl_nama" name="pl_nama" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-12">
                                                                <div class="form-group" id="vharjul2">
                                                                    <label for="satuan">Biaya</label>
                                                                    <input class="form-control form-control-sm" type="text" placeholder="- misal 300.000 - " id="pl_biaya" name="pl_biaya" autocomplete="off">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12 col-12">
                                                                <div class="form-group">
                                                                    <label for="nabar">Keterangan (Boleh Kosong)</label>
                                                                    <input class="form-control form-control-sm" type="text" placeholder="" id="pl_keterangan" name="pl_keterangan" autocomplete="off">
                                                                </div>
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


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
        });
    });

    $(function() {
        $('#pl_biaya').priceFormat({
            prefix: '',
            centsLimit: 0,
            thousandsSeparator: '.',
        });
    });
</script>
<script>
    function tampilFormEdit(id) {
        $('#modal-ubah').modal('show');

        $('#form-ubah').load("<?= base_url() ?>Gudang/tampilDetailPengeluaran/" + id);
        $("#vnama-fitur").html('Awewe');
        $("#vnama-stok").html('Olala');
    }

    function tampilFormTambah() {
        $('#modal-tambah').modal('show');
    }

    function konfirmasiHapus() {
        $('#modal-hapus').modal('show');
    }

    $('.konfirmasi-hapus').on('click', function(e) {
        // alert('terpencet');
        e.preventDefault();
        const href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
</script>