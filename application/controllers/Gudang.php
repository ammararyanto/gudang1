<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gudang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_barang');
        $this->load->model('M_Transaksi');
        if ($this->session->userdata('status') != "kemasukan") {
            redirect(base_url());
        }
    }

    function dataBarang()
    {
        $data['user_nama'] = $this->session->userdata('user_nama');
        $data['titel'] = "Persediaan";
        $data['jajal'] = "Persediaan";
        $data['namamenu'] = "Persediaan";
        $data['martis'] = "data_barang";
        $data['barang'] = $this->M_barang->getBarangAll();
        // exit();
        $data['satuan_barang'] = $this->M_barang->getSatuanBarangAll();
        // var_dump($data['satuan_barang']);
        // exit();
        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/Menu', $data);
        $this->load->view('Gudang/gudangDataBarang', $data);
        $this->load->view('Admin/footer');
    }

    function getSatuanBarang($barang_id)
    {
        $data_barang = $this->M_barang->getBarangDetail($barang_id);
        echo $data_barang['sat_barang_nama'];
    }

    function barangMasuk()
    {
        $data['user_nama'] = $this->session->userdata('user_nama');
        $data['titel'] = "Daftar Pembelian Barang";
        $data['jajal'] = "Persediaan";
        $data['namamenu'] = "Persediaan";
        $data['martis'] = "barang_masuk";
        $data['barang'] = $this->M_barang->getBarangMasukAll();
        $data['satuan_barang'] = $this->M_barang->getSatuanBarangAll();
        $data['jenis_satuan'] = $this->M_barang->getJenisSatuanAll();
        $data['barang_all'] = $this->M_barang->getBarangAllForInput();
        $data['d_barang_masuk'] = $this->M_barang->getDetailBarangMasukById('DT001');

        $dt_today = date('Y-m-d', time());
        $tgl_today = date_indo($dt_today);
        $data['tgl_today'] = $tgl_today;

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/Menu', $data);
        $this->load->view('Gudang/gudangBarangIn', $data);
        $this->load->view('Admin/footer');
    }

    function inBarangMasuk()
    {
        $data['user_nama'] = $this->session->userdata('user_nama');
        $data['titel'] = "Daftar Pembelian Barang";
        $data['jajal'] = "Persediaan";
        $data['namamenu'] = "Persediaan";
        $data['martis'] = "barang_masuk";

        $data['barang_all'] = $this->M_barang->getBarangAllForInput();
        $data['cust_all'] = $this->M_barang->getAllCustomer();
        $dt_today = date('Y-m-d', time());
        $tgl_today = date_indo($dt_today);
        $data['tgl_today'] = $tgl_today;

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/Menu', $data);
        $this->load->view('Gudang/gudangInputMasuk', $data);
        $this->load->view('Admin/footer');
    }

    function fetchDetailBarangMasuk($masuk_id)
    {
        $d_barang_masuk = $this->M_barang->getDetailBarangMasukById($masuk_id);
        $output = '';
        $output .= '<div class="row">';
        $output .= '<div class="col-lg-12">';
        $output .= '<table class="table table-bordered" id="formTable">';
        $output .= '<thead>';
        $output .= '        <tr>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Satuan</th>
                                <th scope="col">Harga</th>
                            </tr>';
        $output .= '</thead>';
        $output .= '<tbody>';

        foreach ($d_barang_masuk as $dbm) {
            $output .= '<tr class="records" id="row1">
                        <td style="width: 45%;">' . $dbm['dtin_br_nama'] . '</td>
                        <td style="width: 15%;">' . $dbm['dtin_qty'] . '</td>
                        <td style="width: 15%;">' . $dbm['sat_barang_nama'] . '</td>
                        <td style="width: 15%;">' . $dbm['dtin_harga'] . '</td>
                    </tr>';
        }
        $output .= '<tbody>';
        $output .= '</table>';
        $output .= '</div></div>';

        echo $output;
    }

    function addRowBarangMasuk()
    {
        $urutan = $this->input->post('urutan');
        $barang_all = $this->M_barang->getBarangAllForInput();

        $output = '';
        $output .= '<tr class="records" id="row' . $urutan . '">
                        <td style="width: 45%;">
                            <select style="width: 100%;" class="form-control form-control-sm" id="barang' . $urutan . '" name="barang[]" onchange="pilihBarang(' . $urutan . ')">';

        $output .= '<option value="">Pilih Barang</option>';
        foreach ($barang_all as $ba) {
            $output .= '<option value="' . $ba['br_id'] . '">' . $ba['br_id'] . ' - ' . $ba['br_nama'] . '</option>';
        }

        $output .= '        </select>
                        </td>';

        $output .= '<script> $("#barang' . $urutan . '").select2(); </script>';

        $output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm" type="text" id="qty" name="qty[]" autocomplete="off">
                    </td>';
        $output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm" type="text" id="satuan" name="satuan[]" autocomplete="off" disabled>
                    </td>';
        $output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm" type="text" id="harga" name="harga[]" autocomplete="off" >
                    </td>';
        $output .= '<td style="width: 5%;">
                        <a class="btn btn-secondary btn-sm konfirmasi-hapus" href="#" data-toggle="tooltip" id="" title="Bayar" onclick="deleteRow(this)"><i class="fas fa-trash-alt"></i></i></a>
                    </td>';
        $output .= '</tr>';
        echo $output;
    }

    function inputbarangMasuk()
    {
        $id_barang = $this->input->post('barang');
        $qty_barang = $this->input->post('qty');
        $harga_barang = $this->input->post('harga');
        $supplier = $this->input->post('supplier');
        $no_dok = $this->input->post('no_dok');

        $kode_tanggal = 'MS' . date('ymd', time());

        $last_input = $this->M_barang->getLastIdBarangMasuk($kode_tanggal);
        $last_id = $last_input['in_id'];
        $last_number = (int)substr($last_id, -3);

        $antrian = $last_number + 1;
        if ($antrian < 10) {
            $kode_antrian = "00" . $antrian;
        } else if ($antrian < 100) {
            $kode_antrian = "0" . $antrian;
        } else if ($antrian < 1000) {
            $kode_antrian =  $antrian;
        }

        $id_transaksi_raw = $kode_tanggal . $kode_antrian;
        $dtin_id = $id_transaksi_raw;


        $harga_total = 0;
        for ($z = 0; $z < count($harga_barang); $z++) {
            $harga_total = $harga_total + $harga_barang[$z];
        }
        $this->M_barang->createBarangMasuk(
            $dtin_id,
            2,
            $harga_total,
            $supplier,
            $no_dok
        );

        for ($x = 0; $x < count($id_barang); $x++) {
            $dtin_br_id = $id_barang[$x];
            $dtin_qty = $qty_barang[$x];
            $dtin_harga = $harga_barang[$x];
            $data_barang = $this->M_barang->getBarangDetail($dtin_br_id);
            $dtin_br_nama = $data_barang['br_nama'];

            $this->M_barang->createDetailBarangMasuk(
                $dtin_id,
                $dtin_br_id,
                $dtin_br_nama,
                $dtin_harga,
                $dtin_qty
            );

            $br_stok_update = $data_barang['br_stok'] + $dtin_qty;
            $data_barang = [
                "br_stok" => $br_stok_update
            ];
            $this->M_barang->updateBarang($data_barang, $dtin_br_id);
        }

        $jml_input = count($id_barang);
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                         Input data barang masuk berhasil (' . $jml_input . ' data terinputkan)
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
        redirect('Gudang/barangMasuk');
    }

    function hapusBarangMasuk($masuk_id)
    {
        $bm = $this->M_barang->getBarangMasukByIdRow($masuk_id);
        $this->M_barang->deleteBarangMasuk($masuk_id);
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        <b>' . $bm['in_br_nama'] . '</b> berhasil dihapus dari data pembelian barang
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
        redirect('Gudang/barangMasuk');
    }

    function barangKeluar()
    {
        $data['user_nama'] = $this->session->userdata('user_nama');
        $data['titel'] = "Daftar Pembelian Barang";
        $data['jajal'] = "Persediaan";
        $data['namamenu'] = "Persediaan";
        $data['martis'] = "barang_keluar";
        $data['barang'] = $this->M_barang->getBarangKeluarAll();
        // var_dump($data['barang']);
        // exit();
        $data['satuan_barang'] = $this->M_barang->getSatuanBarangAll();
        $data['jenis_satuan'] = $this->M_barang->getJenisSatuanAll();
        $data['barang_all'] = $this->M_barang->getBarangAllForInput();
        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/Menu', $data);
        $this->load->view('Gudang/gudangBarangOut', $data);
        $this->load->view('Admin/footer');
    }

    function inBarangKeluar()
    {
        $data['user_nama'] = $this->session->userdata('user_nama');
        $data['titel'] = "Daftar Pembelian Barang";
        $data['jajal'] = "Persediaan";
        $data['namamenu'] = "Persediaan";
        $data['martis'] = "barang_masuk";

        $data['barang_all'] = $this->M_barang->getBarangAllForInput();
        $data['cust_all'] = $this->M_barang->getAllCustomer();
        $dt_today = date('Y-m-d', time());
        $tgl_today = date_indo($dt_today);
        $data['tgl_today'] = $tgl_today;

        $this->load->view('Admin/header', $data);
        $this->load->view('Admin/Menu', $data);
        $this->load->view('Gudang/gudangInputKeluar', $data);
        $this->load->view('Admin/footer');
    }

    function addRowBarangKeluar()
    {
        $urutan = $this->input->post('urutan');
        $barang_all = $this->M_barang->getBarangAllForInput();

        $output = '';
        $output .= '<tr class="records" id="row' . $urutan . '">
                        <td style="width: 45%;">
                            <select style="width: 100%;" class="form-control form-control-sm" id="barang' . $urutan . '" name="barang[]" onchange="pilihBarang(' . $urutan . ')">';

        $output .= '<option value="">Pilih Barang</option>';

        foreach ($barang_all as $ba) {
            $output .= '<option value="' . $ba['br_id'] . '">' . $ba['br_id'] . ' - ' . $ba['br_nama'] . '</option>';
        }

        $output .= '        </select>
                        </td>';

        $output .= '<script> $("#barang' . $urutan . '").select2(); </script>';
        $output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm" type="text" id="qty" name="qty[]" autocomplete="off">
                    </td>';
        $output .= '<td style="width: 15%;">
                        <input class="form-control  form-control-sm" type="text" id="satuan" name="satuan[]" autocomplete="off" disabled>
                    </td>';
        $output .= '<td style="width: 5%;">
                        <a class="btn btn-secondary btn-sm konfirmasi-hapus" href="#" data-toggle="tooltip" id="" title="Bayar" onclick="deleteRow(this)"><i class="fas fa-trash-alt"></i></i></a>
                    </td>';
        $output .= '</tr>';
        echo $output;
    }

    function inputbarangKeluar()
    {
        $id_barang = $this->input->post('barang');
        $qty_barang = $this->input->post('qty');
        $customer = $this->input->post('customer');
        $jml_barang = count($id_barang);

        $kode_tanggal = 'SJ' . date('ymd', time());

        $last_input = $this->M_barang->getLastIdBarangKeluar($kode_tanggal);
        $last_id = $last_input['out_id'];
        $last_number = (int)substr($last_id, -3);

        $antrian = $last_number + 1;
        if ($antrian < 10) {
            $kode_antrian = "00" . $antrian;
        } else if ($antrian < 100) {
            $kode_antrian = "0" . $antrian;
        } else if ($antrian < 1000) {
            $kode_antrian =  $antrian;
        }

        $id_transaksi_raw = $kode_tanggal . $kode_antrian;
        $out_id = $id_transaksi_raw;

        $this->M_barang->createBarangKeluar(
            $out_id,
            $jml_barang,
            2,
            $customer
        );

        for ($x = 0; $x < $jml_barang; $x++) {
            $barang_id = $id_barang[$x];
            $barang_qty = $qty_barang[$x];
            $data_barang = $this->M_barang->getBarangDetail($barang_id);
            $barang_nama = $data_barang['br_nama'];
            $user_id = 1;

            $this->M_barang->createDetailBarangKeluar(
                $out_id,
                $barang_id,
                $barang_nama,
                $barang_qty
            );

            $br_stok_update = $data_barang['br_stok'] - $barang_qty;
            $data_barang = [
                "br_stok" => $br_stok_update
            ];
            $this->M_barang->updateBarang($data_barang, $barang_id);
        }

        $jml_input = count($id_barang);
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                         Input data barang keluar berhasil (' . $jml_input . ' data terinputkan)
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
        redirect('Gudang/barangKeluar');
    }

    function hapusBarangKeluar($keluar_id)
    {
        $bm = $this->M_barang->getBarangKeluarByIdRow($keluar_id);
        $this->M_barang->deleteBarangMasuk($keluar_id);
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                        <b>' . $bm['out_br_nama'] . '</b> berhasil dihapus dari data pembelian barang
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
        redirect('Gudang/barangMasuk');
    }

    function fetchDetailBarangKeluar($keluar_id)
    {
        $d_barang_masuk = $this->M_barang->getDetailBarangKeluarById($keluar_id);
        $output = '';
        $output .= '<div class="row">';
        $output .= '<div class="col-lg-12 mb-2">
                        <a href="' . base_url("gudang/printSJ/") . $keluar_id . ' " target="_blank" class="btn btn-success float-left"> <i class="fas fa-print"></i> Print Surat Jalan</a>
                    </div>';
        $output .= '<div class="col-lg-12">';
        $output .= '<table class="table table-bordered" id="formTable">';
        $output .= '<thead>';
        $output .= '        <tr>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Satuan</th>
                            </tr>';
        $output .= '</thead>';
        $output .= '<tbody>';

        foreach ($d_barang_masuk as $dbm) {
            $output .= '<tr class="records" id="row1">
                        <td style="width: 45%;">' . $dbm['dtout_br_nama'] . '</td>
                        <td style="width: 15%;">' . $dbm['dtout_qty'] . '</td>
                        <td style="width: 15%;">' . $dbm['sat_barang_nama'] . '</td>
                    </tr>';
        }
        $output .= '<tbody>';
        $output .= '</table>';
        $output .= '</div></div>';

        echo $output;
    }

    function printSJ($keluar)
    {
        $keluar_id = 'KL210418003';
        $data['keluar'] = $this->M_barang->getBarangKeluarByIdRow($keluar_id);
        $data['det_keluar'] = $this->M_barang->getDetailBarangKeluarById($keluar_id);
        // var_dump($data['keluar']);
        // exit();

        $ts_sj = strtotime($data['keluar']['out_tgl_create']);
        $dt_sj = date('Y-m-d', $ts_sj);
        $tgl_sj = date_indo($dt_sj);
        $data['tgl_sj'] = $tgl_sj;
        $this->load->view('Gudang/gudangSuratJalan', $data);
    }

    // ============================= BATAS CODING BARU ===============================================================

}
